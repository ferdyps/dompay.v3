<div class="modal fade" id="addAccountModal" tabindex="-1" role="dialog" aria-labelledby="addAccountModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAccountModalLabel">Tambah Akun Bank</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('owner/add_accountBank', ['id' => 'modal-form-bank', 'log' => 'Tambah Akun Bank']); ?>
      <div class="modal-body">
          <input type="hidden" id="input-data" name="data" value="tidak ada">
          <div class="form-group form-input">
            <label for="input-typeBank" class="col-form-label">Tipe Bank :</label>
            <select name="typeBank" class="form-control" id="input-typeBank">
                <option value="Mandiri">Mandiri</option>
                <!-- <option value="BCA">BCA</option> -->
                <option value="BNI">BNI</option>
            </select>
          </div>
          <div class="form-group form-input">
            <label for="input-nomorRek" class="col-form-label">Nomor Rekening :</label>
            <input type="text" name="nomorRek" class="form-control" id="input-nomorRek" placeholder="Nomor Rekening..">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group form-input">
            <label for="input-username" class="col-form-label">Username :</label>
            <input type="text" name="username" class="form-control" id="input-username" placeholder="Username..">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group form-input">
            <label for="input-password" class="col-form-label">Password :</label>
            <input type="password" name="password" class="form-control" id="input-password" placeholder="Password..">
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