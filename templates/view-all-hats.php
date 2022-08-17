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
        <title>All Shirts</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js"
	integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
	crossorigin="anonymous"></script>
        <script type="text/javascript">
            var activeSearch = false;
            window.onload = function() {
                $("#search-bar").on("submit", function(e) {
                e.preventDefault();
                // var formValues = $(this).serialize();
                // $.post("?command=search-clothes", formValues, function(data) {
                //     alert(data);
                // })
                // var form = $(this);
                // console.log(form);
                // var actionUrl = form.attr('action');
                // console.log(actionUrl);
    
                // $.ajax({
                //     type: "POST",
                //     url: actionUrl,
                //     data: form.serialize(), // serializes the form's elements.
                //     success: function(data)
                //     {
                //     alert(data); // show response from the php script.
                //     }
                // });
                activeSearch = true;
                // var keyword = document.getElementById("search").value;
                // $.post("?command=search-clothes", {"search": keyword}).done(function(data){
                // //     displayShirts(data);
                // // })
                search();
            });
                loadPage();
            }

            async function loadPage(search="") {
                if (!activeSearch) {
                    var ajax = new XMLHttpRequest();
                    var data; 
                    ajax.responseType = "json";

                    ajax.open("GET", "?command=Hat", true);

                    ajax.send(null);

                    ajax.addEventListener("load", function() {
                        if (this.status === 200) {
                            data = this.response;
                            console.log(data);
                            displayShirts(data);
                        }
                    });
                }
            }

                // ajax.onReadyStateChange = function() {
                //     if (this.readyState === 4 && this.status === 200) {
                //         var data = JSON.parse(this.responseText);
                //         console.log(data);
                //         //window.location("?command=shirts");
                //         displayShirts(data);
                //     } else {
                //         console.log("Error", this.statusText);
                //     }
                // }
                // ajax.send();

            function displayShirts(data) {
                var list = document.getElementById("hat-list");
                data.forEach((shirt) => {
                    var image = shirt['picture'];
                    var newDiv = document.createElement("div");
                    newDiv.classList.add('col', 'mt-4');
                    var curShirt = document.createElement("img");
                    curShirt.src = image;
                    curShirt.classList.add('img-fluid', 'hi');
                    //curShirt.class hi');
                    newDiv.appendChild(curShirt);
                    list.appendChild(newDiv);
                });
            }

            async function search() {
                // debugger;
                var list = document.getElementById("hat-list");
                list.innerHTML = "";
                var data;
                var ajax = new XMLHttpRequest();
                ajax.responseType = "json";
                ajax.open("POST", "?command=search-clothes", true);
                var keyword = document.getElementById("search").value;
                ajax.send("search=" + keyword);

                ajax.addEventListener("load", function() {
                    if (this.status === 200) {
                        data = this.response;
                        console.log(data);
                        displayShirts(data);
                    }
                });


            }



            function setCategory() {
                localStorage.setItem("category", JSON.stringify({"category": "hats"}));
            }
        </script>
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
                  <a class="nav-link" href="?command=wardrobe">MY WARDROBE</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href = '?command=logout'>LOGOUT</a>
                  </li>
              </ul>
            </div>
        </nav>
                <h1 class = "mycloset d-flex justify-content-center">MY HATS</h1>
                <div class="container d-flex justify-content-end">
                <form style="float:right; margin: 20px" id="search-bar" action="?command=search-clothes" method="post">
                    <input id="search" name="search" type="text" placeholder="Search for an item">
                    <input id="submit" type="submit" value="Search">
                </form>
                </div>
                <div class="container wadrobeSelection">
                    <div class="row row-cols-md-1 row-cols-md-2 row-cols-md-3 imgs" id="hat-list">

                    </div>
                    <div class = "container d-flex justify-content-center">
                        <a href="?command=delete-from-closet" onclick="setCategory();" class="btn btn-dark addToCloset">DELETE ITEMS</a>
                        <a href="?command=add-to-closet" class="btn btn-dark addToCloset">ADD TO CLOSET</a>
                    </div>
                </div>
            <!--</div>-->
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>
</html>