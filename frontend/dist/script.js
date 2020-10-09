/********************************
 * QUESTION 1.
 *******************************/
function executeQ1() {
  $('#my-name').html('Gabriel A. Quiles-P&eacute;rez');
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
  const listElement = $('#q2-list');
  listItems.forEach(function (item) {
    const newNode = createListItem(item);
    listElement.append(newNode);
  });
}

/********************************
 * QUESTION 3.
 *******************************/
// Since the instructions mentioned to create a new Person class, I took the liberty of updating it to ES6 format in this case
class Person {
  name = '';

  constructor(name) {
    this.name = name;
  }

  setName = (n) => {
    this.name = n;
  };

  getName = () => {
    return this.name;
  };
}

function executeQ3() {
  const people = [
    new Person('Scott'),
    new Person('Matt')
  ];

  const list = $('#q3-list');

  people.forEach(function (person) {
    const newNode = createListItem(person.getName());
    list.append(newNode);
  });
}

/********************************
 * QUESTION 4.
 *******************************/
async function executeQ4() {
  const moviesContainer = $('div#q4-answer');
  const top5Movies = await getMostPopularMovies(5);
  top5Movies.forEach(movie => {
    const renderedMovie = movieComponent(movie);
    moviesContainer.append(renderedMovie);
  });
  //Please display your result in div#q4-answer.
}

/**************************************/
function createListItem(content) {
  const newNode = document.createElement('li');
  newNode.innerText = content;
  return newNode;
}

/**
 *  Get the top movies sorted by popularity. If no argument is provided should return all movies returned from the API
 * @param n Number of movies to return
 * @returns Array of movies
 */
async function getMostPopularMovies(n) {
  const api_key = '963ebfe51d3641be829b20f4a1f19ca4';
  const dailyTrendingMovies = await $.ajax(`https://api.themoviedb.org/3/trending/movie/day?api_key=${api_key}`)
    .then(response => response.results);
  return dailyTrendingMovies
    .sort((firstEl, secondEl) => (secondEl.popularity - firstEl.popularity))
    .slice(0, n);
}

/**
 * Creates the HTML element to render a single moview
 * @param movie
 * @returns {HTMLDivElement}
 */
function movieComponent(movie) {
  //The movie api only provies a filename for posters. Please prepend the poster prefix to get the full url.
  const poster_url_prefix = 'https://image.tmdb.org/t/p/w500/';
  const singleMovieContainer = createElementWithClass('div', 'movie');

  const backdrop = createElementWithClass('img', 'backdrop');
  backdrop.src = `${poster_url_prefix}${movie.backdrop_path}`;
  singleMovieContainer.appendChild(backdrop);

  const posterHolder = createElementWithClass('div', 'poster-holder');
  singleMovieContainer.appendChild(posterHolder);

  const poster = createElementWithClass('img', 'poster');
  poster.src = `${poster_url_prefix}${movie.poster_path}`;
  posterHolder.appendChild(poster);

  const movieDetails = createElementWithClass('div', 'details');
  singleMovieContainer.appendChild(movieDetails);

  const title = createElementWithClass('h3', 'title');
  title.innerText = movie.original_title;
  movieDetails.appendChild(title);

  const popularity = createElementWithClass('span', 'popularity');
  popularity.innerText = `Popularity: ${movie.popularity}`;
  movieDetails.appendChild(popularity);

  const summaryContainer = createElementWithClass('div', 'summary-container');
  movieDetails.appendChild(summaryContainer);

  const summary = createElementWithClass('p', 'summary');
  summary.innerText = movie.overview;
  summaryContainer.appendChild(summary);

  return singleMovieContainer;
}

function createElementWithClass(tagName, className) {
  const node = document.createElement(tagName);
  node.className = className;
  return node;
}