$(document).ready(function () {
    let apikey = ''
    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/api/get_api_key",
        dataType: "json",
        success: function (response) {
            apikey = response.api
        }
    });
    $.ajax({
        type: "GET",
        url: "/get_movies",
        dataType: "json",
        success: function (response) {
            response.movies.forEach(movie => {
                getMovies(movie.imdb_id, apikey, movie.ticket_fee, movie.id);
            });
        },
        error: function (xhr, textStatus, errorThrown) {
            console.log(xhr.responseText);
        }
    });
});

function getMovies(imdb_id, apikey, ticket_fee, id) {
    axios.get("http://www.omdbapi.com/?i=" + imdb_id + "&apikey=" + apikey)
        .then((response) => {

            let movies = response.data;
            let output = "";
            output += `
    <div class="col-lg-4 col-md-6 col-12 p-4">
        <div class="card" style="width: 18rem;">
            <div>
                <img src="${movies.Poster}" class="card-img-top img-fluid" style="width: 500px; height: 500px;">
            </div>
            <hr>
            <div class="card-body">
                <div>
                    <h5 class="card-title">${movies.Title}</h5>
                </div>
                <div>
                    <p class="card-text">${movies.Plot}</p>
                </div>
                <div>
                    <p class="card-text mt-4 fw-bold h1">Ticket: $${ticket_fee}</p>
                </div>
                <hr>
                <div class="text-center">
                    <a href="/info?movie_id=${imdb_id}" class="btn btn-primary d-block">Info</a>
                    <a href="/seat?movie_id=${id}" class="btn btn-success d-block mt-4">Book</a>
                </div>
            </div>
        </div>
    </div>
    `;

            $("#movie .row").append(output);
        })
        .catch((err) => {
            console.log(err);
        })
}