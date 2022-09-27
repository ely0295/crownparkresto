<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Title -->
    <title>Crown Park Restaurant | Home</title>
    
    <!-- Core Stylesheet -->
    <link href="mycss.css" rel="stylesheet">
	<link href="css/chatbot.css" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="css/responsive/responsive.css" rel="stylesheet">

</head>

<body>
   <!-- Spinner Start -->
    <div id="preloader">
        <div class="caviar-load"></div>
    </div>
    <!-- Spinner End -->

    <!-- ***** Header Area Start ***** -->
   <?php
	include("nav_panel.php");
	?>
    <!-- ***** Header Area End ***** -->

    <!-- ****** Welcome Area Start ****** -->
    <section class="caviar-hero-area" id="home">
        <!-- Welcome Social Info -->
        <div class="welcome-social-info">
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        </div>
        <!-- Welcome Slides -->
        <div class="caviar-hero-slides owl-carousel">
            <!-- Single Slides -->
            <div class="single-hero-slides bg-img" style="background-image: url(img/bg-img/bg-1.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-11 col-md-6 col-lg-4">
                            <div class="hero-content">
                                <h2>Welcome!</h2>
                                <p>Our place is cozy and authentic. Come and dine with us or place a to go order. Let us provide you with our excellent service and care.</p>
                                <a href="#reservation" class="btn caviar-btn" ><span></span>Book a table now!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Slides -->
            <div class="single-hero-slides bg-img" style="background-image: url(img/bg-img/centro.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-11 col-md-6 col-lg-4">
                            <div class="hero-content">
                                <h2>Huan yin!</h2>
                                <p>Wǒmen dì dìfāng shūshì ér zhēnshí. Lái hé wǒmen yīqǐ yòngcān huò xià dìngdān. Ràng wǒmen wèi nín tígōng yōuzhì de fúwù hé guānhuái.</p>
                                <a href="#reservation" class="btn caviar-btn" ><span></span>Book a table now!</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slider Nav -->

            </div>
        </div>
    </section>
    <!-- ****** Welcome Area End ****** -->



    <!-- ****** About Us Area Start ****** -->
    <section class="caviar-about-us-area section-padding-150" id="about">
        <div class="container">
            <!-- About Us Single Area -->
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <div class="about-us-thumbnail wow fadeInUp" data-wow-delay="0.5s">
                        <img src="img/bg-img/robinsons.PNG" alt="">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-5 ml-md-auto">
                    <div class="section-heading">
                        <h2>About Us</h2>
                    </div>
                    <div class="about-us-content">
                        <p>Crown Park Restaurant offers a wide variety of chinese dishes that is perfect for any type of gathering.</p>
                        <p>Visit us at:</p><br>
                        <p> First Floor SM City Naga Central Business District II Brgy Triangulo, Naga, 4400 Camarines Sur</p>
                        <br>
                        <p>First floor Crown Hotel P. Burgos Corner Elias Angeles Streets Barangay San Francisco Naga City 4400, Camarines Sur</p>
                        <br>
                         <p>First floor Robinson’s Place Naga Roxas Avenue corner Almeda Highway, Barangay Triangulo, Lungsod ng Naga, 4400 Camarines Sur.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ****** About Us Area End ****** -->
    <br><br>
    <!-- ****** Dish Menu Area Start ****** -->
    <section class="caviar-dish-menu" id="menu">
        <div class="container">
            <div class="row">
                <div class="col-12 menu-heading">
                    <div class="section-heading text-center">
                        <h2>Popular Meals</h2>
                    </div>
                    <!-- btn -->
                    <a href="menu.php" class="btn caviar-btn"><span></span> View Full Menu</a>
                </div>
            </div>
            <div class="row">
			 <!-- ****** get popular meals ****** -->
			 <?php 
				include 'connect.php';
				$Get_query = "select A.*,B.* from product as A JOIN inventory as B on A.product_code = B.product_code where A.popular = 1";
				$result = $conn->query($Get_query);
				if($result->rowCount() > 0){
					while($row1 = $result->fetch(PDO::FETCH_ASSOC)){
						?>
						<div class="col-12 col-sm-8 col-md-4">
							<div class="caviar-single-dish wow fadeInUp" data-wow-delay="0.5s"  style = "width:100%;padding: 10px;background:#b51b10;">
								<img src="product_img/<?php echo $row1["product_img"]?>" style = "width:100%;height:250px;"alt="">
								<div class="dish-info">
									<h6 class="dish-name"><?php echo $row1["product_name"]?></h6>
								</div>
								<div class="dish-info">
									<h6 class="dish-name"><?php 
											if($row1["quantity"] == '0'){
												?>
												<a  class="btn btn-warning btn-sm" >
												<i class="fa fa-shopping-cart" aria-hidden="true"></i> Not Available
												</a>
												<?php
											}else{
												?>
												<a href="javascript:opencart('<?php echo $row1["product_code"]?>','<?php echo $row1["product_img"]?>','<?php echo $row1["product_name"]?>','<?php echo $row1["price"]?>','<?php echo $row1["quantity"]?>');" class="btn btn-danger btn-sm" >
												<i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart
												</a>
												<?php
											}
											?></h6>
									
									<p class="dish-price">&#8369; <?php echo $row1["price"]?></p>
								</div>
							</div>
						</div>
						
						<?php						
					}					
				}
			 
			 
			 ?>
                
              
            </div>
        </div>
    </section>
    <!-- ****** Dish Menu Area End ****** -->

    <!-- ****** Testimonials Area Start ****** -->
    <section class="caviar-testimonials-area" id="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="testimonials-content">
                        <div class="section-heading text-center">
                            <h2>Testimonials</h2>
                        </div>
                        <div class="caviar-testimonials-slides owl-carousel">
                            <!-- Single Testimonial Area -->
                            <div class="single-testimonial">
                                <div class="testimonial-thumb-name d-flex align-items-center">
                                    <img src="img/testimonial-img/3.jpg" alt="">
                                    <div class="tes-name">
                                        <h5>Robert</h5>
                                    </div>
                                </div>
                                <p>We visited the Resto a few weeks ago with some clients. I am finally getting back to tell you that we had a wonderful afternoon. Thank you again for making such a special place to be.
                                We hope to see you again soon. Keep up the good work !</p>
                            </div>
                            <!-- Single Testimonial Area -->
                            <div class="single-testimonial">
                                <div class="testimonial-thumb-name d-flex align-items-center">
                                    <img src="img/testimonial-img/2.jpg" alt="">
                                    <div class="tes-name">
                                        <h5>Clara</h5>
                                    </div>
                                </div>
                                <p>Thank you for dinner last night. It was amazing!! I have to say it’s the best meal I have had in quite some time. You will definitely be seeing more of me eating at your establishment. My husband was very impressed and we can’t wait for our parents to come visit so that we can share our new favorite place with them.</p>
                            </div>
                            <!-- Single Testimonial Area -->
                            <div class="single-testimonial">
                                <div class="testimonial-thumb-name d-flex align-items-center">
                                    <img src="img/testimonial-img/1.jpg" alt="">
                                    <div class="tes-name">
                                        <h5>Jane</h5>
                                    </div>
                                </div>
                                <p>It was FABULOUS! The portions were overly generous. Everything was so yummy – what a bargain. I will be back soon.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ****** Testimonials Area End ****** -->

    <!-- ****** Reservation Area Start ****** -->
    <section class="caviar-reservation-area d-md-flex align-items-center" id="reservation">
        <div class="reservation-form-area d-flex justify-content-end">
            <div class="reservation-form">
                <div class="section-heading">
                    <h2>Reservation</h2>
                </div>
                <div action="#">
                    <div class="row booking-form">
						<?php
						//check if has access to reserve
						if(!(isset($_SESSION['signed_in'])) ){
							?>
							<button type="submit" class="btn caviar-btn" onclick="mes()"><span></span> Reserve Your Desk Now!</button>
                        <div class="col-12">
							<?php
						}else{
							?>
							<button type="submit" class="btn caviar-btn" onclick="window.location.href = 'reservation.php'"><span></span> Reserve Your Desk Now!</button>
                        <div class="col-12">
							<?php
						}

						?>
                        
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="reservation-side-thumb wow fadeInRightBig" data-wow-delay="0.5s">
            <img src="img/bg-img/chair.jpg" alt="">
        </div>
    </section>
	<?php include("cartmodal.php");?>
    <!-- ****** Reservation Area End ****** -->
    <!-- chat icon start
    <script src="https://apps.elfsight.com/p/platform.js" defer></script>
    <div class="elfsight-app-0e33443e-7c02-43d8-aabf-282a5578dc8f"></div>
    <!-- chat icon end -->
	<button type = "button" class="open-button" onclick="openForm()"><img src="img/chat1.png" style ="border-radius:50%;height:60px;width:80px;"></button>
    <!-- ****** Footer Area Start ****** -->
	
		<div id="bot">
		  <div id="container">
			<div id="header">
				Chat with us!
				<button  type="button" onclick = "closeForm()"class = "closechat pull-right" ><img src="img/close.png" style ="height:35px;width:35px;"></button>
			</div>

			<div id="body">
			
				<!-- This section will be dynamically inserted from JavaScript -->          
			</div>
			

			<div id="inputArea">
			  <input type="text" name="messages" id="userInput" placeholder="Please enter your message here" required>
			  <button type="submit" id="send" value=""><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
			</div>
		  </div>
	  </div>

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
    <!-- ****** Footer Area End ****** -->
    <script type="text/javascript">
        function mes() {
            alert("You must sign in to your account to process Reservation!");
            window.location.href="account.php";
        }
		function openForm() {
			document.getElementById("bot").style.display = "block";
		}
		function closeForm() {
			document.getElementById("bot").style.display = "none";
		}
		// When send button gets clicked
		document.querySelector("#send").addEventListener("click", async () => {

        // create new request object. get user message
        let xhr = new XMLHttpRequest();
        var userMessage = document.querySelector("#userInput").value


        // create html to hold user message. 
        let userHtml = '<div class="userSection">'+'<div class="messages user-message">'+userMessage+'</div>'+
        '<div class="seperator"></div>'+'</div>'


        // insert user message into the page
        document.querySelector('#body').innerHTML+= userHtml;

        // open a post request to server script. pass user message as parameter 
        xhr.open("POST", "processbot.php");
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(`messageValue=${userMessage}`);


        // When response is returned, get reply text into HTML and insert in page
        xhr.onload = function () {
			document.querySelector("#userInput").value = "";
            let botHtml = '<div class="botSection">'+'<div class="messages bot-reply">'+this.responseText+'</div>'+
            '<div class="seperator"></div>'+'</div>'

            document.querySelector('#body').innerHTML+= botHtml;
        }

      })

    </script>
    
	
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