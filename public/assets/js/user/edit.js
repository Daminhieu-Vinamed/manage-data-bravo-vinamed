$(document).ready(function () {
    $(document).on("click", "#change-password", function () {
        $(this).parent().parent().children().first().append(`<div class="form-group col-md-3">
            <label for="password" class="form-label small">Mật khẩu</label>
            <input type="password" class="form-control" name="password" id="password">
            <span class="text-danger small" id="password_error"></span>
        </div>
        <div class="form-group col-md-3">
            <label for="re_password" class="form-label small">Nhập lại mật khẩu</label>
            <input type="password" class="form-control" name="re_password" id="re_password">
            <span class="text-danger small" id="re_password_error"></span>
        </div>`);
        $(this).text("HUỶ ĐỔI MẬT KHẨU").attr({
            class: "d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm ml-2",
            id: "cancel-change-password"
        });
    })

    $(document).on("click", "#cancel-change-password", function () {
        var password = $('#password');
        var re_password = $('#re_password');
        if (password.length && re_password.length) {
            password.parent().remove();
            re_password.parent().remove();
            $(this).text("ĐỔI MẬT KHẨU").attr({
                class: "d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-2",
                id: "change-password"
            });
        }
    })

    $(document).on("change", "#avatar", function (e) {
        const file = e.target.files[0];
        if (!$('#flex_avatar').length) {
            $('#body_edit').append(`<div class="form-group col-md-6">
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
        $('#avatar').val('');
        $('input[name="old_avatar"]').val('')
        $(this).parent().remove();
    });

    $(document).on("click", "#update_user", function () {
        let id = new URLSearchParams(window.location.search).get('id')
        formData = new FormData();
        formData.append('id', id);
        formData.append('EmployeeCode', $('input[name="EmployeeCode"]').val());
        formData.append('username', $('input[name="username"]').val());
        formData.append('name', $('input[name="name"]').val());
        formData.append('email', $('input[name="email"]').val());
        formData.append('password', $('input[name="password"]').val());
        formData.append('re_password', $('input[name="re_password"]').val());
        formData.append('department_code', $('select[name="department_code"]').val() !== nullValue ? $('select[name="department_code"]').val() : '');
        formData.append('company', $('select[name="company"]').val() !== nullValue ? $('select[name="company"]').val() : '');
        formData.append('role_id', $('select[name="role_id"]').val() !== nullValue ? $('select[name="role_id"]').val() : '');
        formData.append('gender_id', $('select[name="gender_id"]').val() !== nullValue ? $('select[name="gender_id"]').val() : '');
        formData.append('status_id', $('select[name="status_id"]').val() !== nullValue ? $('select[name="status_id"]').val() : '');
        formData.append('avatar', $('input[name="avatar"]')[0].files[0] !== undefinedValue ? $('input[name="avatar"]')[0].files[0] : '');
        formData.append('old_avatar', $('input[name="old_avatar"]').val());   
        $.ajax({
            url: linkUser + "update",
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
                $('#password').parent().remove();
                $('#re_password').parent().remove();
                $('#cancel-change-password').text("ĐỔI MẬT KHẨU").attr({
                    class: "d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-2",
                    id: "change-password"
                });
            },
            error: function (error) {
                if (error.responseJSON.status || error.responseJSON.msg) {
                    ToastTopRight.fire({
                        icon: error.responseJSON.status,
                        title: error.responseJSON.msg,
                    });
                }
                let errors = error.responseJSON.errors;
                errors.username ? $('#username_error').text(errors.username[zeroConst]) : $('#username_error').text('');
                errors.name ? $('#name_error').text(errors.name[zeroConst]) : $('#name_error').text('');
                errors.email ? $('#email_error').text(errors.email[zeroConst]) : $('#email_error').text('');
                errors.company ? $('#company_error').text(errors.company[zeroConst]) : $('#company_error').text('');
                errors.role_id ? $('#role_id_error').text(errors.role_id[zeroConst]) : $('#role_id_error').text('');
                errors.department_code ? $('#department_code_error').text(errors.department_code[zeroConst]) : $('#department_code_error').text('');
                errors.status_id ? $('#status_id_error').text(errors.status_id[zeroConst]) : $('#status_id_error').text('');
                errors.gender_id ? $('#gender_id_error').text(errors.gender_id[zeroConst]) : $('#gender_id_error').text('');
                errors.EmployeeCode ? $('#EmployeeCode_error').text(errors.EmployeeCode[zeroConst]) : $('#EmployeeCode_error').text('');
                errors.password ? $('#password_error').text(errors.password[zeroConst]) : $('#password_error').text('');
                errors.re_password ? $('#re_password_error').text(errors.re_password[zeroConst]) : $('#re_password_error').text('');
                errors.avatar ? $('#avatar_error').text(errors.avatar[zeroConst]) : $('#avatar_error').text('');
            },
        });
    });
});