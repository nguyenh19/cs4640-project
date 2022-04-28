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
                  <a class="nav-link" href = '?command=logout'>LOGOUT</a>
                  </li>
              </ul>
            </div>
        </nav>
        <h1 class = "mycloset d-flex justify-content-center">MY PIECES</h1>
        <div class="container wadrobeSelection" style = "background-color: #202020">
        <div class="row" style="margin-top: 20px">
                <div class="col-xs-8 mx-auto">
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                            <th scope = "col">Category </th>
                            <th scope="col">Name</th>
                            <th scope="col">Image </th>
                            <th scope="col">Color </th>
                            <th scope="col">Brand </th>
                            <th scope="col">Remove </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                $user_id = $this->db->query("select id from users where email = ?;", "s", $_SESSION["email"]);
                                $clothes = $this->db->query("select * from clothing where user_id = ?;", "i", $user_id[0]["id"]);
                                foreach($clothes as $piece) {
                                    $image = $piece["picture"];
                                    echo "<tr><td>" . $piece["category"] . "</td><td>" . $piece["name"] . "</td><td><input type='image' src='./images/users/{$image}' alt='./images/high_squidward.png' class='img-fluid hi' style = 'width:200px; height:200px;' alt='image'></td><td>" . $piece["color"] . "</td><td>" . $piece["brand"] . "</td><td><form id='form1' method='post' action='?command=delete-from-closet'>
                                    <button class = 'btn btn-danger deleteItem' name = 'delete_clothes' form = 'form1' type = 'submit' value='" . $piece["clothing_id"] . "'>Remove From Wardrobe</button></form></td></tr>";
                                }

                            ?>
                        </tbody>
                    </table>
                </div>
        </div>
        <div class = "container d-flex justify-content-center">
                <a href="?command=add-to-closet" class="btn btn-dark addToCloset">ADD TO CLOSET</a>
        </div>
        <script>
            $(".deleteItem").on("click", function() {
                let status = confirm("Are you sure you want to delete?");
                if(status === false){
                    return false;
                }
                return true; 
            });
        </script>
            <!--</div>-->
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>
</html>