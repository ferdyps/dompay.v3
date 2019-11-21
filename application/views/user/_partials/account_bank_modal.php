<div class="modal fade" id="addAccountModal" tabindex="-1" role="dialog" aria-labelledby="addAccountModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAccountModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('user/add_accountBank', ['id' => 'default-form', 'log' => 'Tambah Akun Bank']); ?>
      <div class="modal-body">
          <div class="form-group form-input">
            <label for="input-nomorRek" class="col-form-label">Nomor Rekening :</label>
            <input type="text" name="nomorRek" class="form-control" id="input-nomorRek">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group form-input">
            <label for="input-typeBank" class="col-form-label">Tipe Bank :</label>
            <select name="typeBank" class="form-control" id="input-typeBank">
                <option value="Mandiri">Mandiri</option>
                <option value="BCA">BCA</option>
            </select>
          </div>
          <div class="form-group form-input">
            <label for="input-username" class="col-form-label">Username :</label>
            <input type="text" name="username" class="form-control" id="input-username">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group form-input">
            <label for="input-password" class="col-form-label">Password :</label>
            <input type="text" name="password" class="form-control" id="input-password">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group form-input">
            <label for="input-confirm_password" class="col-form-label">Konfirmasi Password :</label>
            <input type="text" name="confirm_password" class="form-control" id="input-confirm_password">
            <div class="invalid-feedback"></div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-submit">
            <span class="spinner-grow spinner-grow-sm d-none" id="status" role="status" aria-hidden="true"></span>
            <span id="btn-text">Tambah</span>
        </button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>