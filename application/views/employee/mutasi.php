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
                                    <option value="<?= $data['no_rek']; ?>" data-username="<?= $data['username']; ?>" data-password="<?= $data['password']; ?>" data-tipe="<?= $data['typeBank']; ?>"><?= $data['typeBank'] . " | " . $data['no_rek']; ?></option>
                                <?php } ?>
                            </select>
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
                                <th width="5%">No</th>
                                <th>Tanggal Mutasi</th>
                                <th>Nominal</th>
                                <th>Tipe Mutasi</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                      `;
                
                for (let index = 0; index < data.length; index++) {
                    var tipeMutasi, nominal;

                    <?php 
                    if(in_array('Debit', $this->fitur) && in_array('Kredit', $this->fitur)) { ?>
                        if (bank == "BNI" || bank == "BCA") {
                            nominal = data[index]['nominal'];
                            if (data[index]['type'] == "DB") {
                                tipeMutasi = "Debit";
                            } else {
                                tipeMutasi = "Kredit";
                            }
                        } else if(bank == "Mandiri" || bank == "BRI") {
                            if (data[index]['debit'] == 0) {
                                tipeMutasi = "Kredit";
                                nominal = data[index]['kredit'];
                            } else {
                                tipeMutasi = "Debit"
                                nominal = data[index]['debit'];
                            }
                        }
                    <?php 
                    } else if(in_array('Debit', $this->fitur)) { ?>
                        if (bank == "BNI" || bank == "BCA") {
                            if (data[index]['type'] == "DB") {
                                tipeMutasi = "Debit";
                                nominal = data[index]['nominal'];
                            } else {
                                continue;
                            }
                        } else if(bank == "Mandiri" || bank == "BRI") {
                            if (data[index]['debit'] == 0) {
                                continue;
                            } else {
                                tipeMutasi = "Debit"
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
                                nominal = data[index]['nominal'];
                            }
                        } else if(bank == "Mandiri" || bank == "BRI") {
                            if (data[index]['debit'] == 0) {
                                tipeMutasi = "Kredit";
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
                        <td class="text-center align-middle">${numeral(nominal).format('0,0')}</td>
                        <td class="text-center align-middle">${tipeMutasi}</td>
                        <td class="text-center align-middle">${data[index]['keterangan']}</td>
                    </tr>
                    `;
                }

                innerHTML += `</tbody></table></div>`;

                $('.card-body').html(innerHTML);
                $('#dataTable').DataTable({
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
                check = false;
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
        startup();
    });
</script>