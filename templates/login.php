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
  <meta name="description" content="Log in to Cyber Style">
  <meta name="keywords" content="Cyber Style Login">        
    
  <title>Log in to Cyber Style</title>
  
  <!-- 3. link bootstrap -->
  <!-- if you choose to use CDN for CSS bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
  <link rel="stylesheet" href="styles/login.css">
</head>

<body>
    <!--<nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="./index.html">Cyber Style</a>
        <div class="d-flex justify-content-end" style="margin-right: 0; margin-left: auto;">
            <div class="nav-item active">
                <a class="nav-link active" id="sign-in" href="#">Sign Up</a>
            </div>
        </div>
    </nav>-->
    <div class="row">
    <nav id = "navbar-ex" class="navbar fixed-top navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="?command=home">CYBER STYLE</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
    </div>
    <div class="row justify-content-center" style="margin-top: 20px;">
        <div>
        <h3 class="text-center" id="login-heading">Login</h3>
        <hr id="divider">
        </div>
        <div class="card border-0" id="login-card">
            <div class="card-body">
                <form action="?command=login" method="post">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                    <?=$message?>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <a id="sign-up-link" href="?command=sign-up">Don't have an account? Click here to sign up!</a>
                </div>
                <div class="centered-container">
                    <button type="submit" class="btn btn-lg" id="login-button">Submit</button>
                    <?=$error_msg?>
                </div>
                </form>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>
