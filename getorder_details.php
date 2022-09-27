<?php 
if(isset($_REQUEST['order_code'])){
	$ordercode = $_REQUEST['order_code'];
		include 'connect.php';
		session_start();
		$Get_query1 = "select A.*,B.*,C.price,C.product_name,C.product_img from orders as A JOIN order_product_list as B on A.order_code = B.order_code JOIN product as C on B.product_code = C.product_code where  A.order_code = '$ordercode '";	
		$result1 = $conn->query($Get_query1);
		$total = 0;
		if($result1->rowCount() > 0){
			?>
			<div class="modal-content">
                  <div class="modal-header">
                   
                  </div>
                  <div class="modal-body">
                     <div class="cart-description">
					  
					  <div id = "Printdiv">
					  <h5 class="modal-title"><img src="img/logo.png" style="width: 50px; height: 50px;"> Crown Park Restaurant</h5>
					  <br>
					
					  <label for="usrname"> <?php echo $_SESSION['fullname']; ?>  </label>
					  <h5 class="modal-title">ORDER# - <?php echo $ordercode; ?></h5>
                             <table class="table">
								<tr class="text-light bg-dark">
                                   <th>DISH</th>
								   <th>PRICE</th>
                                   <th>QUANTITY</th>
                                   <th>AMOUNT</th>
                                </tr>
								<?php
								while($row1 = $result1->fetch(PDO::FETCH_ASSOC)){
										$status = $row1["order_status"];
										?>
										<tr>
										   <td><?php echo $row1["product_name"]?></th>
										    <td><?php echo $row1["price"]?></th>
										   <td>x<?php echo $row1["product_quantity"]?></td>
										   <td>&#8369;<?php echo ((int)$row1["price"] * (int)$row1["product_quantity"]); ?></td>
										</tr>
										<?php
									
									
									
										$total = $total + ((int)$row1["price"] * (int)$row1["product_quantity"]);
									}
								?>
                                <tr>
                                   <th colspan="3"> </th>
                                   <th>Total: &#8369; <?php echo $total; ?></th>
                                </tr>
                                <tr>
                                   <th colspan="3"></th>
                                   <th>Status: <?php echo $status; ?></th>
                                </tr>
                             </table>
                             
                             <label class="fw-bold">Pickup Time:</label>
                             <input type="time" name="" value="13:00" size="4">
							 </div>
                             <small class="text-muted">Note: You can adjust pick-up time. Click "Update" once done.</small>
                     </div>
                  </div>
                  <div class="modal-footer">
						<button type="button" class="btn btn-sm btn-info" onclick="printDiv()">PRINT ORDER DETAILS</button>
                     <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">CLOSE</button>
                    
                  </div>
                </div>
			<?php
			
			
		}
		
}
?>