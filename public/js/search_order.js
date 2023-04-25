$(document).ready(function () {
    $("#search_order").click(function (e) { 
        e.preventDefault();
        let order_email = $("input").val();
        $.ajax({
            type: "get",
            url: "/search_order?email=" + order_email,
            dataType: "json",
            success: function (response) {
                if (response.mess == "Not found") {
                    alert("Not found");
                } else {
                    
                    $("tbody").empty();
                    let index = 1;
                    response.data.forEach(element => {
                        let output = `
                        <tr>
                            <th scope="row">${index}</th>
                            <td>${element.movie_name}</td>
                            <td>${element.cus_name}</td>
                            <td>${element.cus_email}</td>
                            <td>${element.seat_code}</td>
                            <td>$${element.ticket_fee_total}</td>
                            <td>  
                                <a href="/generate_ticket?email=${element.cus_email}" class="btn btn-info text-white">generate_ticket</a>
                                <a href="/cancel?email=${element.cus_email}" class="btn btn-danger">Cancel</a>

                            </td>
                        </tr>
                        `
                        $("tbody").append(output);
                        index++;
                    });
                }
            }
        });
    });
});