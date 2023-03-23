<?php

namespace App\Controllers;

use App\Models\MemberDataModel;
use CodeIgniter\Files\File;
use CodeIgniter\Exceptions\PageNotFoundException;

class Pages extends BaseController
{
    public function __construct()
    {
        helper(['form', 'url', 'html', 'session']);
    }
    public function index2()
    {
        $data['title'] = 'Home';
        return view('pages/index-2', $data);
    }

    public function index()
    {
        $data['title'] = 'Home';
        return view('templates/header', $data)
            . view('pages/' . 'index')
            . view('templates/footer');
    }

    public function view($page = 'about')
    {
        if (!is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        return view('templates/header', $data)
            . view('pages/' . $page)
            . view('templates/footer');
    }

    public function register()
    {
        $memberDB = new  MemberDataModel();
        $data = [];
        //set rules validation form
        $rules = [
            'name' => 'required|min_length[3]|max_length[20]',
            'designation' => 'required|min_length[3]',
            'memberPhone' => 'required',
            'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[member_details.email]',
            'file' => 'is_image[file]
            |mime_in[file,image/jpg,image/jpeg,image/gif,image/png,image/webp]
            |max_size[file,2048000]'
        ];

        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/register');
        }

        if ($this->validate($rules)) {

            //Get member data
            $registerData = $this->getMemberData();

            //save image into memberImage Folder
            $file = $this->request->getFile('file');

            if ($file->isValid() && !$file->hasMoved()) {
                $imgName = $file->getRandomName();
                $file->move('uploads/memberImages', $imgName);
                $registerData['file'] = $imgName;
            } else {
                $data['fileErrors'] = 'The file has already been moved.';
            }

            //save data into database
            $memberDB->insert($registerData);
            return redirect()->to('register')->with('status', 'Member Registration Completed Successfully. Thank You!');
        } else {
            $registerData = $this->getMemberData();
            $registerData['memberPhone'] = '+' . $registerData['memberPhoneCode'] . $registerData['memberPhone'];
            $data['registerData'] = $registerData;
            $data['validation'] = $this->validator;
        }

        $data['title'] = ucfirst('member registration');
        return view('templates/header', $data)
            . view('pages/' .  'register')
            . view('templates/footer');
    }

    protected function getMemberData()
    {
        $name =  str_replace(' ', '_', $this->request->getVar('name'));
        $id =  $name . '_' . $this->request->getVar('location') . '_' . getrandmax();
        $memberData = [
            'id' => $id,
            'name' => $this->request->getVar('name'),
            'designation' => $this->request->getVar('designation'),
            'email' => $this->request->getVar('email'),
            'memberPhoneCode' => $this->request->getVar('memberPhoneCode'),
            'memberPhone' => $this->request->getVar('memberPhone'),
            'location' => $this->request->getVar('location'),
            'file' => $this->request->getFile('file'),
        ];
        return $memberData;
    }
}
