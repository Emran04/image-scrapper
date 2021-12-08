<?php

require_once './http.php';
require_once './html-parser.php';

// Starting clock time in seconds
$start_time = microtime(true);

$url = $_GET['url'];

$error = null;

$imageList = [];

$regex = "((https?|ftp)\:\/\/)?";
$regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?";
$regex .= "([a-z0-9-.]*)\.([a-z]{2,3})";
$regex .= "(\:[0-9]{2,5})?";
$regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?";
$regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?";
$regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?";

if (preg_match("/^$regex$/i", $url)) {
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
