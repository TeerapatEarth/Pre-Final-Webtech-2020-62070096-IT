<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        body{
            background-color: hsl(220, 50%, 70%);
        }
    </style>
</head>

<body>
    <div class="container" style="margin:auto;">
        <form method="post">
            <?php
            $click = false;
            $checksong = true;
            $search = "";
            if (isset($_POST['test'])) {
                $click = true;

                if ($click) {
                    $search = $_POST['text'];
                }
            }
            echo '<h3>ระบุคำค้นหา :</h3><div style="width: 100% ;margin-bottom: 20px"><input id="text" name="text" value="' 
            . $search . '" class="form-control align-center" style="width: 80%; display: inline-block;">
                <button type="submit" name="test" style="margin-left: 15px; width: 100px;">ค้นหา</button></div>';
            ?>

        </form>
        <?php
        $url = "https://dd-wtlab2020.netlify.app/pre-final/ezquiz.json";
        $response = file_get_contents($url);
        $result = json_decode($response);
        $count = 0;
        $found_count = 0;
        echo "<div class='row'>";
        if ($search == "") {
            $checksong = false;
            foreach ($result->tracks->items as $items) {
                echo '<div class="card" style="width: 30%; margin-right: 30px; margin-top: 30px;">';
                foreach ($items->album->images as $image) {
                    if ($image->height == 640) {
                        echo '<img class="card-img-top" src="' . $image->url . '" alt="Card image cap">';
                    }
                }
                echo '<div class="card-body">';
                echo "<p class='card-head'>" . $items->album->name . "</p>";
                foreach ($items->album->artists as $artists) {
                    echo "Artist: " . $artists->name . "<br>";
                }
                echo "Release date: " . $items->album->release_date . "<br>";
                foreach ($items->album->available_markets as $available_markets) {
                    $count++;
                }
                echo "Avaliable : " . $count . " countries<br></div></div>";
            }
        } else {

            foreach ($result->tracks->items as $items) {
                $check = false;
                foreach ($items->album->artists as $artists) {
                    if (strpos(strtolower($artists->name), strtolower($search)) !== false) {
                        $check = true;
                    }
                }
                if (strpos(strtolower($items->album->name), strtolower($search)) !== false || $check) {
                    $found_count++;
                }
            }
            if ($found_count > 0) {
                echo "<div style='width:100%; margin-bottom: 10px;'>ค้นหาเจอทั้งหมด " . $found_count . " รายการ<br></div>";
            }
            foreach ($result->tracks->items as $items) {
                $check = false;
                foreach ($items->album->artists as $artists) {
                    if (strpos(strtolower($artists->name), strtolower($search)) !== false) {
                        $check = true;
                    }
                }
                if (strpos(strtolower($items->album->name), strtolower($search)) !== false || $check) {
                    $check_all = false;
                    echo '<div class="card" style="width: 30%;">';
                    foreach ($items->album->images as $image) {
                        if ($image->height == 640) {
                            echo '<img class="card-img-top" src="' . $image->url . '" alt="Card image cap">';
                        }
                    }
                    echo '<div class="card-body">';
                    echo "<p class='card-head'>" . $items->album->name . "</p>";
                    foreach ($items->album->artists as $artists) {
                        echo "Artist: " . $artists->name . "<br>";
                    }
                    echo "Release date: " . $items->album->release_date . "<br>";
                    foreach ($items->album->available_markets as $available_markets) {
                        $count++;
                    }
                    echo "Avaliable : " . $count . " countries<br></div></div></div>";
                }
            }
        }
        echo "</div>";
        if ($checksong) {
            echo 'Not Found';
        }
        ?>
    </div>
</body>

</html>