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
    <title>Crown Park Restaurant | Cart Page</title>

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
    <!--  Cart Area End -->
        <div class="container-cart">
            <div class="cart-content" id = "cartlist">
                <div class="row">
                        <div class="col-md-8 cart-card">
                             <div class="cart-heading text-center py-3 mb-0">
							 
                                <h3><i class="fa fa-shopping-cart heading-icon" aria-hidden="true"></i> Cart</h3>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr >
                                      <th scope="col"  class="d-none d-sm-table-cell" style="border-bottom: none;"></th>
                                      <th scope="col" style="border-bottom: none;">Description</th>
                                      <th scope="col" style="border-bottom: none;">Price</th>
                                      <th scope="col" style="border-bottom: none;">Quantity</th>
                                      <th scope="col" class="d-none d-sm-table-cell"style="border-bottom: none;">Subtotal</th>
                                      <th scope="col" style="border-bottom: none;"></th>
                                    </tr>
                                 </thead>
                                <tbody>
								 <?php
						
									include 'connect.php';
									$client_id = $_SESSION['client_id'];
									$Get_query = "select A.*,B.* from cart as A JOIN product as B on A.product_code = B.product_code where A.client_id = '$client_id'";						
									$result = $conn->query($Get_query);
									$total = 0;
									$counter = 0;
									if($result->rowCount() > 0){
										while($row1 = $result->fetch(PDO::FETCH_ASSOC)){
											$prod_code = $row1["product_code"];
											?>
											<tr>
											  <td class="d-none d-sm-table-cell"><img class="img-thumbnail" src="product_img/<?php echo $row1["product_img"]?>" alt=""width="90" height="90"></td>
											  <td><?php echo $row1["product_name"]?></td>
											  <td>&#8369;<?php echo $row1["price"]?></td>
											  <td><input style = "width:100px;" min = 1 type="number" onchange = "updatequantity(this.value,'<?php echo $row1["cart_ID"]?>')" type="number" class="form-control text-center" value="<?php echo $row1["quantity"]?>">
											  <?php 
												$cart_quantity = $row1["quantity"];
												$quantity_result = $conn->query("select quantity from inventory where product_code = '$prod_code' ");
												$row_quantity = $quantity_result->fetch(PDO::FETCH_ASSOC);
												$dbquantity = $row_quantity["quantity"];
												if((int)$cart_quantity > (int)$dbquantity ){
													?><small class="text" style = "color:red;">Quantity exceeds! Available Stock (<?php echo $dbquantity; ?>)</small><?php
												}
												?>
											  
											  </td>
											  <td class="d-none d-sm-table-cell">&#8369;<?php echo ($row1["price"] * $row1["quantity"]);?></td>
											  <td><button class="btn btn-danger bot" style="pad" onclick="deleteitem('<?php echo $row1["cart_ID"]; ?>');" >Cancel</button></td>
											</tr>
											<?php	
											$total = $total + ((int)$row1["price"] * (int)$row1["quantity"]);
											$counter ++;												
										}
									}
								?>						
                                  
                                </tbody>
                            </table>
							<button class="btn btn-danger bot" onclick = "window.location.href='menu.php';">Continue Ordering</button>
                        </div>
                        <div class="col-md-4 checkout-card" id="checkCard1">
                           <div class="checkout-content">
                                <div class="cart-heading text-center">
                                    <h6 class="text-muted text-center">You have <?php echo $counter; ?> item(s) on your cart</h6>
                                </div>
                                <div class="cart-description">
                                    <table class="table">
                                        <tr>
                                            <td>Subtotal: </td>
                                            <td>&#8369; <?php echo $total; ?></td>
                                        </tr>
                                        <tr>
                                           <th>Order Type: </th>
                                           <td><select class="checkout-select" id="orderType" onchange="show()">
                                               <option  value="0" disabled>Select</option>
                                               <option selected value="1" >For Pick-up</option>
                                               <option value="2">Add to Reservation</option>
                                              </select>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                           </div>
                           <br>
                           <br>
                           <div class="checkout-footer">
                                <div class="cart-description">
                                    <table class="table">
                                        <tr>
                                            <th>Total: </th>
                                            <th>&#8369; <?php echo $total; ?></th>
                                        </tr>
                                    </table>
                                    <button class="btn btn-danger btn-lg btn-block" onclick="checkout('<?php echo $total; ?>')">Checkout</button>
                                </div>
                           </div>
                        </div>
                         <div class="col-md-4 checkout-card" id="checkCard2" style="display:none;">
                           <div class="checkout-content">
                                <div class="cart-heading text-center">
                                    <h6 class="text-muted text-center">You have <?php echo $counter; ?> item(s) on your cart</h6>
                                </div>
                                <div class="cart-description">
                                    <table class="table">
                                        <tr>
                                            <td>Subtotal: </td>
                                            <td>&#8369; <?php echo $total; ?></td>
                                        </tr>
                                        <tr>
                                           <th>Order Type: </th>
                                           <td><select class="checkout-select" id="orderType1" onchange="show2()">
                                               <option value="0"  disabled>Select</option>
                                               <option value="1">For Pick-up</option>
                                               <option selected value="2">Add to Reservation</option>
                                              </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Reservation#: </th>
                                            <td>
                                                <select class="reservation-select">
                                                   <option selected>Select</option>
                                                   <option>012154745614</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                           </div>
                           <br>
                           <br>
                           <div class="checkout-footer">
                                <div class="cart-description">
                                    <table class="table">
                                        <tr>
                                            <th>Total: </th>
                                            <th>&#8369; <?php echo $total; ?></th>
                                        </tr>
                                    </table>
                                    <button class="btn btn-danger btn-lg btn-block" onclick="checkout2()">Place Order</button>
                                </div>
                           </div>
                        </div>
                </div>
            </div>
        </div>

   <!--  Cart Area End -->

        <!-- Modal Section Start  -->
     <div class="modal section-padding-100" id="mymodal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Order Confirmation</h5>
                  </div>
                  <div class="modal-body">
                     <div class="cart-description">
                             <table class="table">
                               <tr>
                                   <th> Grand Total: </th>
                                   <th>&#8369; <b id = "grandtotal">894</b></th>
                                </tr>

                             </table>
                             <small class="text-muted">Note: You will receive this order number on your email and phone number shortly. Present this to the cashier upon pickup.</small>
                     </div>
                  </div>
                  <div class="modal-footer">
				  <button type="button" class="btn btn-success" id = "btnplace"onclick ="placeorder()">Confim</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
        </div>
    <!-- Modal  Start  -->
     <div class="modal section-padding-100" id="myModal_prompt">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id = "prompt_title"></h5>
                  </div>
                  <div class="modal-body">
                     <div class="cart-description">

                             <small class="text-muted" id = "prompt_content">Note: You will receive this order number on your email and phone number shortly. Present this to the cashier upon pickup.</small>
                     </div>
                  </div>
                  <div class="modal-footer">				 
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
        </div>
    <!-- Modal Section End  -->

     <!-- Modal Section Start  -->
     <div class="modal section-padding-100" id="deleteitemmodal">
              <div class="modal-dialog">
                <div class="modal-content">
				 <form id = "frmdeleteres" method = "post" action = "deletecart.php">
                  <div class="modal-header">
                    <h5 class="modal-title">Delete item?</h5>
                  </div>
				 
                  <div class="modal-body">
                     <div class="cart-description">
                             <input  type="hidden" class="form-control" id="cartid" name= "cartid">				
							<p>Are you sure you want to delete these item?</p>
							<p class="text-warning"><small>This action cannot be undone.</small></p>
                     </div>
                  </div>
				  
                  <div class="modal-footer">
				  <input type="submit" class="btn btn-danger" value="Delete">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
                  </div>
				  </form>
                </div>
              </div>
        </div>

    <!-- Modal Section End  -->



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
			function updatequantity(value1,id){
				var xhttp;
			  xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					
					document.getElementById("cartlist").innerHTML = this.responseText;
				}
			  };
			  document.getElementById("cartlist").innerHTML = "";
			  xhttp.open("GET", "updatequantity.php?value1="+value1+"&id="+id, true);
			  xhttp.send();  
			}
			function deleteitem(id){
				document.getElementById("cartid").value = id;
				$("#deleteitemmodal").modal();
			}
			function placeorder(){
			var xhttp;
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {  
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("btnplace").disabled = false;
				var response = JSON.stringify(this.responseText);
				var newreponse = (response).slice(6,20);
				//alert(newreponse);
				if(newreponse == 'DATASNOSAVED"'){
					document.getElementById("prompt_title").innerHTML = "Sorry!";
					document.getElementById("prompt_content").innerHTML = "An Error Occured While Placing Order Please try Again.";
					$("#myModal_prompt").modal();
					setTimeout(function(){
					  $('#myModal_prompt').modal('hide')
					}, 3000);
				}
				else if(newreponse == 'DATASFORWARD"'){
					document.getElementById("prompt_title").innerHTML = "Success!";
					document.getElementById("prompt_content").innerHTML = "Order Succesfully Placed";
					$("#myModal_prompt").modal();
					setTimeout(function(){
					  $('#myModal_prompt').modal('hide')
					  window.location.href = "orders.php";
					}, 3000);
				}
				else{
					document.getElementById("prompt_title").innerHTML = "An Error Occured!";
					document.getElementById("prompt_content").innerHTML = "One or more Meal exceeded the quantity limit!. Please Check your cart Thank you! ";
					$("#myModal_prompt").modal();
					setTimeout(function(){
					  $('#myModal_prompt').modal('hide')
					  window.location.href = "cart.php";
					}, 5000);
					
				}
							
			}
						
			};
			$("#mymodal").modal('hide');		  
			document.getElementById("btnplace").disabled = true;
			xhttp.open("GET", "placeorder.php", true);
			xhttp.send(); 
		 }
         function show() {
             var a = document.getElementById('orderType').value;
              if (a==2) {
                document.getElementById("checkCard1").style.display = "none";
                document.getElementById("checkCard2").style.display = "block";
                document.getElementById("orderType1").value = '2';
             }else{
                document.getElementById("checkCard2").style.display = "none";
                document.getElementById("checkCard1").style.display = "block";
                document.getElementById("orderType").value = '1';
             }
         }
         function show2() {
            var a = document.getElementById('orderType1').value;
            if (a==2) {
                document.getElementById("checkCard1").style.display = "none";
                document.getElementById("checkCard2").style.display = "block";
                document.getElementById("orderType1").value = '2';
             }else{
                document.getElementById("checkCard2").style.display = "none";
                document.getElementById("checkCard1").style.display = "block";
                document.getElementById("orderType").value = '1';
             }
         }
        function checkout(total) {
			if (total == "0" || total == 0  ){
				alert('Please Add Item(s) to proceed!, Thank you!');
				return 0;
			}
			 document.getElementById("grandtotal").innerHTML = total;
              $("#mymodal").modal();
        }
         function checkout2(total) {
			 if (total == "0" || total == 0  ){
				alert('Please Add Item(s) to proceed!, Thank you!');
				return 0;
			}
              $("#mymodal2").modal();
        }
         function redirectToReservation() {
            window.location.href="reservations.html";
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