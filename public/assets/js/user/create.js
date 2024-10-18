$(document).ready(function () {
    $('#parent_user_id').select2();
    $('#company, #role_id, #status_id, #gender_id, #is_warehouse_active').select2({ minimumResultsForSearch: -1 });
    $(document).on("change", "#avatar", function (e) {
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
        $('#avatar').val('');
        $(this).parent().remove();
    });

    $("#CreateUserModal .close").on("click", function () {
        $('#username_error, #name_error, #email_error, #company_error, #parent_user_id_error, #role_id_error, #gender_id_error, #EmployeeCode_error, #status_id_error, #password_error, #re_password_error, #avatar_error').text('');
        $('#username, #name, #email, #company, #parent_user_id, #role_id, #status_id, #gender_id, #EmployeeCode, #password, #re_password, #avatar').removeClass('is-invalid');
    });

    $(document).on("click", "#create_user", function () {
        formData = new FormData();
        formData.append('EmployeeCode', $('#EmployeeCode').val());
        formData.append('username', $('#username').val());
        formData.append('name', $('#name').val());
        formData.append('email', $('#email').val());
        formData.append('password', $('#password').val());
        formData.append('re_password', $('#re_password').val());
        formData.append('company', $('#company').val() !== nullValue ? $('#company').val() : '');
        formData.append('parent_user_id', $('#parent_user_id').val() !== nullValue ? $('#parent_user_id').val() : '');
        formData.append('role_id', $('#role_id').val() !== nullValue ? $('#role_id').val() : '');
        formData.append('gender_id', $('#gender_id').val() !== nullValue ? $('#gender_id').val() : '');
        formData.append('status_id', $('#status_id').val() !== nullValue ? $('#status_id').val() : '');
        formData.append('is_warehouse_active', $('#is_warehouse_active').val() !== nullValue ? $('#is_warehouse_active').val() : '');
        formData.append('birthday', $('#birthday').val() !== nullValue ? $('#birthday').val() : '');
        formData.append('avatar', $('#avatar')[zeroConst].files[zeroConst] !== undefinedValue ? $('#avatar')[zeroConst].files[zeroConst] : '');
        $.ajax({
            url: linkUser + "create",
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
                $('#username, #name, #email, #EmployeeCode, #password, #re_password, #avatar').val('');
                $('#company option:first').attr('selected','selected');
                $('#role_id option:first').attr('selected','selected');
                $('#status_id option:first').attr('selected','selected');
                $('#gender_id option:first').attr('selected','selected');
                if (!$('#delete_avatar').length) {
                    $('#delete_avatar').parent().remove();
                }
                $('#username_error, #name_error, #email_error, #birthday_error, #EmployeeCode_error, #password_error, #re_password_error, #avatar_error, #company_error, #parent_user_id_error, #role_id_error, #status_id_error, #is_warehouse_active_error, #gender_id_error').text('');
                $('#username, #name, #email, #birthday, #EmployeeCode, #password, #re_password, #avatar').removeClass().addClass('form-control');
                $($('.form-group #company').prev()[zeroConst]).find('.select2-choice').css('border-color', '#d1d3e2')
                $($('.form-group #parent_user_id').prev()[zeroConst]).find('.select2-choice').css('border-color', '#d1d3e2')
                $($('.form-group #role_id').prev()[zeroConst]).find('.select2-choice').css('border-color', '#d1d3e2')
                $($('.form-group #status_id').prev()[zeroConst]).find('.select2-choice').css('border-color', '#d1d3e2')
                $($('.form-group #is_warehouse_active').prev()[zeroConst]).find('.select2-choice').css('border-color', '#d1d3e2')
                $($('.form-group #gender_id').prev()[zeroConst]).find('.select2-choice').css('border-color', '#d1d3e2')
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
                    $($('.form-group #company').prev()[zeroConst]).find('.select2-choice').css('border-color', '#e74a3b')
                } else {
                    $('#company_error').text('')
                    $($('.form-group #company').prev()[zeroConst]).find('.select2-choice').css('border-color', '#1cc88a')
                }

                if (errors.parent_user_id) {
                    $('#parent_user_id_error').text(errors.parent_user_id[zeroConst])
                    $($('.form-group #parent_user_id').prev()[zeroConst]).find('.select2-choice').css('border-color', '#e74a3b')
                } else {
                    $('#parent_user_id_error').text('')
                    $($('.form-group #parent_user_id').prev()[zeroConst]).find('.select2-choice').css('border-color', '#1cc88a')
                }

                if (errors.role_id) {
                    $('#role_id_error').text(errors.role_id[zeroConst])
                    $($('.form-group #role_id').prev()[zeroConst]).find('.select2-choice').css('border-color', '#e74a3b')
                } else {
                    $('#role_id_error').text('')
                    $($('.form-group #role_id').prev()[zeroConst]).find('.select2-choice').css('border-color', '#1cc88a')
                }

                if (errors.status_id) {
                    $('#status_id_error').text(errors.status_id[zeroConst])
                    $($('.form-group #status_id').prev()[zeroConst]).find('.select2-choice').css('border-color', '#e74a3b')
                } else {
                    $('#status_id_error').text('')
                    $($('.form-group #status_id').prev()[zeroConst]).find('.select2-choice').css('border-color', '#1cc88a')
                }

                if (errors.is_warehouse_active) {
                    $('#is_warehouse_active_error').text(errors.is_warehouse_active[zeroConst])
                    $($('.form-group #is_warehouse_active').prev()[zeroConst]).find('.select2-choice').css('border-color', '#e74a3b')
                } else {
                    $('#is_warehouse_active_error').text('')
                    $($('.form-group #is_warehouse_active').prev()[zeroConst]).find('.select2-choice').css('border-color', '#1cc88a')
                }

                if (errors.birthday) {
                    $('#birthday_error').text(errors.birthday[zeroConst])
                    $('#birthday').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#birthday_error').text('')
                    $('#birthday').removeClass('is-invalid').addClass('is-valid');
                }

                if (errors.gender_id) {
                    $('#gender_id_error').text(errors.gender_id[zeroConst])
                    $($('.form-group #gender_id').prev()[zeroConst]).find('.select2-choice').css('border-color', '#e74a3b')
                } else {
                    $('#gender_id_error').text('')
                    $($('.form-group #gender_id').prev()[zeroConst]).find('.select2-choice').css('border-color', '#1cc88a')
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