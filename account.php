<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Crown Park Restaurant | Account</title>
    
    <!-- Core Stylesheet -->
    <link href="mycss.css" rel="stylesheet">
    <!-- Responsive CSS -->

    <link href="css/responsive/responsive.css" rel="stylesheet">

</head>
<body>
    <div id="preloader">
        <div class="caviar-load"></div>
    </div>
   <!-- ***** Header Area Start ***** -->
    <?php
	include("nav_panel.php");
	?>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Login Area Start ***** -->

     <section class="caviar-about-us-area section-padding-150" id="about">

        <div class="col-12">
            <form class="form-signin" action="signindata.php"  method="post">
                <div class="row">
                      <div class="col-6 d-none d-md-block" style="background-image:url(img/bg-img/login.png); background-repeat: no-repeat;">
                      </div>
                      <div class="col-6 col-md-6 col-12 bg-light">
                            <div class="row">
                                <div class="login-form bg-light">
								
                                    <div class="section-heading" style="text-align: center; margin: auto;">
                                      <h2>Welcome!</h2>
                                     </div>
									 
                                    <input class="input-form"type="text" id="email"placeholder="Email" name="uname" />
                                    <input class="input-form"type="password"id="password" placeholder="Password"  name="psw"/>
                                    <a href="#">Forgot Password?</a>
                                     <br>
									 <div class="alert alert-danger" role="alert" style="display:none;" id="warningmes">Invalid Username/Password!</div>
                                    <button class="sign-in-button" name = "btnlogin"  type="submit" >Sign In</button>
								
                                    <div>
                                         <p>Don't have an account?  <a href="create-an-account.php">Sign Up here!</a></p>
                                    </div>
								
                                 </div>
                            </div>
                     </div>
                </div>
					</form>
        </div>
    </section> 

    <script src="https://apps.elfsight.com/p/platform.js" defer></script>
    <div class="elfsight-app-0e33443e-7c02-43d8-aabf-282a5578dc8f"></div>
    
    <!-- ****** Footer Area Start ****** -->
    <footer class="caviar-footer-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-text">
                         <img src="img/logo.png" class="img-thumbnail rounded-circle" width="70" height="70">
                        <a href="#" class="navbar-brand">Crown Park Restaurant</a>
                        <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved &#8482;</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script type="text/javascript">
        function login(){
            var a = document.getElementById("email").value;
            var b = document.getElementById("password").value;
            if (a == 'admin' && b == 'pass') {
                 window.location.href="dashboard.html";
            } 
            if (a == 'user'&& b == 'pass'){
                window.location.href="index1.html";
            }
            else {
                document.getElementById("warningmes").style.display = "block";
            }
         
        }
    </script>
    <!-- ****** Footer Area End ****** -->
    <!-- Jquery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap-4 js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/others/plugins.js"></script>
    <!-- Active JS -->
    <script src="js/active.js"></script>
</body>
</html>