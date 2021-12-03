<?php

imagecreatefromjpeg('./shoe.jpg');

$url = $_GET['url'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$html = curl_exec($ch);

$dom = new DOMDocument();
@$dom->loadHTML($html);

$imageNodes = $dom->getElementsByTagName('img');

$perPage = 8;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$total = $imageNodes->length;

$imagesArray = iterator_to_array($imageNodes);

$offset = intval($page) * $perPage;

$currentImages = array_slice($imagesArray, $offset, $perPage);

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

    <div class="row">
      <?php foreach ($currentImages as $image) { ?>
        <div class="col-3">
          <img class="img-fluid" src="<?php echo $image->getAttribute('src') ?>" alt="">
        </div>
      <?php } ?>

      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="#">Previous</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="<?php echo '/get-image.php?url=' . $_GET['url'] . '&page=' . ($page + 1) ?>">Next</a></li>
        </ul>
      </nav>
    </div>
  </div>
</body>

</html>
