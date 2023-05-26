$(document).ready(function () {

    const params = new URLSearchParams(window.location.search);
    let movie_id = params.get("movie_id");
    const row = document.querySelectorAll("tbody a i")
    let seat_array = new Array()

    $.ajax({
        type: "GET",
        url: "/checking_order",
        data: {
            movie_id: movie_id
        },
        dataType: "json",
        success: function (response) {
            let seat_list = response.seat_list.split(",");
            row.forEach(element => {
                if (seat_list.includes(element.id)) {
                    element.style.color = "red";
                    element.style.pointerEvents = "none";
                    element.parentNode.style.cursor = "not-allowed";
                }
            });
        }
    });

    row.forEach(element => {


        element.addEventListener("click", () => {

            if (element.classList.contains("ordered")) {
                element.classList.remove("ordered")
                element.style.color = null

                let index = seat_array.indexOf(element.id)
                seat_array.splice(index, 1)
            } else {
                element.classList.add("ordered")
                element.style.color = "green"

                seat_array.push(element.id);
            }
            $("#seat_code").val(seat_array.join(", "));

        });
    });

    $("#order").click(function (e) {
        e.preventDefault();
        let cus_name = $("#cus_name").val();
        let cus_email = $("#cus_email").val();
        let seat_code = $("#seat_code").val();
        $.ajax({
            type: "POST",
            url: "/booking",
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            data: {
                cus_name: cus_name,
                cus_email: cus_email,
                seat_code: seat_code,
                movie_id: movie_id
            },
            dataType: "html",
            success: function () {
                alert("Order successfully. You can check your order by pressing check booking")
            }
        });
    });
});