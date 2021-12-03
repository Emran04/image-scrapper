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
      <form action="/get-image.php">
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
</body>

</html>
