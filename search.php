<?php
session_start();
include_once('DataPlaylist.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="style/style.css">

    <title>Document</title>
</head>
<?php require "nav-bar.php"; ?>

<body id="cat-bod" style="background-color: rgb(30, 33, 41)">
    <div class="container">
        <div class="row">
            <?php

            include_once("database.php");

            if (!empty($_GET['searchName'])) {
                $searchName = $_GET['searchName'];
                $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
                $query = "SELECT * FROM movie WHERE title LIKE '%$searchName%'";
                $res = mysqli_query($connect, $query);
                while ($row = mysqli_fetch_assoc($res)) {
                    $image = $row['poster_url'];
                    $title = false;
                    if (strlen($image) == 31) {
                        $image = 'https://dummyimage.com/500x750/000/fff';
                        $title = true;
                    } else {
                        $image = $row['poster_url'];
                        $title = false;
                    }
                    if (!$title) {
                        echo '
                <div class="col s3">
                <div class="card">
                <div class="playlistForm">
                <form method="post">
                <input style="display:none;" type="text" name="movieIdHex" value="' . $row['movie_id'] . '">
                <button type="submit" class="playlistbtn" name="addMovPlaylist">Add</button>
                </form>
                </div>
                <a href="details.php?movie_id=' . $row['movie_id'] . '">
                <div class="card-image">
                <img class="poster hoverable" src="' . $image . '">
                </div>
                </a>
                </div>
                <div class="card info">
                <div class="card-content">
                            <p class="info-mov-title">' . $row['title'] . '</p>
                            <p>' . $row['rating'] . '/10' . '</p>
                            <p>' . $row['release_date'] . '</p>
                            <p>' . $row['category'] . '</p>
                            <p>' . 'Synopsis: '  . $row['synopsis'] . '</p>
                        </div>
                    </div>
                </div>';
                    } elseif ($title) {
                        echo '
                <div class="col s3">
                    <div class="card">
                    <div class="playlistForm">
                    <form method="post">
                    <input style="display:none;" type="text" name="movieIdHex" value="' . $row['movie_id'] . '">
                    <button type="submit" class="playlistbtn" name="addMovPlaylist">Add</button>
                    </form>
                        <a href="details.php?movie_id=' . $row['movie_id'] . '">
                            <div class="card-image">
                                <img class="poster hoverable" src="' . $image . '">
                                <span class="card-title">' . $row['title'] . '</span>
                            </div> 
                        </a>       
                    </div>
                    <div class="card info">
                        <div class="card-content">
                        </div>
                            <p class="info-mov-title">' . $row['title'] . '</p>
                            <p>' . $row['rating'] . '/10' . '</p>
                            <p>' . $row['release_date'] . '</p>
                            <p>' . $row['category'] . '</p>
                            <p>' . 'Synopsis: ' . $row['synopsis'] . '</p>
                        </div>
                    </div>
                </div>';
                    }
                }
            }

            ?>
        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="scripts/catalogScript.js"></script>
</body>

</html>