<?php
	session_start();
	include 'connect.php';
	date_default_timezone_set('Asia/Manila');
	if(isset($_REQUEST['value1']) and isset($_REQUEST['id'])){
	$value1 = $_REQUEST['value1'];
	$id = $_REQUEST['id'];
	
		Try{
			$conn->beginTransaction();
			$insertclient_query = " UPDATE cart set quantity=$value1 where cart_ID='$id'";
			
				
			$conn->exec($insertclient_query);
			$conn->commit();
			?>
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
											  <td><input style = "width:100px;" type="number" onchange = "updatequantity(this.value,'<?php echo $row1["cart_ID"]?>')" type="number" class="form-control text-center" value="<?php echo $row1["quantity"]?>">
											   <?php 
												$quantity_result = $conn->query("select quantity from inventory where product_code = '$prod_code' ");
												$row_quantity = $quantity_result->fetch(PDO::FETCH_ASSOC);
												$dbquantity = $row_quantity["quantity"];
												if((int)$dbquantity <  (int)$row1["quantity"]){
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
			<?php
			
			
			
		}catch(PDOException $exception){
			$conn->rollBack();  
			echo $exception->getMessage();
		}
	}
?>