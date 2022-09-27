<?php session_start();
	include '../connect.php';
	date_default_timezone_set('Asia/Manila');
	
	$Category = $_POST['Category'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	
		Try{
			
			if ($_FILES["fileuploadimg"]["size"] > 0 ) {
				$target_dir = "../product_img/";
				$target_file = $target_dir . basename($_FILES["fileuploadimg"]["name"]);
								
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$ran = "IMG".date('YmdHis');
				$ran2 = $ran.".";
								
				$imgfilename = $ran2.$imageFileType;
				$target = $target_dir.$ran2.$imageFileType;
				$productCode = date('YmdHis');
				$insert_query = " INSERT INTO `product` (`product_code`,`product_name`, `price`, `category_code`, `product_img`) 
				VALUES ('$productCode','$description', '$price', '$Category', '$imgfilename')";
				$insert_queryinventory = " INSERT INTO `inventory` (`product_code`, `quantity`) 
				VALUES ('$productCode', 0)";
			
				$conn->beginTransaction();
				
				
				
				if($conn->exec($insert_query) and $conn->exec($insert_queryinventory)){
					$conn->commit();
							move_uploaded_file($_FILES["fileuploadimg"]["tmp_name"], $target);
						echo  '<script>alert("We have Succefully Added your product!.."); window.location.href="../admin_products.php"</script>';
				}else{
					echo  '<script>alert("An Error Occured  while Adding product.."); window.location.href="../admin_products.php"</script>';
				}		
			}else{
				echo  '<script>alert("Please Select a valid Image!.."); //window.location.href="../myprofile.php?id='.$user_id.'"</script>';
			}
			
		}catch(PDOException $exception){
			$conn->rollBack();
			echo  '<script>alert("an error occured while creating account!."); window.location.href="admin_products.php";</script>';
              
			echo $exception->getMessage();
		}
?>