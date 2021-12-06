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
  <div class="container">
    <h3>Image viewer</h3>

    <div class="search-form">
      <form action="/get-image.php" id="form">
        <div class="m1-3">
          <label for="exampleFormControlInput1" class="form-label">Url</label>
          <input type="text" name="url" class="form-control" id="exampleFormControlInput1" placeholder="url">
        </div>

        <div class="col-auto">
          <button type="submit" class="btn btn-primary mb-3">Submit</button>
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
