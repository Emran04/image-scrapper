<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="./bootstrap.min.css" rel="stylesheet">

  <title>Home page</title>
</head>

<body>
  <div class="container mt-5">
    <div class="search-form">
      <form action="/get-image.php" id="form">
        <div class="row justify-content-center">
          <div class="col-6">
            <input type="text" name="url" id="url-field" class="form-control" placeholder="Give url">
            <div id="error" class="invalid-feedback">fsd</div>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-4 mt-3 text-center">
            <button type="submit" class="btn btn-primary mb-3">Get images</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    const form = document.getElementById('form');

    form.addEventListener('submit', (e) => {
      e.preventDefault()
      let urlValue = form.elements['url'].value
      if (validURL(urlValue)) {
        form.submit()
      } else {
        var errorContainer = document.getElementById('error')
        errorContainer.innerHTML = 'Url is not valid!'
        document.getElementById('url-field').classList.add("is-invalid")
      }
    });

    function validURL(str) {
      var pattern = new RegExp('^(https?:\\/\\/)?' +
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' +
        '((\\d{1,3}\\.){3}\\d{1,3}))' +
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' +
        '(\\?[;&a-z\\d%_.~+=-]*)?' +
        '(\\#[-a-z\\d_]*)?$', 'i');
      return !!pattern.test(str);
    }
  </script>
</body>

</html>
