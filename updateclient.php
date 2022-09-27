<?php session_start();
	include 'connect.php';
	date_default_timezone_set('Asia/Manila');
	$fname = strtoupper($_POST['inputFname']);
	$mname = strtoupper($_POST['inputmname']);
	$lname = strtoupper($_POST['inputlname']);
	$DOB = $_POST['inputyear']."/".$_POST['inputmonth']."/".$_POST['inputday'];
	$client_id = $_SESSION['client_id'];
	$inputhouse = strtoupper($_POST['inputhouse']);
	$inputzone = strtoupper($_POST['inputzone']);
	$inputsub = strtoupper($_POST['inputsub']);
	$inputbrgy = strtoupper($_POST['inputbrgy']);
	$inputprov = strtoupper($_POST['inputprov']);
	$inputcity = strtoupper($_POST['inputcity']);
	
	
	$gender = strtoupper($_POST['inputgender']);
	$contact = strtoupper($_POST['inputcontact']);
	

		Try{
			$updateclient_query = "UPDATE `client` SET `firstname`='$fname',`middlename`='$mname',`lastname`='$lname',`contact_no`='$contact',`gender`='$gender',`DOB`='$DOB',`house_num`='$inputhouse',`zone`='$inputzone',`subdivision`='$inputsub',`barangay`='$inputbrgy',`province`='$inputprov',`city`='$inputcity' WHERE client_id = '$client_id'";
		 
			$conn->beginTransaction();
			
			$conn->exec($updateclient_query);
			$conn->commit();
			
			 echo  '<script>alert("User information Succesfully Updated!."); window.location.href="profile.php";</script>';
		}catch(PDOException $exception){
			$conn->rollBack();
			//echo  '<script>alert("an error occured while creating account!."); window.location.href="index.php";</script>';
              
			echo $exception->getMessage();
		}
?>