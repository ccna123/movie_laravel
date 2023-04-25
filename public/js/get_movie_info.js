$(document).ready(function () {
    const apikey = "f8a39784";
    const params = new URLSearchParams(window.location.search);
    let movie_id = params.get("movie_id");
    getMovies(movie_id, apikey);
});

function getMovies(movie_id, apikey){
    axios.get("http://www.omdbapi.com/?i=" + movie_id + "&apikey=" + apikey)
    .then((response) => {
   
    let movies = response.data;
    let rating_table = "";

    movies.Ratings.forEach(element => {
        rating_table = `<tr>
        <td>${element.Source}</td>
        <td>${element.Value}</td>
        </tr>`
    });
    
    let output = `
    <div class="card mx-sm-auto w-auto" style="width: 18rem;">
        <img src="${movies.Poster}" class="card-img-top img-fluid" alt="...">
        <div class="card-body bg-dark text-white">
            <p class="card-text">${movies.Plot}</p>
            <a href="/" class="btn btn-info text-white d-block">Go back</a>
        </div>
    </div>

<div class="info_wrapper w-75 w-100">
    <div class="inner p-lg-5 text-center" style="width: 100%; min-width: 100%;">
        <h1>${movies.Title}</h1>
        <div class="movie_info w-50 mx-auto">
        <ul class="list-group">
        <li class="list-group-item">Year: ${movies.Year}</li>
        <li class="list-group-item">Rated: ${movies.Rated}</li>
        <li class="list-group-item">Released: ${movies.Released}</li>
        <li class="list-group-item">Duration: ${movies.Runtime}</li>
        <li class="list-group-item">Genre: ${movies.Genre}</li>
      </ul>
        <div class="starring d-flex">
            <p>Starring: ${movies.Actors}</p>
        </div>
        <div class="rating">
            <h1>Ratings</h1>
            <div class="rating_info">
                <table class="table">
                    <thead>
                        <tr>
                          <th>Source</th>
                          <th>Score</th>  
                        </tr>
                    </thead>
                    <tbody>
                        ${rating_table}
                        <tr>
                            <td>Metascore</td>
                            <td>${movies.Metascore}</td>
                        </tr>
                        <tr>
                            <td>imdbRating</td>
                            <td>${movies.imdbRating}</td>
                        </tr>
                        <tr>
                            <td>imdbVotes</td>
                            <td>${movies.imdbVotes}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <a href="/seat?movie_id=${movie_id}" class="btn btn-success">Book</a>
    </div>
</div>`;
    $(".container").append(output);
    })
    .catch((err)=>{
    console.log(err);
    })
}