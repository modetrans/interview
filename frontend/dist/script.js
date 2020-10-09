/**
 * Note: jQuery is already included.
 */


/********************************
 * QUESTION 1.
 *******************************/
function executeQ1() {
  $('#my-name').text('Presley Cobb.');
}

/********************************
 * QUESTION 2.
 *******************************/
var listItems = [
  'Settings',
  'Customer Support',
  'On Demand',
  'Search',
  'Widgets'
];

function executeQ2() {
  const ol = $('#q2-list');
  appendToList(ol, listItems);
}

/********************************
 * QUESTION 3.
 *******************************/
function Person(name) {
  this.name = name;

  this.setName = function(n) {
    name = n;
  };

  this.getName = function() {
    return name;
  }
}

function executeQ3() {
  const Scott = new Person('Scott');
  const Matt = new Person('Matt');
  const ol = $('#q3-list');
  //Alternatively you can create the instance call setName on that instance then get the name value from that instance using getName. That approach has the advantage of keeping the name property private and only ahttps://codepen.io/pen/ccessible via the getName method assumming you define name with var.
  const names = [Scott.name, Matt.name];
  appendToList(ol, names)
}

/********************************
 * QUESTION 4.
 *******************************/
async function executeQ4() {
  var fileURL = 'https://hydracdn.frontiertv.com/widgets/common/ch131images.json';
  
  // Save image IDs in the data array.
  //var data = [];
  
  // Get the data in fileURL using AJAX, process the reponse and add it to the HTML.
  const response = await fetch(fileURL);
  const data = await response.json();
  const keys = Object.keys(data.images);
  const string = [JSON.stringify(keys)];
  const node = $('#q4-answer');
  appendToList(node, string);
}
/********************************
 * HELPER
 *******************************/
//Defining a helper here to keep the code DRY;
const appendToList = (node, list) => {
  list.forEach( item => node.append(`<li>${item}</li>`));
}