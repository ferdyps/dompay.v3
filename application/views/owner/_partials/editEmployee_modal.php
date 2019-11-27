<div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editEmployeeModalLabel">Edit Akun Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('', ['id' => 'modal-form-2', 'log' => 'Edit Akun Employee']); ?>
      <div class="modal-body">
          <div class="form-group form-input">
            <label for="input-nama-e" class="col-form-label">Nama :</label>
            <input type="text" name="nama" class="form-control" id="input-nama-e" placeholder="Nama..">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group form-input">
            <label class="col-form-label">Fitur :</label>
            <div class="form-check">
                <input class="form-check-input" name="fitur[]" type="checkbox" value="Saldo" id="input-saldo-e">
                <label class="form-check-label" for="input-saldo-e">
                    Saldo
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="fitur[]" type="checkbox" value="Dashboard" id="input-dashboard-e">
                <label class="form-check-label" for="input-dashboard-e">
                    Dashboard
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="fitur[]" type="checkbox" value="Debit" id="input-debit-e">
                <label class="form-check-label" for="input-debit-e">
                    Debit
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="fitur[]" type="checkbox" value="Kredit" id="input-kredit-e">
                <label class="form-check-label" for="input-kredit-e">
                    Kredit
                </label>
            </div>
          </div>
          <div class="collapse" id="collapsePassword">
            <div class="form-group form-input">
              <label for="input-password-e" class="col-form-label">Password :</label>
              <input type="password" name="password" class="form-control" id="input-password-e" placeholder="Password..">
              <div class="invalid-feedback"></div>
            </div>
            <div class="form-group form-input">
              <label for="input-confirm_password-e" class="col-form-label">Konfirmasi Password :</label>
              <input type="password" name="confirm_password" class="form-control" id="input-confirm_password-e" placeholder="Konfirmasi Password..">
              <div class="invalid-feedback"></div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapsePassword" aria-expanded="false" aria-controls="collapsePassword">
              Show Password Form
        </button>
        <button type="submit" class="btn btn-primary btn-submit">
            <span class="spinner-grow spinner-grow-sm d-none" id="status" role="status" aria-hidden="true"></span>
            <span id="btn-text">Edit</span>
        </button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#collapsePassword').on('hidden.bs.collapse', function () {
      $('#editEmployeeModal input[type=password]').val('');
    });
  });
</script>