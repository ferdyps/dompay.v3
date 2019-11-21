<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-sync-alt fa-fw"></i> Mutasi</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col col-sm-12 col-md-auto mr-auto">
                    <h6 class="mr-auto font-weight-bold text-primary mt-2">Data Mutasi</h6>
                </div>
                <div class="col col-sm-12 col-md-auto">
                    <div class="row">
                        <div class="col col-sm-12 col-md-auto">
                            <label for="dataAccount" class="mt-2">Pilih Data Bank :</label>
                        </div>
                        <div class="col col-sm-12 col-md-auto">
                            <select id="dataAccount" class="form-control">
                                <?php foreach ($listDataAccount as $data) { ?>
                                    <option value="<?= $data['no_rek']; ?>"><?= $data['typeBank'] . " | " . $data['no_rek']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center bg-primary text-white">
                            <th width="5%">No</th>
                            <th>Nomor Rekening</th>
                            <th>Tanggal Mutasi</th>
                            <th>Nominal</th>
                            <th>Tipe Mutasi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>