<main id="main">

  <!-- ======= Contact Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Reach Us</h2>
        <ol>
          <li><a href="<?= base_url(); ?>/index">Home</a></li>
          <li>Reach Us</li>
        </ol>
      </div>

    </div>
  </section>
  <!-- End Contact Section -->


  <!--=======Contact Section=======-->
  <section class="contact" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
    <div class="container">

      <div class="row">
        <div class="col-lg-12 text-center p-5">
          <p class="description">At AROMA, we are here to help those in need. If you or someone you know is struggling financially, please feel free to reach out to us at any time for assistance.</p>
        </div>
      </div>

      <div class="row">

        <div class="col-lg-12">
          <form action="<?= base_url(); ?>/sendemail" method="post" role="form" class="reach-us-form">

            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" value="<?php if (isset($mailData['name'])) : echo $mailData['name']; ?><?php endif ?>" required>
                <?php if (isset($validation) && $validation->hasError('name')) : ?>
                  <span class=" text-danger"><?= $validation->getError('name'); ?>
                  </span>
                <?php endif ?>
              </div>
              <div class=" col-md-6 form-group">
                <input type="text" name="designation" class="form-control" id="designation" placeholder="Your Designation" value="<?php if (isset($mailData['designation'])) : echo $mailData['designation']; ?><?php endif ?>" required>
                <?php if (isset($validation) && $validation->hasError('designation')) : ?>
                  <span class="text-danger"><?= $validation->getError('designation'); ?>
                  </span>
                <?php endif ?>
              </div>
              <div class=" col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" value="<?php if (isset($mailData['email'])) : echo $mailData['email']; ?><?php endif ?>" required>
                <?php if (isset($validation) && $validation->hasError('email')) : ?>
                  <span class="text-danger"><?= $validation->getError('email'); ?>
                  </span>
                <?php endif ?>
              </div>
              <div class="col-md-6 form-group">
                <input type="tel" class="form-control mobile-code" name="phone" id="phone" placeholder="Your Contact Number" value="<?php if (isset($mailData['phone'])) : echo $mailData['phone']; ?><?php endif ?>" required>
                <span id="valid-msg-phone" class="text-success hide">✓ Valid</span>
                <span id="error-msg-phone" class="text-danger hide"></span>
                <input type="hidden" id="phoneCode" name="phoneCode" value="<?php if (isset($mailData['phoneCode'])) : echo $mailData['phoneCode']; ?><?php endif ?>" />
                <?php if (isset($validation) && $validation->hasError('phone')) : ?>
                  <span class="text-danger"><?= $validation->getError('phone'); ?>
                  </span>
                <?php endif ?>
              </div>

              <!-- <div class="col-md-12 form-group">
                <select class="form-control" name="location" id="location">
                  <option value="" selected>Select your location</option>
                  <option value=" uae">UAE</option>
                  <option value="qatar">QATAR</option>
                  <option value="bahrain">BAHRAIN</option>
                  <option value="oman">OMAN</option>
                  <option value="usa">USA</option>
                </select>
              </div> -->
              <label class="text-primary">You must be referred by an existing AROMA member for assistance.</label>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="text" name="reference" class="form-control" id="reference" placeholder="Name (Referenced by)" value="<?php if (isset($mailData['reference'])) : echo $mailData['reference']; ?><?php endif ?>" required>
                <?php if (isset($validation) && $validation->hasError('reference')) : ?>
                  <span class="text-danger"><?= $validation->getError('reference'); ?>
                  </span>
                <?php endif ?>
              </div>
              <div class="col-md-6 form-group  mt-3 mt-md-0">
                <input type="tel" class="form-control mobile-code" name="referencePhone" id="referencePhone" placeholder="Contact Number" value="<?php if (isset($mailData['referencePhone'])) : echo $mailData['referencePhone']; ?><?php endif ?>" required>
                <span id="valid-msg-refer" class="text-success hide">✓ Valid</span>
                <span id="error-msg-refer" class="text-danger hide"></span>
                <input type="hidden" id="referencePhoneCode" name="referencePhoneCode" value="<?php if (isset($mailData['referencePhoneCode'])) : echo $mailData['referencePhoneCode']; ?><?php endif ?>" />

                <?php if (isset($validation) && $validation->hasError('referencePhone')) : ?>
                  <span class=" text-danger"><?= $validation->getError('referencePhone'); ?>
                  </span>
                <?php endif ?>
              </div>
            </div>

            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" value="<?php if (isset($mailData['subject'])) : echo $mailData['subject']; ?><?php endif ?>" required>
              <?php if (isset($validation) && $validation->hasError('subject')) : ?>
                <span class="text-danger"><?= $validation->getError('subject'); ?>
                </span>
              <?php endif ?>
            </div>

            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required><?php if (isset($mailData['message'])) : echo $mailData['message']; ?><?php endif ?></textarea>
              <?php if (isset($validation) && $validation->hasError('message')) : ?>
                <span class="text-danger"><?= $validation->getError('message'); ?>
                </span>
              <?php endif ?>
            </div>

            <?php if (session()->getFlashdata('email_error_msg')) : ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('email_error_msg') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif ?>

            <?php if (session()->getFlashdata('email_msg')) : ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('email_msg') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif ?>

            <div class="text-center">
              <button type="submit" id='submitBtn'>Send Message</button>
              <!-- <input type="submit" value="Send Message"> -->
            </div>
          </form>
        </div>

      </div>

    </div>
  </section>
  <!-- End Contact Section -->