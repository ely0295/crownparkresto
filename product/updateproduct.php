<?php
	include '../connect.php';
	date_default_timezone_set('Asia/Manila');
	$Category = $_POST['uCategory'];
	$description = $_POST['udescription'];
	$price = $_POST['uprice'];
	$uproduct_code = $_POST['uproduct_code'];

	
		Try{
			
			if ($_FILES["fileuploadimg"]["size"] > 0 ) {
				$target_dir = "../product_img/";
				$target_file = $target_dir . basename($_FILES["fileuploadimg"]["name"]);
								
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$ran = "IMG".date('YmdHis');
				$ran2 = $ran.".";
								
				$imgfilename = $ran2.$imageFileType;
				$target = $target_dir.$ran2.$imageFileType;
				$insertclient_query = " UPDATE product set product_name='$description',price='$price',category_code='$Category',product_img='$imgfilename' where product_code='$uproduct_code'";
			
				$conn->beginTransaction();
				
				
				
				if($conn->exec($insertclient_query)){
					$conn->commit();
							move_uploaded_file($_FILES["fileuploadimg"]["tmp_name"], $target);
						echo  '<script>alert("We have Succefully Updated your product!.."); window.location.href="../dashboard.php"</script>';
				}else{
					echo  '<script>alert("An Error Occured  while Updateding product.."); window.location.href="../dashboard.php"</script>';
				}		
			}else{
				$insertclient_query = " UPDATE product set product_name='$description',price='$price',category_code='$Category' where product_code='$uproduct_code'";
			
			
				$conn->beginTransaction();
				$conn->exec($insertclient_query);
				$conn->commit();
				echo  '<script>alert("We have Succefully Updated your product!.."); window.location.href="../dashboard.php"</script>';
				
			}
			
		}catch(PDOException $exception){
			$conn->rollBack();
			echo  '<script>alert("an error occured while creating account!."); window.location.href="index.php";</script>';
              
			echo $exception->getMessage();
		}
?>