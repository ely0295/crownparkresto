<?php
	include '../connect.php';
if (isset($_REQUEST["pageno"]) and isset($_REQUEST["noofrecords"])) {
    $pageno = $_REQUEST["pageno"];
    $no_of_records_per_page = $_REQUEST["noofrecords"]; 
    
    
} else {
    $pageno = 1;
    $no_of_records_per_page = 5;
}

$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages_sql = "SELECT * FROM orders";
$result = $conn->query($total_pages_sql);
$total_rows = $result->rowCount();
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM orders LIMIT $offset, $no_of_records_per_page";
$result = $conn->query($sql);
if($result->rowCount() > 0){
    ?>  <div id = "mydatatable" style = "padding:0;">
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
    </div>  
 </div>  	
    <?php	
}
?>
<br>
<div class="clearfix">

	<div class="hint-text">Showing <b><?php echo $no_of_records_per_page;?> per page</b> out of <b><?php echo $total_rows;?></b> entries</div>
		<ul class="pagination" id="pagination">
            <li class="<?php if($pageno <= 1){ echo 'page-item disabled'; } ?>">
                <a href = "javascript:retrieveOrders('<?php if($pageno <= 1){ echo $pageno; }else{ echo $pageno - 1; } ?>',document.getElementById('perpage').value)">Previous</a>
            </li>    

            <?php
                for($i = 1;$i<=$total_pages; $i++){
                   ?><li class="page-item <?php if($pageno == $i){ echo "active";} ?>" > <a href = "javascript:retrieveOrders('<?php echo $i; ?>',document.getElementById('perpage').value)" class="page-link"><?php echo $i; ?></a></li><?php
                }
            ?>
		<li class="<?php if($pageno >= $total_pages){ echo 'page-item disabled'; } ?>">
        <a href = "javascript:retrieveOrders('<?php if($pageno >= $total_pages){ echo $total_pages; }else{ echo $pageno + 1; } ?>',document.getElementById('perpage').value)">Next</a>
    </li>
		</ul>
	</div>
</div> 
<?php
?>