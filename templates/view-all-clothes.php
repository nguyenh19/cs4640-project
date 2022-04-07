<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/wardrobe.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="Hien and Rehan">
        <meta name="description" content="Wardrobe Page">
        <meta name="keywords" content="Cyber Style Wardrobe Page">    
        <title>My Wardrobe</title>
    </head>
    <body>
        <nav id = "navbar-ex" class="navbar fixed-top navbar-expand-lg navbar-dark">
            <a class="navbar-brand"
            <?php
                if (isset($_COOKIE["logged_in"]) && $_COOKIE["logged_in"] == "true") {
                    echo "href='?command=wardrobe'";
                } else {
                    echo "href='?command=home'";
                }
            ?> 
            >CYBER STYLE</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto">
                  <li class="nav-item active">
                  <a class="nav-link" href="#CLOSET">MY CLOSET</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="#LOOKBOOK">MY LOOKBOOK</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href = '#WISHLIST'>MY WISHLIST</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href = '?command=logout'>LOGOUT</a>
                  </li>
              </ul>
            </div>
        </nav>
       <!-- <div class = "container">
            <div class = "row">
                <div class = "col d-flex justify-content-center welcome">
                    <h1 class = "welMessage">WELCOME, <?=$_SESSION["name"]?></h1>
                </div>
            </div>
        </div>
        <div class = "row content">
            <div class = "col">
                <div class = "container">
                    <h1 class = "usability">CLICK ON AN OUTFIT TO VIEW AND CUSTOMIZE</h1>
                    <h1 class = "myfits">MY FITS</h1>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 fits">
                        <div class="col mt-4">
                            <input type="image" src = "images/fit.png" class="img-fluid fitted" alt="image">
                        </div>
                        <div class="col mt-4">
                            <input type="image" src = "images/fit12.png" class="img-fluid fitted" alt="image">
                        </div>
                        <div class="col mt-4">
                            <input type="image" src = "images/fit13.png" class="img-fluid fitted" alt="image">
                        </div>
                    </div>
                </div>
                <div class = "container d-flex justify-content-center fixate">
                    <button type="button" class="btn btn-dark createOutfit">CREATE NEW OUTFIT</button>
                </div>
            </div>-->
            <!--<div class = "col">-->
                <h1 class = "mycloset d-flex justify-content-center">MY PIECES</h1>
                <div class="container wadrobeSelection">
                    <div class="row row-cols-md-1 row-cols-md-2 row-cols-md-3 imgs">
                        <?php 
                            $user_id = $this->db->query("select id from Users where email = ?;", "s", $_SESSION["email"]);
                            $clothes = $this->db->query("select * from clothing where user_id = ?;", "i", $user_id[0]["id"]);
                            foreach($clothes as $piece) {
                                $image = $piece["picture"];
                                echo "<div class='col mt-4'>
                                <input type='image' src='./images/users/{$image}' class='img-fluid hi' alt='image'>
                                </div>";
                            }
                        ?>
                    </div>
                    <div class = "container d-flex justify-content-center">
                        <a href="?command=delete-from-closet" class="btn btn-dark addToCloset">DELETE ITEMS</a>
                        <a href="?command=add-to-closet" class="btn btn-dark addToCloset">ADD TO CLOSET</a>
                    </div>
                </div>
            <!--</div>-->
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>
</html>