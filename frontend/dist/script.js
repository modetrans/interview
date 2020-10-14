function make_list_item(value) {
  let li = $("<li></li>");
  li.text(value);
  return li;
}

function add_list_item(name, item) {
  $("#" + name).append(make_list_item(item));
}

/********************************
 * QUESTION 1.
 *******************************/
function executeQ1() {
  $("#my-name").text("Jeff White");
}

/********************************
 * QUESTION 2.
 *******************************/
const listItems = [
  "Settings",
  "Customer Support",
  "On Demand",
  "Search",
  "Widgets",
];

function executeQ2() {
  for (item in listItems) {
    add_list_item("q2-list", listItems[item]);
  }
}

/********************************
 * QUESTION 3.
 *******************************/
class Person {
  constructor() {
    this.name = "";
  }

  setName = function (n) {
    this.name = n;
  };

  getName = function () {
    return this.name;
  };
}

function executeQ3() {
  let scott = new Person();
  scott.setName("Scott");
  let matt = new Person();
  matt.setName("Matt");
  let persons = [scott.getName(), matt.getName()];

  for (name in persons) {
    add_list_item("q3-list", persons[name]);
  }
}

/********************************
 * QUESTION 4.
 *******************************/
function executeQ4() {
  const api_key = "963ebfe51d3641be829b20f4a1f19ca4";
  //The movie api only provies a filename for posters. Please prepend the poster prefix to get the full url.
  const poster_url_prefix = "https://image.tmdb.org/t/p/w500/";

  //Please display your result in div#q4-answer.
  url = "https://api.themoviedb.org/3/trending/movie/day?api_key=" + api_key;

  get_movies(url).then((data) => {
    let movies = data.results;
    sort_movies_by_popularity(movies);
    let top_movies = movies.slice(0, 5);
    for (let movie in top_movies) {
      render_top_movie(top_movies[movie]);
    }
    render_attribution();
  });

  async function get_movies(url) {
    let movie_data = await fetch(url);

    return await movie_data.json();
  }

  function sort_movies_by_popularity(movies) {
    movies.sort((a, b) => {
      if (a && b) {
        return b.popularity - a.popularity;
      }
    });
  }
  function render_top_movie(top_movie) {
    //The movie api only provies a filename for posters. Please prepend the poster prefix to get the full url.
    const poster_url_prefix = "https://image.tmdb.org/t/p/w500/";

    let container = $("#q4-answer");
    let wrapper = $('<div class="top-movie-wrapper">');
    container.append(wrapper);

    let poster = $('<div class="top-movie-poster">');
    let poster_img = $("<img />");
    poster_img
      .attr("src", poster_url_prefix + top_movie.poster_path)
      .attr("width", "100px")
      .attr("height", "150px");

    poster.append(poster_img);
    wrapper.append(poster);

    let title = $('<div class="top-movie-title">');
    title.text(top_movie.title);
    wrapper.append(title);

    let popularity = $('<div class="top-movie-popularity">');
    popularity.html(
      'Popularity:<br/><span class="popularity">' +
        top_movie.popularity +
        "</span>"
    );
    wrapper.append(popularity);

    let overview = $('<div class="top-movie-overview">');
    overview.text(top_movie.overview);
    wrapper.append(overview);
  }

  function render_attribution() {
    let attribution = $('<div class="tmdb-attribution">');
    attribution_logo = $("<img>");
    attribution_logo
      .attr(
        "src",
        "https://www.themoviedb.org/assets/2/v4/logos/v2/blue_square_2-d537fb228cf3ded904ef09b136fe3fec72548ebc1fea3fbbd1ad9e36364db38b.svg"
      )
      .attr("width", "50px")
      .attr("height", "75px");
    attribution.append(attribution_logo);

    let attribution_content = $("<p>");
    attribution_content.text(
      "Images/data: The Movie DB (https://www.themoviedb.org/)"
    );
    attribution.append(attribution_content);

    $("#q4-answer").append(attribution);
  }
}
