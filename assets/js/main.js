var check;

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
                            getData();
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
                });

                $('#addAccountModal').modal('toggle');
                $('#addAccountModal select').val('Mandiri');

                getData();
                input_reset();
            } else if(data.check) {
                check_data_bank(content);
                console.log("Result : " + check);
                if (check) {
                    $('#addAccountModal #input-data').val('ada');
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
        base_url = "http://uzaha.com/restapi/api/mandiri?bank=mandiri&req=" + nomorRek + "&user=" + username +"&pass=" + password +"";
    } else if (tipeBank == "BNI") {
        base_url = "http://uzaha.com/restapi/api/bni?bank=bni&req=" + nomorRek + "&user=" + username + "&pass=" + password +"";
    } else if (bank == "BRI") {
        base_url = "http://uzaha.com/restapi/api/bri?bank=bri&req=" + nomorRek + "&user=" + username + "&pass=" + password +"";
    } else if (bank == "BCA") {
        base_url = "http://uzaha.com/restapi/api/bca?bank=bca&req=" + nomorRek + "&user=" + username + "&pass=" + password +"";
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
            if (Array.isArray(data) && data.length > 0) {
                check = true;
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
$(document).ready(function () {
// =============================================================
    $('#default-form').submit(function() {
        $('input').blur();
        event.preventDefault();

        console.log($(this).attr("log"));

        var formData = new FormData($(this)[0]);
        var base_url = $(this).attr("action");

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
});