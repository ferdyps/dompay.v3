var check, saldo;
// =============================================================
function delete_data(base_url, id) {
    Swal.fire({
        title: "Apakah anda yakin ?",
        text: "Setelah di hapus, anda tidak bisa melihat data tersebut..!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus saja !',
        cancelButtonText: 'Tidak, batal !',
        cancelButtonColor: '#3085d6',
        confirmButtonColor: '#d33',
        reverseButtons: true
    })
    .then((result) => {
        if(result.value) { 
            $.ajax({
                url: base_url + id,
                type: "get",
                data: id,
                dataType: "json",
                success:function(data){
                    if ($.isEmptyObject(data.errors)) {
                        Swal.fire({
                            title: "Berhasil",
                            text: data.message, 
                            icon: "success"
                        }).then(function() {
                            if (base_url.substring(base_url.lastIndexOf('_') + 1) == "accountBank/") {
                                location.reload();
                            } else {
                                getData();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal",
                            text: data.errors, 
                            icon: "error"
                        });
                    }
                },
                error:function(){
                    Swal.fire({
                        title: "Data Proses",
                        text: "Error di System..!", 
                        icon: "error"
                    });
                }
            });
        }
    });
}

function input_reset() {
    $('input[type=hidden]').val('');
    $('input[type=text]').val('');
    $('input[type=password]').val('');
    $('input[type=checkbox]').prop('checked', false);
}
// =============================================================
function default_form(content) {
    $('input').blur();
    event.preventDefault();

    var formData = new FormData($(content)[0]);
    var base_url = $(content).attr("action");

    $.ajax({
        url: base_url,
        type: "post",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
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
            if ($.isEmptyObject(data.errors) && $.isEmptyObject(data.form_errors)) {
                Swal.fire({
                    title: "Berhasil",
                    text: data.message, 
                    icon: "success",
                    heightAuto: false
                }).then(function() {
                    location = data.url
                });
            } else if(data.form_errors) {
                for(var form_data in data.form_errors) {
                    $('#input-' + data.form_errors[form_data]['id']).addClass('is-invalid');
                    $('#input-' + data.form_errors[form_data]['id']).parents('.form-input').find('.invalid-feedback').html(data.form_errors[form_data]['msg']);
                }
            } else {
                Swal.fire({
                    title: "Gagal",
                    text: data.errors, 
                    icon: "error",
                    heightAuto: false
                });
            }
        },
        error:function(){
            Swal.fire({
                title: "Error",
                text: "Error pada System..!",
                icon: "error",
                heightAuto: false
            });
        }
    });
}
// =============================================================
function modal_form(content) {
    $('input').blur();
    event.preventDefault();

    var log = $(content).attr("log");
    var formData = new FormData($(content)[0]);
    var base_url = $(content).attr("action");

    console.log(log);

    $.ajax({
        url: base_url,
        type: "post",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
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
            if ($.isEmptyObject(data.errors) && $.isEmptyObject(data.form_errors)) {
                Swal.fire({
                    title: "Berhasil",
                    text: data.message, 
                    icon: "success"
                });
                if(log == "Tambah Akun Bank") {
                    $('#addAccountModal').modal('toggle');
                    $('#addAccountModal select').val('Mandiri');
                } else if(log == "Tambah Akun Employee") {
                    $('#addEmployeeModal').modal('toggle');
                } else if(log == "Edit Akun Employee") {
                    $('#editEmployeeModal').modal('toggle');
                    $('#editEmployeeModal #collapsePassword').collapse('hide');
                }
                getData();
                input_reset();
            } else if(data.form_errors) {
                for(var form_data in data.form_errors) {
                    $('#input-' + data.form_errors[form_data]['id']).addClass('is-invalid');
                    $('#input-' + data.form_errors[form_data]['id']).parents('.form-input').find('.invalid-feedback').html(data.form_errors[form_data]['msg']);
                }
            } else {
                Swal.fire({
                    title: "Gagal",
                    text: data.errors, 
                    icon: "error"
                });
            }
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

function modal_form_bank(content) {
    $('input').blur();
    event.preventDefault();

    var log = $(content).attr("log");
    var formData = new FormData($(content)[0]);
    var base_url = $(content).attr("action");

    $.ajax({
        url: base_url,
        type: "post",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
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
            if ($.isEmptyObject(data.errors) && $.isEmptyObject(data.form_errors) && $.isEmptyObject(data.check)) {
                Swal.fire({
                    title: "Berhasil",
                    text: data.message, 
                    icon: "success"
                }).then(function() {
                    location.reload();
                    saldo = null;
                });
            } else if(data.check) {
                check_data_bank(content);
                if (check) {
                    $('#addAccountModal #input-data').val('ada');
                    $('#addAccountModal #input-saldo').val(saldo);
                    modal_form_bank(content);
                } else {
                    Swal.fire({
                        title: "Gagal",
                        text: "Data Bank Salah", 
                        icon: "error"
                    });
                }
            } else if(data.form_errors) {
                for(var form_data in data.form_errors) {
                    $('#input-' + data.form_errors[form_data]['id']).addClass('is-invalid');
                    $('#input-' + data.form_errors[form_data]['id']).parents('.form-input').find('.invalid-feedback').html(data.form_errors[form_data]['msg']);
                }
            } else {
                Swal.fire({
                    title: "Gagal",
                    text: data.errors, 
                    icon: "error"
                });
            }
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
// =============================================================
function getSaldoBank(bank, req, username, password) {
    var base_url;

    if (bank == "Mandiri") {
        base_url = "http://uzaha.com/restapi/api/mandiri/saldo?bank=mandiri&req=" + req + "&user=" + username +"&pass=" + password +"";
    } else if (bank == "BNI") {
        base_url = "http://uzaha.com/restapi/api/bni/saldo?bank=bni&req=" + req + "&user=" + username + "&pass=" + password +"";
    } else if (bank == "BRI") {
        base_url = "http://uzaha.com/restapi/api/bri/saldo?bank=bri&req=" + req + "&user=" + username + "&pass=" + password +"";
    } else if (bank == "BCA") {
        base_url = "http://uzaha.com/restapi/api/bca/saldo?bank=bca&req=" + req + "&user=" + username + "&pass=" + password +"";
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
            $('#dataAccount-saldo').attr('disabled', true);
            $('#dataSaldo').html(`
            <div class="spinner-grow spinner-grow-sm text-primary" id="table-loader" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            `);
        },
        complete:function(){
            $('#dataAccount-saldo').attr('disabled', false);
        },
        success:function(data){
            $('#dataSaldo').addClass('mt-2');
            $('#dataSaldo').html('Saldo : Rp. '+ numeral(data).format('0,0'));

            var currentURL = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
            if (currentURL == "mutasi") {
                startup();
            }
        },
        error:function() {
            $('#dataSaldo').html(`
                <button class="btn btn-primary" onClick="startupSaldoBank();">Refresh</button>
            `);
            $('#dataSaldo').removeClass('mt-2');
        }
    });
}

function startupSaldoBank() {
    var norek = $('#dataAccount-saldo').children('option:selected').val();
    var tipe = $('#dataAccount-saldo').children('option:selected').attr('data-tipe');
    var username = $('#dataAccount-saldo').children('option:selected').attr('data-username');
    var password = $('#dataAccount-saldo').children('option:selected').attr('data-password');

    if (norek != "Tidak Ada") {
        getSaldoBank(tipe, norek, username, password);
    }
}
// =============================================================
function check_data_bank(content) {
    $('input').blur();
    event.preventDefault();
    var base_url;

    var formData = new FormData($(content)[0]);

    var tipeBank = formData.get('typeBank');
    var nomorRek = formData.get('nomorRek');
    var username = formData.get('username');
    var password = formData.get('password');

    if (tipeBank == "Mandiri") {
        base_url = "http://uzaha.com/restapi/api/mandiri/saldo?bank=mandiri&req=" + nomorRek + "&user=" + username +"&pass=" + password +"";
    } else if (tipeBank == "BNI") {
        base_url = "http://uzaha.com/restapi/api/bni/saldo?bank=bni&req=" + nomorRek + "&user=" + username + "&pass=" + password +"";
    } else if (tipeBank == "BRI") {
        base_url = "http://uzaha.com/restapi/api/bri/saldo?bank=bri&req=" + nomorRek + "&user=" + username + "&pass=" + password +"";
    } else if (tipeBank == "BCA") {
        base_url = "http://uzaha.com/restapi/api/bca/saldo?bank=bca&req=" + nomorRek + "&user=" + username + "&pass=" + password +"";
    }

    $.ajax({
        url: base_url,
        type: "get",
        data: {req:nomorRek, user:username, pass:password},
        dataType: "json",
        contentType: false,
        processData: false,
        async: false,
        timeout: 40000,
        success:function(data){
            if ($.trim(data)) {
                check = true;
                saldo = data;
            } else {
                check = false;
            }
        },
        error:function(){
            check = false;
        }
    });
}
// =============================================================
$(window).on('load', function() {
    startupSaldoBank();
});
// =============================================================
$(document).ready(function () {
// =============================================================
    $('#default-form').submit(function() {
        default_form(this);
    });

    $('#default-form-2').submit(function() {
        default_form(this);
    });

    $('#modal-form-bank').submit(function() {
        modal_form_bank(this);
    });

    $('#modal-form').submit(function() {
        modal_form(this);
    });

    $('#modal-form-2').submit(function() {
        modal_form(this);
    });
// =============================================================    
    $('#dataAccount-saldo').change(function() {
        var norek = $(this).children('option:selected').val();
        var tipe = $(this).children('option:selected').attr('data-tipe');
        var username = $(this).children('option:selected').attr('data-username');
        var password = $(this).children('option:selected').attr('data-password');

        getSaldoBank(tipe, norek, username, password);
    });
// =============================================================
    $('form input').on('keyup', function () {
        if (!$(this).val()) {
            $(this).addClass('is-invalid');
            $(this).next('.invalid-feedback').text("The " + $(this).attr('placeholder').split("..").join("") + " field is required.");
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    $('form textarea').on('keyup', function () { 
        if (!$(this).val()) {
            $(this).addClass('is-invalid');
            $(this).next('.invalid-feedback').text("The " + $(this).attr('placeholder').split("..").join("") + " field is required.");
        } else {
            $(this).removeClass('is-invalid');
        }
    });
// =============================================================
    $(document).on('click', ':reset', function() {
        $('input').removeClass('is-invalid');
        $('textarea').removeClass('is-invalid');
    });
// =============================================================
    $('.select-default').select2({
        theme: 'bootstrap4'
    });
    
    $('.select-100').select2({
        theme: 'bootstrap4',
        width: '100%'
    });
// =============================================================
});