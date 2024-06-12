$(document).on("click", ".edit_user", function () {
    const id = $(this).attr("id");
    $.ajax({
        url: linkUser + "edit",
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        data: {
            id: id
        },
        success: function (success) {
            console.log(success);
            $('#username_e').val(success.username);
            $('#name_e').val(success.name);
            $('#email_e').val(success.email);
            $('#company_e').val(success.company);
            $('#role_code_e').find('option[value=' + success.role_code + ']').attr('selected', 'selected');
            $('#department_code_e').find('option[value=' + success.department_code + ']').attr('selected', 'selected');
            $('#status_id_e').find('option[value=' + success.status_id + ']').attr('selected', 'selected');
            $('#gender_id_e').find('option[value=' + success.gender_id + ']').attr('selected', 'selected');
            $('#EmployeeCode_e').val(success.EmployeeCode);
            $('#body_edit').append(`<div class="form-group col-md-6">
                <button type="button" id="delete_avatar" class="btn btn-danger btn-circle position-absolute m-3"><i class="fas fa-trash-alt"></i></button>
                <img src="` + linkOrigin + "/" + success.avatar + `" id="flex_avatar" class="img-thumbnail position-relative" alt="Đây không phải là file ảnh"/>
            </div>`)
            listUser.ajax.reload();
        },
        error: function (error) {
            let errors = error.responseJSON.errors;
            ToastTopRight.fire({
                icon: errors.status,
                title: errors.msg,
            });
        },
    });
})