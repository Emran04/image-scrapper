var images = window.data
var page = 1
var perPage = 8

function changePage(pageValue) {
  page = pageValue
  // Validate page
  if (page < 1) page = 1;
  if (page > totalPages()) page = totalPages();

  var imageContainer = document.getElementById('images-container')

  imageContainer.innerHTML = "";

  for (var i = (page - 1) * perPage; i < (page * perPage); i++) {
    imageContainer.innerHTML += `<div class="col-3">
      <img class="img-fluid" src="${images[i].url}" alt="${images[i].alt}">
      <div></div>
    </div>`;
  }

  var imgs = document.getElementsByTagName('img')

  for (let index = 0; index < imgs.length; index++) {
    let element = imgs[index];
    element.addEventListener('load', loaded)
  }

  function loaded() {
    var sizeContainer = this.nextElementSibling
    sizeContainer.innerHTML = `Dimension: ${this.naturalHeight}x${this.naturalWidth}`
  }

  renderPaginationNumbers()
}

function nextPage() {
  if (page < totalPages()) {
    page++;
    changePage(page);
  }
}

function prevPage() {
  if (page > 1) {
    page--;
    changePage(page);
  }
}

function totalPages() {
  return Math.ceil(images.length / perPage);
}

function renderPaginationNumbers() {
  var paginationContainer  = document.getElementById('pagination')
  paginationContainer.innerHTML = ''
  var items = `<li class="page-item"><a class="page-link" href="javascript:prevPage()">Previous</a></li>`
  var numberOfPages = totalPages()
  for (var i = 1; i <= numberOfPages; i++) {
    var itemClass = i === page ? 'page-item active' : 'page-item'
    items += `<li class="${itemClass}"><a class="page-link" href="javascript:changePage(${i})">${i}</a></li>`
  }
  items += `<li class="page-item"><a class="page-link" href="javascript:nextPage()">Next</a></li>`
  paginationContainer.innerHTML = items
}

window.onload = function () {
  changePage(1);
};
