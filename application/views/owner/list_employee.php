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
            <div class="row">
                <div class="col text-center">
                    <div class="spinner-grow text-primary d-none" id="table-loader" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('owner/_partials/addEmployee_modal');?>
<?php $this->load->view('owner/_partials/editEmployee_modal');?>
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
                                    <th>Nama</th>
                                    <th>Fitur</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>`;
                
                data.forEach(item => {
                    innerHTML += `
                        <tr>
                            <td class="text-center">${no++}</td>
                            <td class="text-center">${item.nama}</td>
                            <td class="text-center">${item.fitur}</td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-sm shadow-sm" id="editEmployee" data-toggle="modal" data-target="#editEmployeeModal" data-id="${item.id}"><i class="fas fa-pen fa-sm"></i> Edit</button>
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

        $(document).on('click', '#editEmployee', function() {
            var id = $(this).attr('data-id');
            var url = "<?= base_url('owner/edit_employee/') ?>";
            $.ajax({
                url: url + id,
                type: "get",
                dataType: "json",
                beforeSend:function() {
                    $('#editEmployeeModal #input-nama').val("");
                    $('#editEmployeeModal .form-check-input').attr('checked', false);
                },
                complete:function() {
                    $('#loader-detail').addClass('d-none');
                    $('#content-detail').removeClass('d-none');
                },
                success:function(data) {
                    $('#editEmployeeModal form').attr("action", url + id);
                    $('#editEmployeeModal #input-nama').val(data.nama);

                    var fitur = data.fitur.split(', ');

                    fitur.forEach(element => {
                        $('#editEmployeeModal #input-' + element.toLowerCase()).attr('checked', true);;
                    });
                },
                error:function() {
                    swal({
                        title: "Error",
                        text: "Error di System..!",
                        icon: "warning",
                    });
                }
            });
        });
    });
</script>