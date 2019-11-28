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
            <div class="col text-center">
                <div class="spinner-grow text-primary d-none" id="table-loader" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function getData(bank, req, username, password) {
        var no = 1;
        var base_url;

        if (bank == "Mandiri") {
            base_url = "http://uzaha.com/restapi/api/mandiri/saldo?bank=mandiri&req=" + req + "&user=" + username +"&pass=" + password +"";
        } else if (bank == "BNI") {
            base_url = "http://uzaha.com/restapi/api/bni?bank=bni&req=" + req + "&user=" + username + "&pass=" + password +"";
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
                $('#table-loader').removeClass("d-none");
            },
            complete:function(){
                $('#table-loader').addClass("d-none");
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
                
                data.forEach(item => {
                    if (bank == "BNI") {
                        if (item.type == "DB") {
                            item.type = "Debit";
                        } else {
                            item.type = "Kredit";
                        }
                    }
                    
                    innerHTML += `
                        <tr>
                            <td class="text-center align-middle">${no++}</td>
                            <td class="text-center align-middle">${item.tanggal}</td>
                            <td class="text-center align-middle">${item.nominal}</td>
                            <td class="text-center align-middle">${item.type}</td>
                            <td class="text-center align-middle">${item.keterangan}</td>
                        </tr>
                    `;
                });

                innerHTML += `</tbody></table></div>`;

                $('.card-body').html(innerHTML);
                $('#dataTable').DataTable();

                $('#dataTable_wrapper row > col-sm-12').removeClass('col-md-6');
                $('#dataTable_wrapper row > col-sm-12').addClass('col-md-4');
                $('#dataTable_wrapper row').append(`
                <div class='col-sm-12 col-md-4'>
                    test
                </div>`);
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
        // startup();

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