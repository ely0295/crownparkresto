<?php session_start();
	include 'connect.php';
	date_default_timezone_set('Asia/Manila');
	
	$prod_code = $_POST['prod_code'];
	$prod_quantity = $_POST['prod_quantity'];
	$client_id = $_SESSION['client_id'];
	
		Try{
				$conn->beginTransaction();
				$dateadded = date('Y/m/d H:i:s');
				
				//check if meal already exist in the cart
				$quantity_result = $conn->query("select * from cart where product_code = '$prod_code' and client_id='$client_id' ");
				if($quantity_result->rowCount() > 0){
					$update_query = "UPDATE `cart` SET quantity=(quantity + '$prod_quantity')  WHERE product_code = '$prod_code' and client_id='$client_id'";
					if($conn->exec($update_query)){
						$conn->commit();
								
							echo  '<script>alert("Added to Your Cart!.."); window.location.href="cart.php"</script>';
					}else{
						echo  '<script>alert("An Error Occured  while Adding product.."); window.location.href="menu.php"</script>';
					}
				}else{
					$insert_query = " INSERT INTO `cart` (`date_added`,`client_id`, `product_code`, `quantity`) 
				VALUES ('$dateadded','$client_id','$prod_code', '$prod_quantity')";
					if($conn->exec($insert_query)){
					$conn->commit();
							
						echo  '<script>alert("Added to Your Cart!.."); window.location.href="cart.php"</script>';
					}else{
						echo  '<script>alert("An Error Occured  while Adding product.."); window.location.href="menu.php"</script>';
					}
				}
				
			
				
				
				
				
					
			
		}catch(PDOException $exception){
			$conn->rollBack();
			echo  '<script>alert("an error occured while adding product!."); window.location.href="menu.php";</script>';
              
			echo $exception->getMessage();
		}
?>