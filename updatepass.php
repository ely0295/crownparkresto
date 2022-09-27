<?php session_start();
	include 'connect.php';
	date_default_timezone_set('Asia/Manila');
	$client_id = $_SESSION['client_id'];
	$password = $_POST['inputpass2'];
	

		Try{
			$updateclient_query = "UPDATE `user_account` SET `userpass`='$password' WHERE client_id = '$client_id'";
		 
			$conn->beginTransaction();
			
			$conn->exec($updateclient_query);
			$conn->commit();
			
			 echo  '<script>alert("User Password Succesfully Updated!."); window.location.href="profile.php";</script>';
		}catch(PDOException $exception){
			$conn->rollBack();
			//echo  '<script>alert("an error occured while creating account!."); window.location.href="index.php";</script>';
              
			echo $exception->getMessage();
		}
?>