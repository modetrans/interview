/********************************
 * QUESTION 1.
 *******************************/
function executeQ1() {
    $("#my-name").append(
        $("<span>", {text: "Bradley Morrical"})
    )
}

/********************************
 * QUESTION 2.
 *******************************/
const listItems = [
    'Settings',
    'Customer Support',
    'On Demand',
    'Search',
    'Widgets'
];

function executeQ2() {
    for (var x in listItems) {
        $("#q2-list").append(
            $("<li>", {text: listItems[x]})
        )
    }
}

/********************************
 * QUESTION 3.
 *******************************/
class Person {
    constructor(name) {
        this.name = name;
    }

    getName() {
        return this.name;
    }
}

function executeQ3() {
    let scott = new Person('Scott');
    let matt = new Person('Matt');

    $("#q3-list").append(
        $("<li>", {text: scott.getName()})
    ).append(
        $("<li>", {text: matt.getName()})
    )
}

/********************************
 * QUESTION 4.
 *******************************/
function executeQ4() {
    const api_key = '963ebfe51d3641be829b20f4a1f19ca4';
    //The movie api only provides a filename for posters. Please prepend the poster prefix to get the full url.
    const poster_url_prefix = 'https://image.tmdb.org/t/p/w500/';

    //Please display your result in div#q4-answer.

    $.ajax({
        url: `https://api.themoviedb.org/3/trending/movie/day?api_key=${api_key}`,
        dataType: 'json',
        success: function (response) {
            let latest = response.results.slice(0, 5);
            let output = latest.map((movie) => {
                return `
                    <img src="${poster_url_prefix + movie.poster_path}" class="poster-art" alt="${movie.title}">
                    <p class="movie-title">
                        Movie Title: ${movie.title}
                    </p>
                    <p class="movie-popularity">
                        Movie Popularity: ${movie.popularity}
                    </p>
                    <p class="movie-overview">
                        Movie Overview: ${movie.overview}
                    </p>
                    <div class="clear"</p>
                `;
            });

            $("#q4-answer").append(
                output.join("")
            );
        }
    })
}
