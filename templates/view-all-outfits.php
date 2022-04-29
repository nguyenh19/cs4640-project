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
                  <a class="nav-link" href = '?command=logout'>LOGOUT</a>
                  </li>
              </ul>
            </div>
        </nav>
        <h1 class="d-flex justify-content-center" style = "font-size: 15px;font-family: 'Amehysta';letter-spacing: 6px;margin-bottom: 20px;">MY OUTFITS</h1>
            <div  class = "col-6 d-flex justify-content-center">
                <?php
                $user_id = $this->db->query("select id from users where email = ?;", "s", $_SESSION["email"]);
                $outfits = $this->db->query("select * from outfits where user_id = ?;", "i", $user_id[0]["id"]);
                foreach($outfits as $outfit) {
                    $hat_id = $outfit["hat_id"];
                    $top_id = $outfit["top_id"];
                    $bottom_id = $outfit["bottom_id"];
                    $shoes_id = $outfit["shoes_id"];
                    $hat = $this->db->query("select * from clothing where clothing_id = ?;", "i", $hat_id);
                    $top = $this->db->query("select * from clothing where clothing_id = ?;", "i", $top_id);
                    $bottom = $this->db->query("select * from clothing where clothing_id = ?;", "i", $bottom_id);
                    $shoes = $this->db->query("select * from clothing where clothing_id = ?;", "i", $shoes_id);

                    if($hat != null){
                        echo "<div class='container' style = 'margin-top: 50px; margin-left: 120px;'>";


                        $hat_pic = $hat[0]["picture"];

                        echo "<span><img style='width:100px; height:100px' src='{$hat_pic}' class='img-fluid hi'</span> <br><br><br>";
                        echo "<span><img style='width:100px; height:100px' src='{$top[0]["picture"]}'  class='img-fluid hi'</span> <br><br><br>";
                        echo "<span><img style='width:100px; height:100px' src='{$bottom[0]["picture"]}' class='img-fluid hi'</span> <br><br><br>";
                        echo "<span><img style='width:100px; height:100px' src='{$shoes[0]["picture"]}'  class='img-fluid hi'</span> <br><br><br>";


                        echo "</div>";
                    }
                }
                ?>

            </div>
            <script>
                let elementID = {
                    "hat": "hat1",
                    "top": "top1",
                    "bottom": "bottom1",
                    "shoes": "shoes1"
                }

                $(document).ready(function(){
                    $('#hat').change(function() {
                        let source = './images/users/' + $(this).val(); 
                        document.getElementById(elementID["hat"]).innerHTML = "<img style='float: left; margin-left: 25px; width: 100px; height: 100px;' src = '" + source + "'></img>"
                    })

                    $('#top').change(function() {
                        let source = './images/users/' + $(this).val(); 
                        document.getElementById(elementID["top"]).innerHTML = "<img style='float: left; margin-left: 25px; width: 100px; height: 100px;' src = '" + source + "'></img>"
                    })

                    $('#bottom').change(function() {
                        let source = './images/users/' + $(this).val();
                        document.getElementById(elementID["bottom"]).innerHTML = "<img style='float: left; margin-left: 25px; width: 100px; height: 100px;' src = '" + source + "'></img>"
                    })

                    $('#shoes').change(function() {
                        let source = './images/users/' + $(this).val(); 
                        document.getElementById(elementID["shoes"]).innerHTML = "<img style='float: left; margin-left: 25px; width: 100px; height: 100px;' src = '" + source + "'></img>"
                    })

                    $(".sendFit").mouseover(function(){
                        $(this).css("background", "#36454F")
                    })
                    $(".sendFit").mouseout(function(){
                        $(this).css("background", "#A30000")
                    })
                })

            </script>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/ms-dropdown@4.0.3/dist/js/dd.min.js"></script>
    </body>
</html>