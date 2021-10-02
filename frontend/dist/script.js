/********************************
 * QUESTION 1.
 *******************************/
function executeQ1() {
  document.querySelector('#my-name').innerHTML = 'Jeremy Kastner';
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
  let items = listItems.map((item) => {
    return `<li>${item}</li>`;
  });

  document.querySelector('#q2-list').innerHTML = items.join('');
}

/********************************
 * QUESTION 3.
 *******************************/
class Person {
  constructor(name) {
    this.name = name;
  }

  setName(newName) {
    this.name = newName;
  }

  getName() {
    return this.name;
  }
}

function executeQ3() {
  let scott = new Person('Scott');
  let matt = new Person('Matt');

  document.querySelector('#q3-list').innerHTML = `
    <li>${scott.getName()}</li>
    <li>${matt.getName()}</li>
  `;
}

/********************************
 * QUESTION 4.
 *******************************/
function executeQ4() {
  const api_key = '963ebfe51d3641be829b20f4a1f19ca4';
  //The movie api only provies a filename for posters. Please prepend the poster prefix to get the full url. 
  const poster_url_prefix = 'https://image.tmdb.org/t/p/w500/';
  
  let url = `https://api.themoviedb.org/3/trending/movie/day?api_key=${api_key}`;

  $.ajax({
    url,
    dataType: 'json',
    success(data, textStatus, xhr) {
      if(data.results.length === 0) {
        alert('No results when loading trending movies.');
        return;
      }

      // Keep the top 5 results
      let movies = data.results.slice(0, 5);

      let moviesHtml = movies.map((movie) => {
        return `
            <div class="movie-block">
                <img src="${poster_url_prefix + movie.poster_path}" class="movie-poster" alt="Movie Poster"/>
                <div>
                  <h3 class="movie-title">
                    ${movie.title}
                  </h3>
                  <dl class="movie-info-list">
                    <dt>Popularity Score</dt>
                    <dd>${movie.popularity}</dd>
                    <dt>Overview</dt>
                    <dd>${movie.overview}</dd>
                  </dl>
                </div>
            </div>
        `;
      });

      document.querySelector('#q4-answer').innerHTML = moviesHtml.join("");
    },
    error(xhr, textStatus, error) {
      let msg = `Error ${xhr.status} when getting movie data.`;

      if(xhr.responseJSON) {
        msg += "\n" + xhr.responseJSON.status_message;
      }

      alert(msg);
    }
  });
}