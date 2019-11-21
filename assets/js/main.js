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

    $('#modal-form').submit(function() {
        $('input').blur();
        event.preventDefault();

        var log = $(this).attr("log");
        var formData = new FormData($(this)[0]);
        var base_url = $(this).attr("action");

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
                        getData();
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