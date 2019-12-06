<div class="container mt-3 mb-5">
    <h1>Edit Profile</h1>
    <hr>
    <div class="bg-white rounded shadow">
        <div class="bg-primary rounded-top p-2 text-center text-white">
            <h3 class="font-weight-bold m-0">Edit Profile</h3>
        </div>
        <div class="px-4 py-3">
            <div class="row">
                <div class="col border-right">
                    <?= form_open('', array('id' => 'default-form', 'log' => 'Edit Profile')); ?>
                    <div class="form-group form-input">
                        <label for="input-nama">Nama</label>
                        <input type="text" id="input-nama" class="form-control" name="nama" value="<?= $listData->nama; ?>">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="input-username">Username</label>
                        <input type="text" id="input-username" class="form-control" name="username" value="<?= $this->controller->cryptor($listData->username, 'd'); ?>">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="input-email">Email</label>
                        <input type="text" id="input-email" class="form-control" name="email" value="<?= $listData->email; ?>" <?php if($listData->email != NULL) echo 'disabled'; ?>>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="input-nohp">Nomor HP</label>
                        <input type="text" id="input-nohp" class="form-control" name="nohp" value="<?= $listData->nohp; ?>">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group text-center mt-3">
                        <button type="submit" class="btn btn-primary btn-submit">
                            <span class="spinner-grow spinner-grow-sm d-none" id="status" role="status" aria-hidden="true"></span>
                            <span id="btn-text">Edit</span>
                        </button>
                        <input type="reset" class="btn btn-danger" value="Reset">
                    </div>
                    <?= form_close(); ?>
                </div>
                <div class="col">
                    <?= form_open('owner/edit_akun', array('id' => 'default-form-2', 'log' => 'Edit Akun')); ?>
                    <div class="form-group form-input">
                        <label for="input-current_password">Current Password</label>
                        <input type="password" id="input-current_password" class="form-control" name="current_password" placeholder="Current Password..">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="input-new_password">New Password</label>
                        <input type="password" id="input-new_password" class="form-control" name="new_password" placeholder="New Password..">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group form-input">
                        <label for="input-confirm_password">Konfirmasi Password</label>
                        <input type="password" id="input-confirm_password" class="form-control" name="confirm_password" placeholder="Konfirmasi Password..">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group text-center mt-3">
                        <button type="submit" class="btn btn-primary btn-submit">
                            <span class="spinner-grow spinner-grow-sm d-none" id="status" role="status" aria-hidden="true"></span>
                            <span id="btn-text">Edit</span>
                        </button>
                        <input type="reset" class="btn btn-danger" value="Reset">
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>