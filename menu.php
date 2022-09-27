<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Crown Park Restaurant | Menu</title>

    <!-- Core Stylesheet -->
    <link href="mycss.css" rel="stylesheet">
 
    <!-- Responsive CSS -->
    <link href="css/responsive/responsive.css" rel="stylesheet">
	<script>
	
	</script>
</head>
<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="caviar-load"></div>
    </div>

    <!-- ***** Header Area Start ***** -->
    <?php
	include("nav_panel.php");
	?>
    <!-- ***** Header Area End ***** -->
<!-- ***** Menu Area Start ***** -->
    <div class="caviar-food-menu section-padding-150 clearfix">
        <div class="container">
            <div class="row">
               

                <div class="col-12">
                    <div class="caviar-projects-menu">
                        <div class="text-center portfolio-menu">
                            <button class="active" data-filter="*">Popular</button>
						<?php 
							include 'connect.php';
							$Get_query = "select * from categories";
							$result = $conn->query($Get_query);
							if($result->rowCount() > 0){
								while($row1 = $result->fetch(PDO::FETCH_ASSOC)){
									?>
									<button onclick = "viewproduct('<?php echo $row1["cat_id"]?>')"> <?php echo $row1["cat_desc"]?></button>
									<?php						
								}					
							}
						 
						 
						 ?>	
							
							
                        </div>
                    </div>
                    <div class="container" >

                        <div id = "showresult">
                           <?php 
							include 'connect.php';
							$Get_query = "select A.*,B.* from product as A JOIN inventory as B on A.product_code = B.product_code where A.popular = 1";
							$result = $conn->query($Get_query);
							if($result->rowCount() > 0){
								while($row1 = $result->fetch(PDO::FETCH_ASSOC)){
									?>
									 <div class="single_menu_item appetizers  wow fadeInUp">
											<div class="d-sm-flex align-items-center">
												<div class="dish-thumb">
													<img src="product_img/<?php echo $row1["product_img"]?>" style = "width:287px;height:201px;"alt="">
												</div>
												<div class="dish-description">
													<h3><?php echo $row1["product_name"]?> - &#8369;<?php echo $row1["price"]?></h3>
												   <p class="dish-ratings text-muted"><u>5.0</u> &#9733;&#9733;&#9733;&#9733;&#9733; |  <u> 100 Ratings</u> | <a href=""><u>View Reviews </u></a> </p>
													<div class="dish-value">
														<?php 
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
															?>
													</div>
												</div>
											</div>
										</div>
									
									
									<?php						
								}					
							}
						 
						 
						 ?>
                           
                            
                            <!-- Single Gallery Item END-->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Menu Area End ***** -->

    <!-- ***** Special Menu Area Start ***** -->
    <section class="caviar-dish-menu clearfix" id="menu">
        <div class="container">
            <div class="row">
                <div class="col-12 menu-heading">
                    <div class="section-heading text-center">
                        <h2>Popular</h2>
                    </div>
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
    <!-- ***** Special Menu Area End ***** -->
    <!-- Modal Section Start  -->
     <div class="modal section-padding-100" id="mymodal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">

                    <h5 class="modal-title"><i class="fa fa-shopping-cart" aria-hidden="true"></i>   Crown Park Restaurant</h5>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-6" >
                            <img src="" class="img-thumbnail" id="dish-url-modal" width="100%" height="100%">
                             <small class="text-muted">Serving Size: Good for 1 person(s)</small>
                             <p class="dish-ratings" style="color:darkred;"><u>5.0</u> &#9733;&#9733;&#9733;&#9733;&#9733; |  <u> 100 Ratings</u> | <a href=""><u>View Reviews </u></a> </p>
                        </div>
                        <div class="col-6">
                            <label class="form-label font-weight-bold">Dish Description: </label>
                            <input type="text" class="form-control" name="dish-description" id="dish-name-modal" placeholder="" disabled>
                            <label class="form-label font-weight-bold">Price: </label>
                            <input type="text" class="form-control" name="dish-description"id="dish-amount-modal" placeholder="" disabled>
                            <label class="form-label font-weight-bold">Quantity: </label>
                            <input type="number" class="form-control w-25" name="dish-quantity" placeholder="1">
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" action="#" data-dismiss="modal" onclick="addSuccess()">Add to Cart</button>
                  </div>
                </div>
              </div>
        </div>
	<?php include("cartmodal.php");?>
    <!-- Modal Section End  -->
    
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
    <!-- ****** Footer Area End ****** -->
    <script type="text/javascript">
		function viewproduct(category_code){
		//document.getElementById("showresult").innerHTML = "";
			var xhttp;
			  xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("showresult").innerHTML = this.responseText;	
					
				}
			  };
		  xhttp.open("GET", "getmenu.php?category_code="+category_code, true);
		  xhttp.send();   
		
		}
        function getDetails(a,b,c) {

            document.getElementById("dish-name-modal").placeholder=a;
            document.getElementById("dish-amount-modal").placeholder=b;
            document.getElementById("dish-url-modal").src=c;

            $("#mymodal").modal();

        }
        function addSuccess() {
          alert("Successfully Added to Cart!");
        }
    </script>
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/others/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
</body>