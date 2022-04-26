<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/wardrobe.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/ms-dropdown@4.0.3/dist/css/dd.min.css" />
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
            ?>>CYBER STYLE</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto">
                  <li class="nav-item active">
                  <a class="nav-link" href="?command=wardrobe">MY WARDROBE</a>
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
        <h1 class = "mycloset d-flex justify-content-center">CREATE NEW OUTFIT</h1>
        <div class = "row">
            <div class = "col-6 d-flex justify-content-center">
                <form class= "form" style="margin-top: 75px; margin-left: 20px;">
                    <label for="hat">Choose a hat: </label>
                    <select is="ms-dropdown" id ="hat" name="hat" style = "margin-top: 50px">
                    <?php 
                        $user_id = $this->db->query("select id from users where email = ?;", "s", $_SESSION["email"]);
                        $data = $this->db->query("select * from clothing where category = 'Hat' and user_id=?", 'i', $user_id[0]["id"]);
                        foreach($data as $piece){
                            $image = $piece["picture"];
                            echo "<option data-image='./images/users/{$image}' value = '" . $piece["clothing_id"] . "'></option>";
                        }
                    ?>
                    </select> <br>
                    <label for="top">Choose a top: </label>
                    <select is = "ms-dropdown" id="top" name="top" style = "margin-top: 50px">
                    <?php 
                        $user_id = $this->db->query("select id from users where email = ?;", "s", $_SESSION["email"]);
                        $data = $this->db->query("select * from clothing where category = 'Shirt' or category = 'Outerwear' and user_id=?", 'i', $user_id[0]["id"]);
                        foreach($data as $piece){
                            $image = $piece["picture"];
                            echo "<option data-image='./images/users/{$image}' value = '" . $piece["clothing_id"] . "'></option>";
                        }
                    ?>
                    </select> <br>
                    <label for="bottom">Choose a bottom: </label>
                    <select is = "ms-dropdown" id="bottom" name="bottom" style = "margin-top: 50px">
                    <?php 
                        $user_id = $this->db->query("select id from users where email = ?;", "s", $_SESSION["email"]);
                        $data = $this->db->query("select * from clothing where category = 'Pants' and user_id=?", 'i', $user_id[0]["id"]);
                        foreach($data as $piece){
                            $image = $piece["picture"];
                            echo "<option data-image='./images/users/{$image}' value = '" . $piece["clothing_id"] . "'></option>";
                        }
                    ?>
                    </select> <br>
                    <label for="shoes">Choose shoes: </label>
                    <select is = "ms-dropdown" id="shoes" name="shoes" style = "margin-top: 50px">
                    <?php 
                        $user_id = $this->db->query("select id from users where email = ?;", "s", $_SESSION["email"]);
                        $data = $this->db->query("select * from clothing where category = 'Shoes' and user_id=?", 'i', $user_id[0]["id"]);
                        foreach($data as $piece){
                            $image = $piece["picture"];
                            echo "<option data-image='./images/users/{$image}' value = '" . $piece["clothing_id"] . "'></option>";
                        }
                    ?>
                    </select> <br>
                </form>
            </div>
            <div class = "col-6 d-flex justify-content-center">
                
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/ms-dropdown@4.0.3/dist/js/dd.min.js"></script>
    </body>
</html>