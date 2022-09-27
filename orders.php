<!DOCTYPE html>
<?php include("accessright.php") ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Crown Park Restaurant | Orders</title>

    <!-- Core Stylesheet -->
    <link href="mycss.css" rel="stylesheet">
 
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
  
   <!--  Order Area Start -->

            <div class="container-fluid container-order-area pt-4 px-4">
                <div class="text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="mb-0"><span class="fa fa-paste heading-icon"></span> My Orders</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-hover mb-0">
                            <thead>
                                <tr>
                                 
                                    <th scope="col">Date</th>
                                    <th scope="col">Invoice</th>
                                    <th scope="col">Pickup-Time</th>
                                    <th scope="col" class="d-none d-sm-table-cell">Amount</th>
                                    <th scope="col" class="d-none d-sm-table-cell">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php
									$client_id = $_SESSION['client_id'];
									include 'connect.php';
									$Get_query = "select A.* from orders as A where A.client_id ='$client_id' ";						
									$result = $conn->query($Get_query);
									$counter= 1;
									if($result->rowCount() > 0){
										while($row = $result->fetch(PDO::FETCH_ASSOC)){
											$ordercode = $row["order_code"];
											$date = strtotime($row["date_ordered"]);
											
											?>
											 <tr>
												<td><?php echo date('d M Y' , strtotime($row["date_ordered"])); ?></td>
												<td><?php echo $row["order_code"]?></td>
												<td>1:00 PM</td>
												<?php 
												$Get_query1 = "select A.*,B.*,C.price,C.product_name,C.product_img from orders as A JOIN order_product_list as B on A.order_code = B.order_code JOIN product as C on B.product_code = C.product_code where  A.order_code = '$ordercode '";	
												$result1 = $conn->query($Get_query1);
												$total = 0;
												if($result1->rowCount() > 0){
													while($row1 = $result1->fetch(PDO::FETCH_ASSOC)){
														$total = $total + ((int)$row1["price"] * (int)$row1["product_quantity"]);
													}
												}
												?>
												<td class="d-none d-sm-table-cell">&#8369;<?php echo $total; ?></td>
												<td class="d-none d-sm-table-cell"><?php echo $row["order_status"]?></td>
												<td><button class="tda btn btn-sm btn-danger" onclick="vieworder('<?php echo $row["order_code"]?>')">View</button></td>
											</tr>
											<?php
											
										}
									}
									?>
                                
																									
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        


    <!--  Order Area End -->
        <!-- Modal Section Start  -->
     <div class="modal section-padding-100" id="mymodal">
              <div class="modal-dialog modal-lg" id = "modalorder">
                
              </div>
        </div>

    <!-- Modal Section End  -->

<!-- ****** Footer Area Start ****** -->
    <footer class="caviar-footer-area mt-5">
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
		function printDiv() {
            var divContents = document.getElementById("Printdiv").innerHTML;
            var a = window.open();
            a.document.write('<html>');
			a.document.write('<head>');
			a.document.write('<link href="mycss.css" rel="stylesheet">');
			a.document.write('</head>');
            a.document.write('<body style = "padding:30px;">');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();		
            a.print();
			a.document.close();
        }
        function vieworder(ordercode) {
			var xhttp;
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {  
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("modalorder").innerHTML = this.responseText;
							
			}
						
			};			  
			xhttp.open("GET", "getorder_details.php?order_code="+ordercode, true);
			xhttp.send(); 
			
              $("#mymodal").modal();
        }
    </script>

    <script src="js/jquery/jquery-2.2.4.min.js"></script>
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