<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>1</title>
</head>

<body>
    <div class="container">
        <?php
        $url = "https://dd-wtlab2020.netlify.app/pre-final/ezquiz.json";
        $response = file_get_contents($url);
        $result = json_decode($response);
        $count = 0;
        echo "<div class='row'>";
        foreach ($result->tracks->items as $items) {
            echo "<div class='col-md-4'>";
            echo "<div class='card' style='width: 100%; margin-bottom: 20px'>";
            foreach ($items->album->images as $image) {
                if ($image->height == 640) {
                    echo "<img class='card-img-top' src='" . $image->url . "' alt='Card image cap'>";
                }
            }
            echo "<div class='card-body'><p class='card-head'>".$items->album->name . "</p>";
            foreach ($items->album->artists as $artists) {
                echo "Artist: " . $artists->name . "<br>";
            }
            echo "Release date: " . $items->album->release_date . "<br>";
            foreach ($items->album->available_markets as $available_markets) {
                $count++;
            }
            echo "Avaliable : " . $count . " countries<br></div></div></div>";
        }
        ?>
    </div>
</body>

</html>