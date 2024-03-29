<!--Link: https://cs4640.cs.virginia.edu/rj3dxu/project/ -->

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
  <meta name="description" content="Cyber Style is your virtual closet">
  <meta name="keywords" content="Cyber Style Homepage">        
    
  <title>Cyber Style</title>
  
  <!-- 3. link bootstrap -->
  <!-- if you choose to use CDN for CSS bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
  <link rel="stylesheet" href="styles/main.css">
</head>

<body style="background-color: #2B2B2B;">
    <div class = "container">
        <h1 class = "header">CYBER STYLE</h1>
        <img class = "redline" src="images/redline.png" alt="Girl in a jacket">
        <h1 class = "subheader">YOUR STYLE. YOUR WAY. </h1>
    </div>
    <div class = "row buttons">
        <div class = "container d-flex justify-content-end">
            <a href="?command=login" class = "btn btn-dark home">LOGIN</a>
            <a href="?command=sign-up" class="btn btn-dark home" >NEW USER</a>
        </div>
    </div>
    <script>
         $(".home").mouseover(function(){
            $(this).css("background", "#36454F")
        })
        $(".home").mouseout(function(){
            $(this).css("background", "#A30000")
        })
    </script>
    <div class="row images">
        <div class="col-8 g-0">
            <img src = "images/thug.png" class="img-fluid thug" alt="image">
        </div>
        <div class="col-4 g-0">
            <img src = "images/girl.png" class="img-fluid girl" alt="image">
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>
