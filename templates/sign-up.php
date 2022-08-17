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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"
	integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
	crossorigin="anonymous"></script>
</head>

<body>
    <div class="row">
    <nav id = "navbar-ex" class="navbar fixed-top navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="?command=home">CYBER STYLE</a>
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
        <h3 class="text-center" id="login-heading">Sign Up</h3>
        <hr id="divider">
        </div>
        <div class="card border-0" id="login-card">
            <div class="card-body">
                <form id="sign-in-form" action="?command=sign-up" method="post">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" required>
                    <div id="msg"></div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <a id="sign-up-link" href="?command=login">Already have an account? Click here to login!</a>
                </div>
                <div class="centered-container">
                    <button type="submit" class="btn btn-lg" id="login-button">Create Account</button>
                    <?= $error_msg ?>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">

    const emailRegex = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/";
      const validateEmail = (email) => {
        // return String(email)
        //     .toLowerCase()
        //     .match("/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/");
        return String(email).toLowerCase().test(emailRegex);
        };
        function validate(email) {
            //var email1 = document.getElementById("email").value;
            //var email = $('#email').attr('value');
            if (!validateEmail(email)){
                //alert("Please enter a valid email address");
                document.getElementById("msg").innerHTML = "<div class='alert alert-danger'>Please enter a valid email</div>";
                
                // var msg = $('#msg');
                // msg.className = "alert alert-danger";
                // msg.innerHTML = "Please enter a valid email";
                        //"<div class='alert alert-danger'>Please enter a valid email</div>";
            }
            return false;
        }
        $('#sign-in-form').on('submit', function(){
            var email = document.getElementById("email").value;
            validate(email);
            return false;
        });
  </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>
