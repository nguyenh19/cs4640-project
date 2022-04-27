<!-- Bootstrap elements I've added:
    * navbar
    * card
    * dropdown
    * modal
    * accordion
-->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  
  <!-- 2. include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 
  Bootstrap is designed to be responsive to mobile.
  Mobile-first styles are part of the core framework.
   
  width=device-width sets the width of the page to follow the screen-width
  initial-scale=1 sets the initial zoom level when the page is first loaded   
  -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="author" content="Hien and Rehan">
  <meta name="description" content="Add to Closet">
  <meta name="keywords" content="Cyber Style Add to Closet">        
    
  <title>Add to Closet</title>
  
  <!-- 3. link bootstrap -->
  <!-- if you choose to use CDN for CSS bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
  <link rel="stylesheet" href="styles/login.css">
</head>

<body>
    <div class="row">
    <nav id = "navbar-ex" class="navbar fixed-top navbar-expand-lg navbar-dark">
            <a class="navbar-brand" 
            <?php
                if (isset($_COOKIE["logged_in"]) && $_COOKIE["logged_in"] === "true") {
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
                  <li class="nav-item">
                  </li>
              </ul>
            </div>
        </nav>
    </div>
    <div class="row justify-content-center" style="margin-top: 20px;">
        <div>
        <h3 class="text-center" id="login-heading">Upload Your Item</h3>
        <hr id="divider">
        </div>
        <div class="card border-0" id="login-card">
            <div class="card-body">
                <form id="add-piece" action="?command=add-to-closet" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select type="text" class="form-control" name="category" required>
                        <option value="" disabled selected hidden>Choose a Category</option>
                        <option>Dress</option>
                        <option>Shirt</option>
                        <option>Outerwear</option>
                        <option>Pants</option>
                        <option>Shoes</option>
                        <option>Accessories</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <select type="text" class="form-control" name="color" required>
                        <option value="" disabled selected hidden>Choose a Color</option>
                        <option>Black</option>
                        <option>White</option>
                        <option>Red</option>
                        <option>Pink</option>
                        <option>Orange</option>
                        <option>Yellow</option>
                        <option>Green</option>
                        <option>Blue</option>
                        <option>Purple</option>
                        <option>Tan</option>
                        <option>Gray</option>
                        <option>Brown</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" class="form-control" name="brand" placeholder="Brand">
                </div>
                <div class="form-group">
                    <label for="file">Item Upload</label>
                    <input type="file" id="file" onchange="return validateFile();" class="form-control" name="file" placeholder="File" required>
                    <div id="file-msg"></div>
                </div>
                <div class="centered-container">
                    <button type="submit" class="btn btn-lg" id="login-button">Upload</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
	integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
	crossorigin="anonymous"></script>
<script type="text/javascript">
    function validateFile() {
        document.getElementById("file-msg").innerHTML = "";
        var file = document.getElementById("file");
        file = file.value;

        var allowedExtensions = 
                    /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.exec(file)) {
            document.getElementById("file-msg").innerHTML = "<div class='alert alert-danger'>Please enter a valid image</div>";
            file.value = '';
        }
        // var fileType = file["type"];
        // var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
        // if ($.inArray(fileType, validImageTypes) < 0) {
        //     document.getElementById("file-msg").innerHTML = "<div class='alert alert-danger'>Please enter a valid image</div>";
        // }
        return false;

    }

    // $("#add-piece").on("submit", function() {
    //     var files = document.getElementById("file").value;
    //     validateFile(files);
    //     return false;
    // });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>
