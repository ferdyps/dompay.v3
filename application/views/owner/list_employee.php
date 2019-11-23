<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-users fa-fw"></i> Employee</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm" data-toggle="modal" data-target="#addEmployeeModal"><i class="fas fa-plus-circle fa-sm"></i> Tambah Akun Employee</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="mr-0 font-weight-bold text-primary">Data Akun Employee</h6>
        </div>
        <div class="card-body">
        </div>
    </div>
</div>
<?php $this->load->view('owner/_partials/addEmployee_modal');?>
<script>
    function getData() {
        var no = 1;
        $.ajax({
            url: "<?= base_url('owner/get_employee'); ?>",
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
                                    <th>Nama</th>
                                    <th>Fitur</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>`;
                
                data.forEach(item => {
                    innerHTML += `
                        <tr>
                            <td class="text-center">${no++}</td>
                            <td class="text-center">${item.nama}</td>
                            <td class="text-center">${item.fitur}</td>
                            <td>
                                <button class="btn btn-primary btn-sm shadow-sm" data-toggle="modal" data-target="#editEmployeeModal" data-id="${item.id}"><i class="fas fa-pen fa-sm"></i> Edit</button>
                                <button class="btn btn-danger btn-sm shadow-sm" onclick="delete_data('<?= base_url('owner/delete_employee/'); ?>', ${item.id});"><i class="far fa-trash-alt fa-sm"></i> Delete</button>
                            </td>
                        </tr>
                    `;
                });

                innerHTML += `</tbody>
                        </table>
                    </div>`;

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