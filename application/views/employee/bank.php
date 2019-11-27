<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-university fa-fw"></i> Bank</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="mr-0 font-weight-bold text-primary">Data Akun Bank</h6>
        </div>
        <div class="card-body">
        </div>
    </div>
</div>
<?php $this->load->view('employee/_partials/addAccount_modal');?>
<script>
    function getData() {
        var no = 1;
        $.ajax({
            url: "<?= base_url('employee/get_accountBank'); ?>",
            type: "post",
            dataType: "json",
            async: true,
            timeout: 40000,
            beforeSend:function(){
                $('.btn-submit').attr("disabled", true);
                $('#status').removeClass("d-none");
                $('#btn-text').addClass("d-none");
            },
            complete:function(){
                $('.btn-submit').attr("disabled", false);
                $('#status').addClass("d-none");
                $('#btn-text').removeClass("d-none");
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
                            </tr>
                        </thead>
                        <tbody>
                      `;
                
                data.forEach(item => {
                    innerHTML += `
                        <tr>
                            <td class="text-center">${no++}</td>
                            <td class="text-center">${item.username}</td>
                            <td class="text-center">${item.no_rek}</td>
                            <td class="text-center">${item.typeBank}</td>
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