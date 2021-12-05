<?php

// Starting clock time in seconds
$start_time = microtime(true);

// $directory = './images/';
// $images = glob($directory."*.jpg");

// foreach($images as $image) {
//     $im_php = imagecreatefromjpeg($image);
//     $im_php = imagescale($im_php, 400);
//     $new_height = imagesy($im_php);
//     imagejpeg($im_php, $directory.'resize/'. basename($image));
// }

// $url = 'https://deencommerce.com/wp-content/uploads/2021/12/tufts-blue-jeans-029-1.jpg';
// $img = './images/' . basename($url);
// file_put_contents($img, file_get_contents($url));

$url = $_GET['url'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$html = curl_exec($ch);

$dom = new DOMDocument();
@$dom->loadHTML($html);

$imageNodes = $dom->getElementsByTagName('img');

// Create array of images
$imageList = [];
foreach ($imageNodes as $node) {
  if ($node->getAttribute('src')) {
    // $tmpFile = file_get_contents($node->getAttribute('src'));
    $imageList[] = [
      'url' => $node->getAttribute('src'),
      'alt' => $node->getAttribute('alt'),
    ];
  }
}

$perPage = 8;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$total = $imageNodes->length;

$imagesArray = iterator_to_array($imageNodes);

$offset = intval($page) * $perPage;

$currentImages = array_slice($imagesArray, $offset, $perPage);

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
    <h3>All images</h3>

    <p><?php echo "Loading Time: ". round($execution_time, 2) ." sec"; ?></p>

    <div>

      <div class="row" id="images-container"></div>

      <nav aria-label="Page navigation example">
        <ul class="pagination" id="pagination"></ul>
      </nav>
    </div>
  </div>
  <script>
    window.data = <?php echo json_encode($imageList) ?>
  </script>
  <script src="./app.js"></script>
</body>

</html>
