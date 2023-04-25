$(document).ready(function () {
    $("#login").click(function (e) { 
        e.preventDefault();
        let email = $("#email").val();;
        $.ajax({
            type: "POST",
            url: "/login",
            data: {
                email:email
            },
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            dataType: "json",
            success: function (response) {
                if (response.status == "success") {
                    let timeRemain = 3;
                    const interval = setInterval(() => {
                        timeRemain--;
                        $(".alert-message").text(`The page will redirect to home page after ${timeRemain}s`);
                        if (timeRemain == 0) {
                            clearInterval(interval);
                            window.location.href = "/";
                        }
                    }, 1000);

                    $("#mess").append(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Login successfully. <span class="alert-message">The page will redirect to home page after ${timeRemain}s</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    `);
                    setTimeout(() => {
                        window.location.href = "/";
                    }, 3000);
                } else {
                    $("#mess").append(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Login fail
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    `);
                }
            }
        });
    });
});