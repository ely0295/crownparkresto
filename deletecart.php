<?php session_start();
	include 'connect.php';
	date_default_timezone_set('Asia/Manila');
	
	$cartid = $_POST['cartid'];
	
		Try{
			
			$delete_query = " Delete From cart where cart_ID = '$cartid'";
			
				$conn->beginTransaction();
				
				
				
				if($conn->exec($delete_query)){
					$conn->commit();
							
						echo  '<script>alert("We have Succefully Removed your Item!.."); window.location.href="cart.php"</script>';
				}else{
					echo  '<script>alert("An Error Occured  while Removing Item.."); window.location.href="cart.php"</script>';
				}
			
		}catch(PDOException $exception){
			$conn->rollBack();
			echo  '<script>alert("an error occured while removing item!."); window.location.href="cart.php";</script>';
              
			echo $exception->getMessage();
		}
?>