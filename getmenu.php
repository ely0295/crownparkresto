<?php 
if(isset($_REQUEST['category_code'])){
	$code = $_REQUEST['category_code'];
	include 'connect.php';
		$Get_query = "select A.*,B.* from product as A JOIN inventory as B on A.product_code = B.product_code where A.category_code = '$code'";
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
			}else{
				?><h4>No Result Found. Please Try Again. </h4><?php
				
			}
}
?>