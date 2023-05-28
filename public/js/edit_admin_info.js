$(document).ready(function () {
    $('#edit_name').click(function (e) {
        e.preventDefault();
        let icon = $('#edit_name').find('i');
        if (icon.hasClass('fa-solid fa-pen')) {
            $('#inputName').removeAttr('disabled');
            icon.removeClass('fa-solid fa-pen').addClass('fa-solid fa-check text-success fa-2xl');
        } else {
            $('#inputName').attr('disabled', 'disabled');
            icon.removeClass('fa-solid fa-check text-success fa-2xl').addClass('fa-solid fa-pen');
            $.ajax({
                type: "POST",
                url: "/update_admin_name",
                data: {
                    name: $('#inputName').val(),
                },
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                dataType: "json",
                success: function (response) {
                    $("#mess").append(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Update name successfully.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                    setTimeout(() => {
                        $('#mess').remove();
                    }, 3000);
                }
            });
        }

    });

    $('#edit_email').click(function (e) {
        e.preventDefault();
        let icon = $('#edit_email').find('i');
        if (icon.hasClass('fa-solid fa-pen')) {
            $('#inputEmail').removeAttr('disabled');
            icon.removeClass('fa-solid fa-pen').addClass('fa-solid fa-check text-success fa-2xl');
        } else {
            $('#inputEmail').attr('disabled', 'disabled');
            icon.removeClass('fa-solid fa-check text-success fa-2xl').addClass('fa-solid fa-pen');
            $.ajax({
                type: "POST",
                url: "/update_admin_email",
                data: {
                    email: $('#inputEmail').val(),
                },
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                dataType: "json",
                success: function (response) {
                    $("#mess").append(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Update email successfully.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                    setTimeout(() => {
                        $('#mess').remove();
                    }, 3000);
                }
            });
        }

    });
});