/********************************
 * QUESTION 1.
 *******************************/
function executeQ1() {
  document.getElementById('my-name').textContent = 'Azeem Michael';
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
  const list = document.getElementById('q2-list');
  for (const item of listItems) {
    const newLi = document.createElement('li');
    newLi.textContent = item;
    list.append(newLi);
  }
}

/********************************
 * QUESTION 3.
 *******************************/
function Person() {
  let name = '';

  this.setName = function(n) {
    name = n;
  };

  this.getName = function() {
    return name;
  };
}

function executeQ3() {
  const list = document.getElementById('q3-list');

  for (const name of ['Scott', 'Matt']) {
    let p = new Person();
    p.setName(name);
    const newLi = document.createElement('li');
    newLi.textContent = p.getName();
    list.append(newLi);
  }
}

/********************************
 * QUESTION 4.
 *******************************/
async function executeQ4() {
  const api_key = '963ebfe51d3641be829b20f4a1f19ca4';
  //The movie api only provies a filename for posters. Please prepend the poster prefix to get the full url. 
  const poster_url_prefix = 'https://image.tmdb.org/t/p/w500';
  const end_point = 'https://api.themoviedb.org/3/trending/movie/day';
  //Please display your result in div#q4-answer.
  const table = document.createElement('table');
  table.className = 'styled-table';
  document.getElementById('q4-answer').appendChild(table);
  const columnHeadings = ['poster_path', 'title', 'overview', 'popularity'];

  // Add the header row
  let header = table.createTHead();
  let row = header.insertRow(-1);
  for (const key of columnHeadings) {
    let headerCell = document.createElement('th');
    if (key !== 'poster_path') {
      headerCell.innerText = key.toUpperCase();
    }
    row.appendChild(headerCell);
  }

  // Create table body
  let tBody = document.createElement('tbody');
  table.appendChild(tBody);

  try {
    const data = await fetch(`${end_point}?api_key=${api_key}`)
        .then(response => {
          if (response.status >= 200 && response.status < 300) {
            return response.json();
          } else {
            return response.json().then(errData => {
              console.error(errData);
              throw new Error('Something went wrong - server side.');
            });
          }
        })
        .catch(error => {
          console.error(error);
          throw new Error('Something went wrong.');
        });
    // Add the data rows to the table body.
    let i = 0;
    for (const movie of data.results) {
      if (i++ === 5) break;
      row = tBody.insertRow(-1);
      for (const key of columnHeadings) {
        let cell = row.insertCell(-1);
        cell.setAttribute('data-label', key);
        if (key === 'poster_path') {
          let newImg = document.createElement('img');
          newImg.setAttribute('src', `${poster_url_prefix}${movie[key]}`);
          newImg.setAttribute('alt', 'na');
          newImg.setAttribute('height', '75%');
          newImg.setAttribute('width', '75%');
          cell.appendChild(newImg);
        } else {
          cell.innerText = movie[key];
        }
      }
    }
  } catch (e) {
    console.error(e);
  }
}