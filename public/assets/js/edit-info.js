$(document).ready(function () {
    $(document).on("click", ".edit-birthday", function () {
        $('.birthday-info').empty();
        $('.birthday-info').append(`<div class="form-inline">
                            <div class="form-group mb-2">
                                <input type="date" class="form-control" id="birthday">
                            </div>
                            <button class="btn btn-primary shadow-sm mb-2 mx-3 update-birthday">Cập nhật</button>
                            <span id="validate-birthday-error" class="text-danger small"></span>
                        </div>`);
    })
    $(document).on("click", ".edit-email", function () {
        $('.email-info').empty();
        $('.email-info').append(`<div class="form-inline">
                            <div class="form-group mb-2">
                                <input type="text" class="form-control" id="email">
                            </div>
                            <button class="btn btn-primary shadow-sm mb-2 mx-3 update-email">Cập nhật</button>
                            <span id="validate-email-error" class="text-danger small"></span>
                        </div>`);
    })
    $(document).on("click", ".edit-name", function () {
        $('.name-info').empty();
        $('.name-info').append(`<div class="form-inline">
                            <div class="form-group mb-2">
                                <input type="text" class="form-control" id="name">
                            </div>
                            <button class="btn btn-primary shadow-sm mb-2 mx-3 update-name">Cập nhật</button>
                            <span id="validate-name-error" class="text-danger small"></span>
                        </div>`);
    })
    $(document).on("click", ".edit-username", function () {
        $('.username-info').empty();
        $('.username-info').append(`<div class="form-inline">
                            <div class="form-group mb-2">
                                <input type="text" class="form-control" id="username">
                            </div>
                            <button class="btn btn-primary shadow-sm mb-2 mx-3 update-username">Cập nhật</button>
                            <span id="validate-username-error" class="text-danger small"></span>
                        </div>`);
    })
    $(document).on("click", ".update-birthday", function () {
        const birthday =  $('#birthday').val();
        $.ajax({
            url: linkOrigin + "/update-birthday",
            type: "PUT",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                birthday: birthday,
            },
            success: function (success) {
                ToastTopRight.fire({
                    icon: success.status,
                    title: success.msg,
                });
                $('.birthday-info').empty();
                $('.birthday-info').append(`<i class="fas fa-birthday-cake text-primary"></i>
                    <strong class="text-primary mx-2">Sinh nhật:</strong>` + birthday + `<a href="#" class="edit-birthday"><i class="fas fa-pen text-primary mx-2"></i></a>`);
            },
            error: function (error) {
                let notification = error.responseJSON;
                notification.errors.birthday ? $('#validate-birthday-error').text(notification.errors.birthday[zero]) : $('#validate-birthday-error').text('');
            },
        });
    })
    $(document).on("click", ".update-email", function () {
        const email =  $('#email').val();
        const id =  $('.auth-id').val();
        $.ajax({
            url: linkOrigin + "/update-email",
            type: "PUT",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                email: email,
                id: id
            },
            success: function (success) {
                ToastTopRight.fire({
                    icon: success.status,
                    title: success.msg,
                });
                $('.email-info').empty();
                $('.email-info').append(`<i class="fas fa-envelope text-primary"></i> 
                    <strong class="text-primary mx-2">Email:</strong>`+ email +`<a href="#" class="edit-email"><i class="fas fa-pen text-primary mx-2"></i></a>`);
            },
            error: function (error) {
                let notification = error.responseJSON;
                notification.errors.email ? $('#validate-email-error').text(notification.errors.email[zero]) : $('#validate-email-error').text('');
            },
        });
    })
    $(document).on("click", ".update-name", function () {
        const name =  $('#name').val();
        $.ajax({
            url: linkOrigin + "/update-name",
            type: "PUT",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                name: name,
            },
            success: function (success) {
                ToastTopRight.fire({
                    icon: success.status,
                    title: success.msg,
                });
                $('.name-info').empty();
                $('.name-info').append(`<i class="fas fa-id-badge text-primary"></i> 
                        <strong class="text-primary mx-2">Họ và tên:</strong> `+ name +` <a href="#" class="edit-name"><i class="fas fa-pen text-primary mx-2"></i></a>`);
            },
            error: function (error) {
                let notification = error.responseJSON;
                notification.errors.name ? $('#validate-name-error').text(notification.errors.name[zero]) : $('#validate-name-error').text('');
            },
        });
    })
    $(document).on("click", ".update-username", function () {
        const username =  $('#username').val();
        const id =  $('.auth-id').val();
        $.ajax({
            url: linkOrigin + "/update-username",
            type: "PUT",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                username: username,
                id: id,
            },
            success: function (success) {
                ToastTopRight.fire({
                    icon: success.status,
                    title: success.msg,
                });
                $('.username-info').empty();
                $('.username-info').append(`<i class="fas fa-user text-primary"></i> 
                        <strong class="text-primary mx-2">Tên đăng nhập:</strong>`+ username +`<a href="#" class="edit-username"><i class="fas fa-pen text-primary mx-2"></i></a>`);
            },
            error: function (error) {
                let notification = error.responseJSON;
                notification.errors.username ? $('#validate-username-error').text(notification.errors.username[zero]) : $('#validate-username-error').text('');
            },
        });
    })
});