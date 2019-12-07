<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-sync-alt fa-fw"></i> Mutasi</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-sm-12 col-md-auto mr-auto">
                    <h6 class="mr-auto font-weight-bold text-primary mt-2">Data Mutasi</h6>
                </div>
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
                            <button class="btn btn-primary w-100" onclick="startup();">Refresh</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
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
                $('#dataAccount').attr('disabled', true);
                $('.card-body').html(`
                <div class="col text-center">
                    <div class="spinner-grow text-primary" id="table-loader" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                `);
            },
            complete:function(){
                $('#dataAccount').attr('disabled', false);
            },
            success:function(data){
                var innerHTML = `
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center bg-primary text-white">
                                <th width="2%">No</th>
                                <th width="13%">Tanggal Mutasi</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                                <th width="12%">Tipe Mutasi</th>
                            </tr>
                        </thead>
                        <tbody>
                      `;
                
                for (let index = 0; index < data.length; index++) {
                    var tipeMutasi, warnaMutasi, nominal;

                    <?php 
                    if(in_array('Debit', $this->fitur) && in_array('Kredit', $this->fitur)) { ?>
                        if (bank == "BNI" || bank == "BCA") {
                            nominal = data[index]['nominal'];
                            if (data[index]['type'] == "DB") {
                                tipeMutasi = "Debit";
                                warnaMutasi = "text-danger";
                            } else {
                                tipeMutasi = "Kredit";
                                warnaMutasi = "text-success";
                            }
                        } else if(bank == "Mandiri" || bank == "BRI") {
                            if (data[index]['debit'] == 0) {
                                tipeMutasi = "Kredit";
                                warnaMutasi = "text-success";
                                nominal = data[index]['kredit'];
                            } else {
                                tipeMutasi = "Debit"
                                warnaMutasi = "text-danger";
                                nominal = data[index]['debit'];
                            }
                        }
                    <?php 
                    } else if(in_array('Debit', $this->fitur)) { ?>
                        if (bank == "BNI" || bank == "BCA") {
                            if (data[index]['type'] == "DB") {
                                tipeMutasi = "Debit";
                                warnaMutasi = "text-danger";
                                nominal = data[index]['nominal'];
                            } else {
                                continue;
                            }
                        } else if(bank == "Mandiri" || bank == "BRI") {
                            if (data[index]['debit'] == 0) {
                                continue;
                            } else {
                                tipeMutasi = "Debit"
                                warnaMutasi = "text-danger";
                                nominal = data[index]['debit'];
                            }
                        }
                    <?php 
                    } else if(in_array('Kredit', $this->fitur)) { ?>
                        if (bank == "BNI" || bank == "BCA") {
                            if (data[index]['type'] == "DB") {
                                continue;
                            } else {
                                tipeMutasi = "Kredit";
                                warnaMutasi = "text-success";
                                nominal = data[index]['nominal'];
                            }
                        } else if(bank == "Mandiri" || bank == "BRI") {
                            if (data[index]['debit'] == 0) {
                                tipeMutasi = "Kredit";
                                warnaMutasi = "text-success";
                                nominal = data[index]['kredit'];
                            } else {
                                continue;
                            }
                        }
                    <?php } ?>
                    
                    innerHTML += `
                    <tr>
                        <td class="text-center align-middle">${no++}</td>
                        <td class="text-center align-middle">${data[index]['tanggal']}</td>
                        <td class="text-center align-middle">${data[index]['keterangan']}</td>
                        <td class="text-center align-middle">${numeral(nominal).format('0,0')}</td>
                        <td class="text-center align-middle ${warnaMutasi}">${tipeMutasi}</td>
                    </tr>
                    `;
                }

                innerHTML += `</tbody></table></div>`;

                $('.card-body').html(innerHTML);
                $('#dataTable').DataTable({
                    "lengthMenu": [[50, 100, -1], [50, 100, "All"]],
                    "dom": `
                        <"row" 
                            <"col-sm-12 col-md-5 mt-auto" l>
                            <"col-sm-12 col-md-6 mt-auto" f>
                            <"#logo-mutasi.col-sm-12 col-md-1 align-middle">
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
        var norek = $('#dataAccount').children('option:selected').val();
        var tipe = $('#dataAccount').children('option:selected').attr('data-tipe');
        var username = $('#dataAccount').children('option:selected').attr('data-username');
        var password = $('#dataAccount').children('option:selected').attr('data-password');

        getData(tipe, norek, username, password);
    }

    $(document).ready(function() {

        $('#dataAccount').change(function() {
            var norek = $(this).children('option:selected').val();
            var tipe = $(this).children('option:selected').attr('data-tipe');
            var username = $(this).children('option:selected').attr('data-username');
            var password = $(this).children('option:selected').attr('data-password');

            getData(tipe, norek, username, password);
        });
        
    });

    $(window).on('load', function() {
        <?php if (!in_array('Saldo', $this->fitur)) { ?>
            startup();
        <?php } ?>
    });
</script>