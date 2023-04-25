$(document).ready(function () {
    $(".cancel_btn").click(function (e) { 
        e.preventDefault();
        let movie_name = $(this).data("movie-name");
        let cus_email = $(this).data("cus-email");
        let movie_row = $(this).closest("tr");
       $.ajax({
        type: "POST",
        url: "/cancel",
        data: {
            name:movie_name,
            cus_email:cus_email
        },
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        },
        dataType: "json",
        success: function (response) {
            $("#mess").append(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Cancel successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            `);

            movie_row.remove();
        }
       });
    });
});