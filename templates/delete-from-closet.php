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
                <form id="delete-clothes" onsubmit="return confirm('Are you sure you want to delete these items?');" action="?command=delete-from-closet" method="post">
                    <div class="row row-cols-md-1 row-cols-md-2 row-cols-md-3 imgs">
                        <?php 
                            $user_id = $this->db->query("select id from users where email = ?;", "s", $_SESSION["email"]);
                            $clothes = $this->db->query("select * from clothing where user_id = ?;", "i", $user_id[0]["id"]);
                            $clothing_to_delete = array();
                            foreach($clothes as $piece) {
                                $image = $piece["picture"];
                                $clothing_id = $piece["clothing_id"];
                                echo "<div class='col mt-4'>
                                <input type='image' src='./images/users/{$image}' class='img-fluid hi' alt='image'>
                                <input type='checkbox' name='delete_clothes[]' value='{$clothing_id}'>
                                </div>";
                            }
                        ?>
                    </div>
                    <div class = "container d-flex justify-content-center">
                        <a href="?command=view-all-clothes" class="btn btn-dark addToCloset">BACK</a>
                        <button type="submit" value="submit" class="btn btn-dark addToCloset">DELETE ITEMS</button>
                    </div>
                </form>
                </div>
            <!--</div>-->
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js"
	integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
	crossorigin="anonymous"></script>
<script type="text/javascript">
    // function confirmDeletion() {
    //     document.getElementById("file-msg").innerHTML = "";
    //     var file = document.getElementById("file");
    //     file = file.value;

    //     var allowedExtensions = 
    //                 /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    //     if (!allowedExtensions.exec(file)) {
    //         document.getElementById("file-msg").innerHTML = "<div class='alert alert-danger'>Please enter a valid image</div>";
    //         file.value = '';
    //     }
    //     return false;

    // }

    // $("#add-piece").on("submit", function() {
    //     var files = document.getElementById("file").value;
    //     validateFile(files);
    //     return false;
    // });
</script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>
</html>