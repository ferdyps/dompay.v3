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
                        <a class="text-primary" href="<?= base_url() ?>">Login</a>
                        <a class="text-primary active" href="<?= base_url('register') ?>">Register</a>
                    </div>
                    <?= form_open('', ['id' => 'default-form', 'log' => 'Register']); ?>
                        <div class="form-group form-input">
                            <input type="text" id="input-nama" class="form-control shadow" name="nama" placeholder="Nama" autofocus>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group form-input">
                            <input type="text" id="input-nohp" class="form-control shadow" name="nohp" placeholder="Nomor HP">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group form-input">
                            <input type="text" id="input-email" class="form-control shadow" name="email" placeholder="Email">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group form-input">
                            <input type="password" id="input-password" class="form-control shadow" name="password" placeholder="Password">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group form-input">
                            <input type="password" id="input-confirm_password" class="form-control shadow" name="confirm_password" placeholder="Konfirmasi Password">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-button">
                            <button id="submit" type="submit" class="btn shadow text-white" style="background-color:#dd4b39;">Register</button> 
                        </div>
                    <?= form_close(); ?>
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
                        <a href="<?= base_url() ?>">Login</a>
                        <a href="<?= base_url('register') ?>" class="active">Register</a>
                    </div>
                    <?= form_open('', ['id' => 'default-form', 'log' => 'Register']); ?>
                        <div class="form-group form-input">
                            <input type="text" id="input-nama" class="form-control shadow" name="nama" placeholder="Nama" autofocus>
                            <div class="invalid-feedback text-warning"></div>
                        </div>
                        <div class="form-group form-input">
                            <input type="text" id="input-nohp" class="form-control shadow" name="nohp" placeholder="Nomor HP">
                            <div class="invalid-feedback text-warning"></div>
                        </div>
                        <div class="form-group form-input">
                            <input type="text" id="input-email" class="form-control shadow" name="email" placeholder="Email">
                            <div class="invalid-feedback text-warning"></div>
                        </div>
                        <div class="form-group form-input">
                            <input type="password" id="input-password" class="form-control shadow" name="password" placeholder="Password">
                            <div class="invalid-feedback text-warning"></div>
                        </div>
                        <div class="form-group form-input">
                            <input type="password" id="input-confirm_password" class="form-control shadow" name="confirm_password" placeholder="Konfirmasi Password">
                            <div class="invalid-feedback text-warning"></div>
                        </div>
                        <div class="form-button">
                            <button id="submit" type="submit" class="btn shadow text-white" style="background-color:#dd4b39;">Register</button> 
                        </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
=====================================*/ ?>