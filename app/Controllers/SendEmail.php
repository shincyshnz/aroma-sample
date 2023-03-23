<?php

namespace App\Controllers;

use App\Models\MemberDataModel;

class SendEmail extends BaseController
{
    protected $helpers = ['url', 'form', 'session'];

    public function index()
    {
        $session = \Config\Services::session();
        $rules = [
            'name' => 'required|alpha_numeric_space|min_length[3]',
            'designation' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'phone' => 'required',
            'reference' => 'required|alpha_numeric_space',
            'referencePhone' => 'required',
            'subject' => 'required|alpha_numeric_space',
            'message' => 'required'
        ];

        //The form is not submitted through POST
        if ($this->request->getMethod() == 'post') {

            if ($this->validate($rules)) {
                //Get Reach us form data
                $mailData = $this->getFormData();

                $send = $this->sendmail($mailData);
                if ($send) {
                    return redirect()->to('contact')->with('email_msg', 'Your message has been sent. Thank you!');
                } else {
                    $session->setFlashdata('email_error_msg', 'Your message sending Failed. Try again');
                }
            } else {
                $mailData = $this->getFormData();
                $mailData['phone'] = '+' . $mailData['phoneCode'] . $mailData['phone'];
                $mailData['referencePhone'] = '+' . $mailData['referencePhoneCode'] . $mailData['referencePhone'];
                $data['mailData'] = $mailData;
                $data['validation'] = $this->validator;
            }
        } else {
            $data['method-error-msg'] = 'Oops! Something went Wrong. Try again!';
        }

        //return back to contact form
        $data['title'] = ucfirst('contact'); // Capitalize the first letter

        return view('templates/header', $data)
            . view('pages/' . 'contact')
            . view('templates/footer');
    }

    protected function getFormData()
    {
        $formData = [
            'name' => $this->request->getVar('name'),
            'designation' => $this->request->getVar('designation'),
            'email' => $this->request->getVar('email'),
            'phone' => $this->request->getVar('phone'),
            'phoneCode' => $this->request->getVar('phoneCode'),
            'reference' => $this->request->getVar('reference'),
            'referencePhoneCode' => $this->request->getVar('referencePhoneCode'),
            'referencePhone' => $this->request->getVar('referencePhone'),
            'subject' => $this->request->getVar('subject'),
            'message' => $this->request->getVar('message'),
        ];
        return $formData;
    }

    private function sendmail($mailData)
    { //Send mail
        $email = service('email');
        // $email = \Config\Services::email();
        $to = 'contact@aroma-aluva.com';

        // Mail content
        $mailContent = '
            <h2>AROMA Website Reach Us Form</h2>
            <p><b>Name: </b>' . $mailData['name'] . '</p>
            <p><b>Email: </b>' . $mailData['email'] . '</p>
            <p><b>Phone: </b>' . '+' . $mailData['phoneCode'] . $mailData['phone'] . '</p>
            <p><b>Reference: </b>' . $mailData['reference'] . '<b>  Phone: </b>' . '+' . $mailData['referencePhoneCode'] . $mailData['referencePhone'] . '</p>
            <p><b>Subject: </b>' . $mailData['subject'] . '</p>
            <p><b>Message: </b>' . $mailData['message'] . '</p>
            ';

        $email->setTo($to);
        $email->setFrom($mailData['email'], $mailData['name']);
        $email->setSubject($mailData['subject']);
        $email->setMessage($mailContent);

        return $email->send() ? true : false;
    }
}
