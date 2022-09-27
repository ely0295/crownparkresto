<?php session_start();
	include 'connect.php';
	date_default_timezone_set('Asia/Manila');
	$fname = strtoupper($_POST['inputFname']);
	$mname = strtoupper($_POST['inputmname']);
	$lname = strtoupper($_POST['inputlname']);
	$DOB = $_POST['inputyear']."/".$_POST['inputmonth']."/".$_POST['inputday'];
	
	$inputhouse = strtoupper($_POST['inputhouse']);
	$inputzone = strtoupper($_POST['inputzone']);
	$inputsub = strtoupper($_POST['inputsub']);
	$inputbrgy = strtoupper($_POST['inputbrgy']);
	$inputprov = strtoupper($_POST['inputprov']);
	$inputcity = strtoupper($_POST['inputcity']);
	
	
	$gender = strtoupper($_POST['inputgender']);
	$contact = strtoupper($_POST['inputcontact']);
	$emailadd = $_POST['inputemail'];
	$password = $_POST['inputpass2'];	
	$client_code = "CC".date("Ymd").date("His");
	

		Try{
			$insertclient_query = " INSERT INTO `client` (`client_id`, `firstname`, `middlename`, `lastname`, `contact_no`, `gender`, `email`, `DOB`, `house_num`, `zone`, `subdivision`, `barangay`, `province`, `city`) VALUES ('$client_code', '$fname', '$lname', '$mname', '$contact', '$gender', '$emailadd', '$DOB', '$inputhouse', '$inputzone','$inputsub', '$inputbrgy', '$inputprov','$inputcity')";
			$insertaccount_query1 = " INSERT INTO `user_account` (`acc_id`, `username`, `userpass`, `usertype`, `active`, `client_id`) VALUES (NULL, '$emailadd','$password','client',0,'$client_code')";
		 
			$conn->beginTransaction();
			
			$conn->exec($insertclient_query);
			$conn->exec($insertaccount_query1);
			$conn->commit();
			
			 echo  '<script>alert("Account Succesfully created!."); window.location.href="index.php";</script>';
		}catch(PDOException $exception){
			$conn->rollBack();
			//echo  '<script>alert("an error occured while creating account!."); window.location.href="index.php";</script>';
              
			echo $exception->getMessage();
		}
?>