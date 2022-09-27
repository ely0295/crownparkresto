<?php session_start();
	include 'connect.php';
	date_default_timezone_set('Asia/Manila');
	$client_id = $_SESSION['client_id'];
	
	
		Try{
				$conn->beginTransaction();
				$order_code = $ran = "OR".date('YmdHis');
				$dateadded = date('Y/m/d H:i:s');
				$insert_queryinventory = " INSERT INTO `orders` (`order_code`, `date_ordered`, `client_id`, `order_status`) 
				VALUES ('$order_code', '$dateadded','$client_id','Pending')";
				$conn->exec($insert_queryinventory);
			
				$Get_query = "select * from cart where client_id = '$client_id' ";						
				$result = $conn->query($Get_query);
				$counter= 1;
				if($result->rowCount() > 0){
					while($row1 = $result->fetch(PDO::FETCH_ASSOC)){
						$prod_code = $row1["product_code"];
						$quantity = $row1["quantity"];
						
						//check if quantity is available
						$quantity_result = $conn->query("select quantity from inventory where product_code = '$prod_code' ");
						$row_quantity = $quantity_result->fetch(PDO::FETCH_ASSOC);
						$dbquantity = $row_quantity["quantity"];
						if($dbquantity >= $quantity){
							$inserttoproductlist = " INSERT INTO `order_product_list` (`order_code`, `product_code`, `product_quantity`) 
							VALUES ('$order_code', '$prod_code','$quantity ')";
							$updateinventory = "UPDATE `inventory` set quantity = (quantity - '$quantity') where product_code = '$prod_code'";
							$conn->exec($inserttoproductlist);
							$conn->exec($updateinventory);
						}else{
							$conn->rollBack();
							echo '';
							return 0;
						}
						
						
					}
					$delete_query = " Delete From cart where client_id = '$client_id'";
					$conn->exec($delete_query);
					$conn->commit();
					echo 'DATASFORWARD';
				}else{
					$conn->rollBack();
					echo 'DATASNOSAVED';
              
				}	
				
			
			
		}catch(PDOException $exception){
			$conn->rollBack();
					echo 'DATANOSAVED';
			//echo $exception->getMessage();
		}
?>