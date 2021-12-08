<?php
// Starting clock time in seconds
$start_time = microtime(true);

require_once './http.php';
require_once './html-parser.php';
require_once './validator.php';

$url = $_GET['url'];

$error = null;

$imageList = [];

if (Validator::validateUrl($url)) {
  $html = HTTP::get($url);

  $imageNodes = HTMLParser::getImageTags($html);

  // Create array of images
  foreach ($imageNodes as $node) {
    if ($node->getAttribute('src')) {
      $imageList[] = [
        'url' => $node->getAttribute('src'),
        'alt' => $node->getAttribute('alt'),
      ];
    }
  }
} else {
  $error = 'Url is not valid.';
}

// End clock time in seconds
$end_time = microtime(true);

// Calculate script execution time
$execution_time = ($end_time - $start_time);

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="./bootstrap.min.css" rel="stylesheet">

  <title>Show images</title>
</head>

<body>
  <div class="container">
    <a href="/">Back</a>

    <div class="row justify-content-center">
      <div class="col-4 text-center">
        <?php if ($error) { ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
          </div>
        <?php } ?>

        <p><?php echo "Loading Time: " . round($execution_time, 2) . " sec"; ?></p>
      </div>
    </div>

    <div>
      <div class="row" id="images-container"></div>

      <div class="row">
        <div class="col">
          <nav class="mt-4">
            <ul class="pagination" id="pagination"></ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <script>
    window.data = <?php echo json_encode($imageList) ?>
  </script>
  <script src="./app.js"></script>
</body>

</html>
