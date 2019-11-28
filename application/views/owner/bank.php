<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-university fa-fw"></i> Bank</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm"  data-toggle="modal" data-target="#addAccountModal"><i class="fas fa-plus-circle fa-sm"></i> Tambah Akun Bank</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="mr-0 font-weight-bold text-primary">Data Akun Bank</h6>
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
<?php $this->load->view('owner/_partials/addAccount_modal');?>
<script>
    function getData() {
        var no = 1;
        $.ajax({
            url: "<?= base_url('owner/get_accountBank'); ?>",
            type: "post",
            dataType: "json",
            async: true,
            timeout: 100000,
            beforeSend:function(){
                $('.card-body').html(`
                <div class="col text-center">
                    <div class="spinner-grow text-primary" id="table-loader" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                `);
            },
            success:function(data){
                var innerHTML = `
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center bg-primary text-white">
                                <th width="5%">No</th>
                                <th>Username</th>
                                <th>Nomor Rekening</th>
                                <th>Tipe Bank</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                      `;
                
                data.forEach(item => {
                    innerHTML += `
                        <tr>
                            <td class="text-center align-middle">${no++}</td>
                            <td class="text-center align-middle">${item.username}</td>
                            <td class="text-center align-middle">${item.no_rek}</td>
                            <td class="text-center align-middle">${item.typeBank}</td>
                            <td class="text-center align-middle">
                                <button class="btn btn-danger btn-sm shadow-sm" onclick="delete_data('<?= base_url('owner/delete_accountBank/'); ?>', ${item.id_account});"><i class="far fa-trash-alt fa-sm"></i> Delete</button>
                            </td>
                        </tr>
                    `;
                });

                innerHTML += `</tbody></table></div>`;

                $('.card-body').html(innerHTML);
                $('#dataTable').DataTable();
            },
            error:function(){
                Swal.fire({
                    title: "Error",
                    text: "Error pada System..!",
                    icon: "error"
                });
            }
        });
    }

    $(document).ready(function() {
        getData();
    });
</script>