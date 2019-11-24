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
                        <div class="form-input">
                            <input type="text" id="input-nama" class="form-control" name="nama" placeholder="Nama" autofocus>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-input">
                            <input type="text" id="input-nohp" class="form-control" name="nohp" placeholder="Nomor HP">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-input">
                            <input type="text" id="input-username" class="form-control" name="username" placeholder="Username">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-input">
                            <input type="text" id="input-email" class="form-control" name="email" placeholder="Email">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-input">
                            <input type="password" id="input-password" class="form-control" name="password" placeholder="Password">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-input">
                            <input type="password" id="input-confirm_password" class="form-control" name="confirm_password" placeholder="Konfirmasi Password">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-button">
                            <button id="submit" type="submit" class="btn text-white" style="background-color:#dd4b39;">Register</button> 
                        </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>