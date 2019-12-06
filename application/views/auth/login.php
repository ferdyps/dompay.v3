<div class="form-body bg-light">
    <div class="row">
        <div class="col m-auto">
            <div class="form-content bg-light">
                <div class="text-dark m-auto" style="max-width:380px">
                    <div class="website-logo-inside">
                        <a href="<?= base_url() ?>">
                            <img class="logo-size img-responsive" src="<?= base_url('assets/images/login.blue.png'); ?>" alt="">
                        </a>
                    </div>
                    <div class="page-links">
                        <a href="<?= base_url() ?>" class="text-primary active">Login</a>
                        <a href="<?= base_url('register'); ?>" class="text-primary">Register</a>
                    </div>
                    <?= form_open('', ['id' => 'default-form', 'log' => 'Login']); ?>
                        <div class="form-group form-input">
                            <input type="text" id="input-username" class="form-control shadow" name="username" placeholder="Username" autofocus>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group form-input">
                            <input type="password" id="input-password" class="form-control shadow" name="password" placeholder="Password">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-button">
                            <button id="submit" type="submit" class="btn btn-primary shadow">Login</button> 
                            <a class="text-primary" href="<?= base_url('users/register/forgot_pass') ?>">
                                Forget Password?
                            </a>
                        </div>
                        <small>Or login with</small>
                    <?= form_close(); ?>
                    <div class="other-links">
                        <a href="javascript:void(0);" style="background-color:#3b5998;" class="btn shadow"><i class="fab fa-facebook-f fw-fw"></i> Facebook</a>
                        <a href="javascript:void(0);" style="background-color:#dd4b39;" class="btn shadow"><i class="fab fa-google fa-fw"></i> Google</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 img-holder bg-gradient-primary">
            <?php $this->load->view('auth/_partials/kiri');?>
        </div>
    </div>
</div>
<?php /*==============================
<div class="form-body">
    <div class="row">
        <div class="img-holder">
            <?php $this->load->view('auth/_partials/kiri');?>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items" style="max-width:380px">
                    <div class="website-logo-inside">
                        <a href="<?= base_url() ?>">
                            <img class="logo-size img-responsive" src="<?= base_url('assets/images/login.png'); ?>" alt="">
                        </a>
                    </div>
                    <div class="page-links">
                        <a href="<?= base_url() ?>" class="active">Login</a>
                        <a href="<?= base_url('register'); ?>">Register</a>
                    </div>
                    <?= form_open('', ['id' => 'default-form', 'log' => 'Login']); ?>
                        <div class="form-group form-input">
                            <input type="text" id="input-username" class="form-control shadow" name="username" placeholder="Username" autofocus>
                            <div class="invalid-feedback text-warning"></div>
                        </div>
                        <div class="form-group form-input">
                            <input type="password" id="input-password" class="form-control shadow" name="password" placeholder="Password">
                            <div class="invalid-feedback text-warning"></div>
                        </div>
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn shadow">Login</button> 
                            <a href="<?= base_url('users/register/forgot_pass') ?>">
                                Forget Password?
                            </a>
                        </div>
                        <span style="color:white;font-size: 14px;">Or login with</span>
                    <?= form_close(); ?>
                    <div class="other-links">
                        <a href="javascript:void(0);" style="background-color:#3b5998;" class="btn shadow"><i class="fab fa-facebook-f fw-fw"></i> Facebook</a>
                        <a href="javascript:void(0);" style="background-color:#dd4b39;" class="btn shadow"><i class="fab fa-google fa-fw"></i> Google</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
=====================================*/ ?>