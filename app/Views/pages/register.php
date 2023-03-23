<main id="main">

    <!-- ======= About Us Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Member Registration</h2>
                <ol>
                    <li><a href="<?= base_url(); ?>/index">Home</a></li>
                    <li><a href="<?= base_url(); ?>/about">About Us</a></li>
                    <li>Member Registration</li>
                </ol>
            </div>

        </div>
    </section>
    <!-- End About Us Section -->


    <!--=======Member Registration Section=======-->
    <section class="contact" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
        <div class="container">

            <div class="section-title pt-5">
                <h2>Member Registration</h2>
            </div>

            <?php if (session()->getFlashdata('status')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('status'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>

            <div class="row">
                <div class="col-lg-12 text-center p-5">
                    <p class="description">"Make a difference in your community by joining the AROMA team as a registered member."</p>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-12">
                    <form action="<?= base_url(); ?>/register" method="post" role="form" class="reach-us-form" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" value="<?php if (isset($registerData['name'])) : echo $registerData['name']; ?><?php endif ?>" required>
                                <?php if (isset($validation) && $validation->hasError('name')) : ?>
                                    <span class=" text-danger"><?= $validation->getError('name'); ?>
                                    </span>
                                <?php endif ?>
                            </div>

                            <div class=" col-md-6 form-group">
                                <input type="text" name="designation" class="form-control" id="designation" placeholder="Your Designation" value="<?php if (isset($registerData['designation'])) : echo $registerData['designation']; ?><?php endif ?>" required>
                                <?php if (isset($validation) && $validation->hasError('designation')) : ?>
                                    <span class="text-danger"><?= $validation->getError('designation'); ?>
                                    </span>
                                <?php endif ?>
                            </div>

                            <div class=" col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" value="<?php if (isset($registerData['email'])) : echo $registerData['email']; ?><?php endif ?>" required>
                                <?php if (isset($validation) && $validation->hasError('email')) : ?>
                                    <span class="text-danger"><?= $validation->getError('email'); ?>
                                    </span>
                                <?php endif ?>
                            </div>

                            <div class="col-md-6 form-group">
                                <input type="tel" class="form-control mobile-code" name="memberPhone" id="memberPhone" placeholder="Your Contact Number" value="<?php if (isset($registerData['memberPhone'])) : echo $registerData['memberPhone']; ?><?php endif ?>" required>
                                <span id="valid-msg-memberPhone" class="text-success hide">✓ Valid</span>
                                <span id="error-msg-memberPhone" class="text-danger hide"></span>
                                <input type="hidden" id="memberPhoneCode" name="memberPhoneCode" value="" />
                                <?php if (isset($validation) && $validation->hasError('memberPhone')) : ?>
                                    <span class="text-danger"><?= $validation->getError('memberPhone'); ?>
                                    </span>
                                <?php endif ?>
                            </div>

                            <div class="col-md-12 form-group">
                                <select class="form-control" name="location" id="location">
                                    <option value="" selected>Select your location</option>

                                    <?php
                                    $locations = ['uae', 'qatar', 'bahrain', 'oman', 'usa', 'india'];
                                    foreach ($locations as $loc) { ?>
                                        <option value="<?php echo $loc; ?>" <?php echo set_select('location', $loc, False); ?>><?= ucwords($loc); ?> </option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-12 col-12">
                                <div class="form-group files">
                                    <label class="text-muted mt-2">Upload your photo. Max file size 50 MB</label>
                                    <input id="file" name="file" type="file" accept=".jpg, .jpeg, .png" size="30" class=" form-control" />

                                    <?php if (isset($validation) && $validation->hasError('file')) : ?>
                                        <span class="text-danger"><?= $validation->getError('file'); ?>
                                        </span>
                                    <?php endif ?>
                                    <?php if (isset($fileError)) : ?>
                                        <span class="text-danger"><?= $fileError; ?>
                                        </span>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit">Register</button>
                            <!-- <input type="submit" value="Send Message"> -->
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </section>
    <!-- End Member Registration Section -->