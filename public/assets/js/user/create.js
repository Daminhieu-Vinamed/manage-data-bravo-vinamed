$(document).ready(function () {
    $(document).on("change", "#avatar_c", function (e) {
        const file = e.target.files[0];
        if (!$('#flex_avatar').length) {
            $('#body_create').append(`<div class="form-group col-md-6">
                <button type="button" id="delete_avatar" class="btn btn-danger btn-circle position-absolute m-3"><i class="fas fa-trash-alt"></i></button>
                <img id="flex_avatar" class="img-thumbnail position-relative" alt="Đây không phải là file ảnh"/>
            </div>`)
        }
        if (file){
            let reader = new FileReader();
            reader.onload = function(event){
                $('#delete_avatar').css('z-index', '1')
                $('#flex_avatar').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }
    });

    $(document).on("click", "#delete_avatar", function () {
        $('#avatar_c').val('');
        $(this).parent().remove();
    });

    $(document).on("click", "#create_user", function () {
        formData = new FormData();
        formData.append('EmployeeCode', $('input[name="EmployeeCode_c"]').val());
        formData.append('username', $('input[name="username_c"]').val());
        formData.append('name', $('input[name="name_c"]').val());
        formData.append('email', $('input[name="email_c"]').val());
        formData.append('password', $('input[name="password_c"]').val());
        formData.append('re_password', $('input[name="re_password_c"]').val());
        formData.append('department_code', $('select[name="department_code_c"]').val() !== nullValue ? $('select[name="department_code_c"]').val() : '');
        formData.append('company', $('select[name="company_c"]').val() !== nullValue ? $('select[name="company_c"]').val() : '');
        formData.append('role_code', $('select[name="role_code_c"]').val() !== nullValue ? $('select[name="role_code_c"]').val() : '');
        formData.append('gender_id', $('select[name="gender_id_c"]').val() !== nullValue ? $('select[name="gender_id_c"]').val() : '');
        formData.append('status_id', $('select[name="status_id_c"]').val() !== nullValue ? $('select[name="status_id_c"]').val() : '');
        formData.append('avatar', $('input[name="avatar_c"]')[0].files[0] !== undefinedValue ? $('input[name="avatar_c"]')[0].files[0] : '');
        $.ajax({
            url: linkUser + "create",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: formData,
            processData: falseValue,
            contentType: falseValue,
            success: function (success) {
                ToastTopRight.fire({
                    icon: success.status,
                    title: success.msg,
                });
                $('#username_c').val('');
                $('#name_c').val('');
                $('#email_c').val('');
                $('#company_c option:first').removeAttr('disabled').removeAttr('selected').attr('selected','selected').attr('disabled','disabled');
                $('#role_code_c option:first').removeAttr('disabled').removeAttr('selected').attr('selected','selected').attr('disabled','disabled');
                $('#department_code_c option:first').removeAttr('disabled').removeAttr('selected').attr('selected','selected').attr('disabled','disabled');
                $('#status_id_c option:first').removeAttr('disabled').removeAttr('selected').attr('selected','selected').attr('disabled','disabled');
                $('#gender_id_c option:first').removeAttr('disabled').removeAttr('selected').attr('selected','selected').attr('disabled','disabled');
                $('#EmployeeCode_c').val('');
                $('#password_c').val('');
                $('#re_password_c').val('');
                $('#avatar_c').val('');
                if (!$('#delete_avatar').length) {
                    $('#delete_avatar').parent().remove();
                }
                listUser.ajax.reload();
            },
            error: function (error) {
                if (error.responseJSON.status || error.responseJSON.msg) {
                    ToastTopRight.fire({
                        icon: error.responseJSON.status,
                        title: error.responseJSON.msg,
                    });
                }
                let errors = error.responseJSON.errors;
                errors.username ? $('#username_error_c').text(errors.username[zeroConst]) : $('#username_error_c').text('');
                errors.name ? $('#name_error_c').text(errors.name[zeroConst]) : $('#name_error_c').text('');
                errors.email ? $('#email_error_c').text(errors.email[zeroConst]) : $('#email_error_c').text('');
                errors.company ? $('#company_error_c').text(errors.company[zeroConst]) : $('#company_error_c').text('');
                errors.role_code ? $('#role_code_error_c').text(errors.role_code[zeroConst]) : $('#role_code_error_c').text('');
                errors.department_code ? $('#department_code_error_c').text(errors.department_code[zeroConst]) : $('#department_code_error_c').text('');
                errors.status_id ? $('#status_id_error_c').text(errors.status_id[zeroConst]) : $('#status_id_error_c').text('');
                errors.gender_id ? $('#gender_id_error_c').text(errors.gender_id[zeroConst]) : $('#gender_id_error_c').text('');
                errors.EmployeeCode ? $('#EmployeeCode_error_c').text(errors.EmployeeCode[zeroConst]) : $('#EmployeeCode_error_c').text('');
                errors.password ? $('#password_error_c').text(errors.password[zeroConst]) : $('#password_error_c').text('');
                errors.re_password ? $('#re_password_error_c').text(errors.re_password[zeroConst]) : $('#re_password_error_c').text('');
                errors.avatar ? $('#avatar_error_c').text(errors.avatar[zeroConst]) : $('#avatar_error_c').text('');
            },
        });
    });
});