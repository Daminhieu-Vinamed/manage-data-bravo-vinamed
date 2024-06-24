$(document).ready(function () {
    $(document).on("click", "#change-password", function () {
        $('#avatar').parent().after(`<div class="form-group col-md-4">
            <label for="password" class="form-label small">Mật khẩu</label>
            <input type="password" class="form-control" id="password">
            <span class="text-danger small" id="password_error"></span>
        </div>
        <div class="form-group col-md-4">
            <label for="re_password" class="form-label small">Nhập lại mật khẩu</label>
            <input type="password" class="form-control" id="re_password">
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
            $('#body_edit').append(`<div class="form-group col-md-4">
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
        $('#old_avatar').val('')
        $(this).parent().remove();
    });

    $(document).on("click", "#update_user", function () {
        let id = new URLSearchParams(window.location.search).get('id')
        formData = new FormData();
        formData.append('id', id);
        formData.append('EmployeeCode', $('#EmployeeCode').val());
        formData.append('username', $('#username').val());
        formData.append('name', $('#name').val());
        formData.append('email', $('#email').val());
        formData.append('password', $('#password').val());
        formData.append('re_password', $('#re_password').val());
        formData.append('department_code', $('#department_code').val() !== nullValue ? $('#department_code').val() : '');
        formData.append('company', $('#company').val() !== nullValue ? $('#company').val() : '');
        formData.append('role_id', $('#role_id').val() !== nullValue ? $('#role_id').val() : '');
        formData.append('gender_id', $('#gender_id').val() !== nullValue ? $('#gender_id').val() : '');
        formData.append('status_id', $('#status_id').val() !== nullValue ? $('#status_id').val() : '');
        formData.append('avatar', $('#avatar')[0].files[0] !== undefinedValue ? $('#avatar')[0].files[0] : '');
        formData.append('old_avatar', $('#old_avatar').val());   
        $.ajax({
            url: linkUser + "update",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token').attr(
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
                if (errors.username) {
                    $('#username_error').text(errors.username[zeroConst]);
                    $('#username').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#username_error').text('');
                    $('#username').removeClass('is-invalid').addClass('is-valid');
                }

                if (errors.name) {
                    $('#name_error').text(errors.name[zeroConst])
                    $('#name').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#name_error').text('')
                    $('#name').removeClass('is-invalid').addClass('is-valid');
                }

                if (errors.email) {
                    $('#email_error').text(errors.email[zeroConst])
                    $('#email').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#email_error').text('')
                    $('#email').removeClass('is-invalid').addClass('is-valid');
                }

                if (errors.company) {
                    $('#company_error').text(errors.company[zeroConst])
                    $('#company').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#company_error').text('')
                    $('#company').removeClass('is-invalid').addClass('is-valid');
                }

                if (errors.role_id) {
                    $('#role_id_error').text(errors.role_id[zeroConst])
                    $('#role_id').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#role_id_error').text('')
                    $('#role_id').removeClass('is-invalid').addClass('is-valid');
                }

                if (errors.department_code) {
                    $('#department_code_error').text(errors.department_code[zeroConst])
                    $('#department_code').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#department_code_error').text('')
                    $('#department_code').removeClass('is-invalid').addClass('is-valid');
                }

                if (errors.status_id) {
                    $('#status_id_error').text(errors.status_id[zeroConst])
                    $('#status_id').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#status_id_error').text('')
                    $('#status_id').removeClass('is-invalid').addClass('is-valid');
                }

                if (errors.gender_id) {
                    $('#gender_id_error').text(errors.gender_id[zeroConst])
                    $('#gender_id').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#gender_id_error').text('')
                    $('#gender_id').removeClass('is-invalid').addClass('is-valid');
                }

                if (errors.EmployeeCode) {
                    $('#EmployeeCode_error').text(errors.EmployeeCode[zeroConst])
                    $('#EmployeeCode').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#EmployeeCode_error').text('')
                    $('#EmployeeCode').removeClass('is-invalid').addClass('is-valid');
                }

                if (errors.password) {
                    $('#password_error').text(errors.password[zeroConst])
                    $('#password').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#password_error').text('')
                    $('#password').removeClass('is-invalid').addClass('is-valid');
                }

                if (errors.re_password) {
                    $('#re_password_error').text(errors.re_password[zeroConst])
                    $('#re_password').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#re_password_error').text('')
                    $('#re_password').removeClass('is-invalid').addClass('is-valid');
                }

                if (errors.avatar) {
                    $('#avatar_error').text(errors.avatar[zeroConst])
                    $('#avatar').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#avatar_error').text('')
                    $('#avatar').removeClass('is-invalid').addClass('is-valid');
                }
            },
        });
    });
});