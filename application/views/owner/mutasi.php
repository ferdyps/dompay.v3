<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-sync-alt fa-fw"></i> Mutasi</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-auto mr-auto">
                    <h6 class="mr-auto font-weight-bold text-primary mt-2">Data Mutasi</h6>
                </div>
                <?php /*==============================
                <div class="col-sm-12 col-md-auto">
                    <div class="row">
                        <div class="col-sm-12 col-md-auto">
                            <label for="dataAccount" class="mt-2">Pilih Data Bank :</label>
                        </div>
                        <div class="col-sm-12 col-md-auto">
                            <select id="dataAccount" class="form-control select-100">
                                <?php 
                                if ($listDataAccount != null) {
                                    foreach ($listDataAccount as $data) { ?>
                                        <option value="<?= $data['no_rek']; ?>" data-username="<?= $data['username']; ?>" data-password="<?= $data['password']; ?>" data-tipe="<?= $data['typeBank']; ?>"><?= $data['typeBank'] . " | " . $data['no_rek']; ?></option>
                                    <?php }
                                } else { ?>
                                    <option disabled selected>Tidak Ada</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-12 mt-2 mt-md-0 p-md-0 col-md-auto text-center">
                            <button class="btn btn-primary w-100" id="refreshMutasi" onclick="startup();">Refresh</button>
                        </div>
                    </div>
                </div>
                =====================================*/ ?>
                <div class="col-auto text-center">
                    <button class="btn btn-primary w-100" id="refreshMutasi" onclick="startup();">Refresh</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-lg-3 mb-lg-auto mb-md-3">
                    <div class="list-group" id="dataAccount">
                        <?php 
                        if ($listDataAccount != null) {
                            $no = 0;
                            foreach ($listDataAccount as $data) { 
                                if ($data['typeBank'] == "BNI") {
                                    $image = config_item('images_url') . '/bank/bni.png';
                                } else if($data['typeBank'] == "Mandiri") {
                                    $image = config_item('images_url') . '/bank/mandiri.png';
                                } else if($data['typeBank'] == "BRI") {
                                    $image = config_item('images_url') . '/bank/bri.png';
                                } else if($data['typeBank'] == "BCA") {
                                    $image = config_item('images_url') . '/bank/bca.png';
                                } ?>
                                <button class="list-group-item list-group-item-action <?php if($no ==0) echo 'active'; ?>" data-req="<?= $data['no_rek']; ?>" data-username="<?= $data['username']; ?>" data-password="<?= $data['password']; ?>" data-tipe="<?= $data['typeBank']; ?>" onclick="onClickBank(this);">
                                    <img class="mb-1 w-50" src="<?= $image; ?>">
                                    <p class="mb-1"><?= $data['deskripsi']; ?></p>
                                    <small>No Rek : <?= $data['no_rek']; ?></small>
                                </button>
                            <?php }
                        } else { ?>
                            <button class="list-group-item list-group-item-action active" data-req="Tidak ada">
                                <p class="mb-1 text-center">Data Tidak Ada..!</p>
                            </button>
                        <?php } ?>
                    </div>
                </div>
                <div class="col" id="dataMutasi">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-primary text-white">
                                    <th width="5%">No</th>
                                    <th>Tanggal Mutasi</th>
                                    <th>Nominal</th>
                                    <th>Tipe Mutasi</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <script>$('#dataTable').DataTable();</script>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function getData(bank, req, username, password) {
        var no = 1;
        var base_url, image;

        if (bank == "Mandiri") {
            base_url = "http://uzaha.com/restapi/api/mandiri?bank=mandiri&req=" + req + "&user=" + username +"&pass=" + password +"";
        } else if (bank == "BNI") {
            base_url = "http://uzaha.com/restapi/api/bni?bank=bni&req=" + req + "&user=" + username + "&pass=" + password +"";
        } else if (bank == "BRI") {
            base_url = "http://uzaha.com/restapi/api/bri?bank=bri&req=" + req + "&user=" + username + "&pass=" + password +"";
        } else if (bank == "BCA") {
            base_url = "http://uzaha.com/restapi/api/bca?bank=bca&req=" + req + "&user=" + username + "&pass=" + password +"";
        }

        $.ajax({
            url: base_url,
            type: "get",
            data: {req:req, user:username, pass:password},
            dataType: "json",
            contentType: false,
            processData: false,
            async: true,
            timeout: 40000,
            beforeSend:function(){
                $('#dataAccount button').attr('disabled', true);
                $('#refreshMutasi').attr('disabled', true);
                $('#dataMutasi').html(`
                <div class="col text-center">
                    <div class="spinner-grow text-primary" id="table-loader" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                `);
            },
            complete:function(){
                $('#dataAccount button').attr('disabled', false);
                $('#refreshMutasi').attr('disabled', false);
            },
            success:function(data){
                var innerHTML = `
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center bg-primary text-white">
                                <th width="2%">No</th>
                                <th width="13%">Tanggal Mutasi</th>
                                <th>Nominal</th>
                                <th width="10%">Tipe Mutasi</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                      `;
                
                data.forEach(item => {
                    var tipeMutasi, warnaMutasi, nominal;

                    if (bank == "BNI" || bank == "BCA") {
                        nominal = item.nominal;
                        if (item.type == "DB") {
                            tipeMutasi = "Debit";
                            warnaMutasi = "text-danger";
                        } else {
                            tipeMutasi = "Kredit";
                            warnaMutasi = "text-success";
                        }
                    } else if(bank == "Mandiri" || bank == "BRI") {
                        if (item.debit == 0) {
                            tipeMutasi = "Kredit";
                            warnaMutasi = "text-success";
                            nominal = item.kredit;
                        } else {
                            tipeMutasi = "Debit"
                            warnaMutasi = "text-danger";
                            nominal = item.debit;
                        }
                    }
                    
                    innerHTML += `
                    <tr>
                        <td class="text-center align-middle">${no++}</td>
                        <td class="text-center align-middle">${item.tanggal}</td>
                        <td class="text-center align-middle">${numeral(nominal).format('0,0')}</td>
                        <td class="text-center align-middle ${warnaMutasi}">${tipeMutasi}</td>
                        <td class="text-center align-middle">${item.keterangan}</td>
                    </tr>
                    `;
                });

                innerHTML += `</tbody></table></div>`;

                $('#dataMutasi').html(innerHTML);
                $('#dataTable').DataTable({
                    "lengthMenu": [[50, 100, -1], [50, 100, "All"]],
                    "dom": `
                        <"row" 
                            <"col-sm-12 col-md-5 mt-auto" l>
                            <"col-sm-12 col-md-5 mt-auto" f>
                            <"#logo-mutasi.col-sm-12 col-md-2 align-middle">
                        >
                        <"row" <"col-sm-12" t>>
                        <"row" 
                            <"col-sm-12 col-md-5" i>
                            <"col-sm-12 col-md-7" p>
                        >`,
                });

                if (bank == "BNI") {
                    image = "<?= config_item('images_url') . '/bank/bni.png'; ?>";
                } else if(bank == "Mandiri") {
                    image = "<?= config_item('images_url') . '/bank/mandiri.png'; ?>";
                } else if(bank == "BRI") {
                    image = "<?= config_item('images_url') . '/bank/bri.png'; ?>";
                } else if(bank == "BCA") {
                    image = "<?= config_item('images_url') . '/bank/bca.png'; ?>";
                }

                $('div#logo-mutasi').html(`<img src="` + image + `" class="w-100">`);
            },
            error:function(){
                $('#dataMutasi').html(`<h4 class="text-center">Data tidak ada..</h4>`);
            }
        });
    }

    function startup() {
        // var norek = $('#dataAccount').children('option:selected').val();
        // var tipe = $('#dataAccount').children('option:selected').attr('data-tipe');
        // var username = $('#dataAccount').children('option:selected').attr('data-username');
        // var password = $('#dataAccount').children('option:selected').attr('data-password');

        var norek = $('#dataAccount button.active').attr('data-req');
        var tipe = $('#dataAccount button.active').attr('data-tipe');
        var username = $('#dataAccount button.active').attr('data-username');
        var password = $('#dataAccount button.active').attr('data-password');

        if (norek != "Tidak Ada") {
            getData(tipe, norek, username, password);
        }
    }

    function onClickBank(e) {
        var norek = $(e).attr('data-req');
        var tipe = $(e).attr('data-tipe');
        var username = $(e).attr('data-username');
        var password = $(e).attr('data-password');

        if (norek != "Tidak Ada") {
            getData(tipe, norek, username, password);
        }
    }

    $(document).ready(function() {
        // $('#dataAccount').change(function() {
        //     var norek = $(this).children('option:selected').val();
        //     var tipe = $(this).children('option:selected').attr('data-tipe');
        //     var username = $(this).children('option:selected').attr('data-username');
        //     var password = $(this).children('option:selected').attr('data-password');

        //     getData(tipe, norek, username, password);
        // });

        // $('#dataAccount a').on('click', function (e) {
        //     e.preventDefault();
        //     var norek = $(this).attr('data-req');
        //     var tipe = $(this).attr('data-tipe');
        //     var username = $(this).attr('data-username');
        //     var password = $(this).attr('data-password');

        //     if (norek != "Tidak Ada") {
        //         getData(tipe, norek, username, password);
        //     }
        // });
    });
</script>