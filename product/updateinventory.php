<?php
	include '../connect.php';
	date_default_timezone_set('Asia/Manila');
	$uproduct_code = $_POST['uproduct_code'];
	$uquantity = $_POST['uquantity'];
	
		Try{
			$conn->beginTransaction();
			$insertclient_query = " UPDATE inventory set quantity='$uquantity ' where product_code='$uproduct_code'";
			
				
			$conn->exec($insertclient_query);
			$conn->commit();
			
			echo  '<script>alert("We have Succefully Updated product Quantity!.."); window.location.href="../inventory.php"</script>';
		}catch(PDOException $exception){
			$conn->rollBack();
			echo  '<script>alert("an error occured while creating account!."); window.location.href="inventory.php";</script>';
              
			echo $exception->getMessage();
		}
?>