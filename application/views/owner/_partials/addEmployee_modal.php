<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEmployeeModalLabel">Tambah Akun Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('owner/add_employee', ['id' => 'modal-form', 'log' => 'Tambah Akun Employee']); ?>
      <div class="modal-body">
          <div class="form-group form-input">
            <label for="input-nama" class="col-form-label">Nama :</label>
            <input type="text" name="nama" class="form-control" id="input-nama" placeholder="Nama..">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group form-input">
            <label class="col-form-label">Fitur :</label>
            <div class="form-check">
                <input class="form-check-input" name="fitur[]" type="checkbox" value="Saldo" id="input-saldo">
                <label class="form-check-label" for="input-saldo">
                    Saldo
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="fitur[]" type="checkbox" value="Dashboard" id="input-dashboard">
                <label class="form-check-label" for="input-dashboard">
                    Dashboard
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="fitur[]" type="checkbox" value="Debit" id="input-debit">
                <label class="form-check-label" for="input-debit">
                    Debit
                </label>
            </div>
            <div class="form-check input-fitur">
                <input class="form-check-input" name="fitur[]" type="checkbox" value="Kredit" id="input-kredit">
                <label class="form-check-label" for="input-kredit">
                    Kredit
                </label>
            </div>
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
          <div class="form-group form-input">
            <label for="input-confirm_password" class="col-form-label">Konfirmasi Password :</label>
            <input type="password" name="confirm_password" class="form-control" id="input-confirm_password" placeholder="Konfirmasi Password..">
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