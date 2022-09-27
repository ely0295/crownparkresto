<?php 
session_start();
//Searching User Info

if(isset($_REQUEST["Sinput"]) ){
    
    $input = $_REQUEST["Sinput"];
	$access = $_REQUEST["access"];
	if($_REQUEST["hasdate"] != "none"){
		
		$hasdate = $_REQUEST["hasdate"];
		if($access == "details"){
			//echo $hasdate;
			$Get_query = "select * FROM orders where order_code = '".$input."' and date_ordered like '%".$hasdate."%'";
		}else{
			$Get_query = "select * FROM orders where  date_ordered like '%".$hasdate."%'";
		}
		//echo $Get_query;
	}else{
		if($access == "details"){
			$Get_query = "select * FROM orders where  order_code = '".$input."' ";
		}else{
			$Get_query = "select * FROM orders ";
		}
		//echo $Get_query;
	}
	include '../connect.php';
	$result = $conn->query($Get_query);
	if($result->rowCount() > 0){
		?>
			<div id = "mydatatable" style = "padding:0;">
            <div class="table-responsive">
                        <table class="table text-start align-middle table-hover mb-0" id = "mytable">
                            <thead>
                                <tr class="text-dark">
                                 
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
						while($row1 = $result->fetch(PDO::FETCH_ASSOC)){
							$ordercode = $row1["order_code"];
						$date = strtotime($row1["date_ordered"]);
							?>
							<tr class="text-dark">
                                   
                                    <td><?php echo date('d M Y' , strtotime($row1["date_ordered"])); ?></td>
                                    <td><?php echo $row1["order_code"]?></td>
                                    <td>1:00 PM</td>
									<?php 
												$Get_query1 = "select A.*,B.*,C.price,C.product_name,C.product_img from orders as A JOIN order_product_list as B on A.order_code = B.order_code JOIN product as C on B.product_code = C.product_code where  A.order_code = '$ordercode '";	
												$result1 = $conn->query($Get_query1);
												$total = 0;
												if($result1->rowCount() > 0){
													while($row2 = $result1->fetch(PDO::FETCH_ASSOC)){
														$total = $total + ((int)$row2["price"] * (int)$row2["product_quantity"]);
													}
												}
												?>
                                    <td class="d-none d-sm-table-cell">&#8369;<?php echo $total; ?>
									
									</td>
                                    <td class="d-none d-sm-table-cell"><?php echo $row1["order_status"]?></td>
                                    <td><button class="tda btn btn-sm btn-danger" onclick="vieworder('<?php echo $row1["order_code"]?>')">View</button></td>
                        </tr>
							<?php
						}
					
					?>
					
					 
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Search Result Keyword "<?php echo $input ;?>" <b>( <?php echo $result->rowCount() ;?> )</b></div>
				
			</div>
		<?php	
	}else{
        ?>
        <table class="table table-striped table-hover">
		    <tr>
				<td style = "text-align:center;">
					<h3>No Data Found</h3>
				</td>
							
			</tr>
		</table>
        <div class="hint-text">Search Result Keyword "<?php echo $input ;?>" <b>( <?php echo $result->rowCount() ;?> )</b></div>
        <?php


    }


}


?>