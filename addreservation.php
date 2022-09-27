<?php session_start();
	include 'connect.php';
	date_default_timezone_set('Asia/Manila');
	$client_id = $_SESSION['client_id'];
	$email = $_SESSION['email'];
	
	
	$splitcolumns = explode("/",$_POST['service']);
	$service  = $splitcolumns[0];
	$start = $_POST['start'];
	$end = $_POST['end'];
	
	$new_time = DateTime::createFromFormat('h:i A', $start);
	$newStart = $new_time->format('H:i:s');
	$new_time = DateTime::createFromFormat('h:i A', $end);
	$newEnd = $new_time->format('H:i:s');
	
	$event_date = $_POST['Event_date'];	
	$reservation_code = "RC".date("Ymd").date("His");
	$dateissued = date("Y-m-d,H:i:s");

		Try{
			$insertTranscation = " INSERT INTO `reservation` (`reservation_code`, `dateissued`, `res_status`, `res_date`, `starttime`, `endtime`, `fkclient_id`, `tableID`) VALUES ('$reservation_code', '$dateissued', 'Pending', '$event_date', '$newStart', '$newEnd','$client_id', '$service')";
			
			$conn->beginTransaction();
			
			$conn->exec($insertTranscation);
		
			$conn->commit();
			
			 echo  '<script>alert(" You have succesfully booked your Reservation!."); window.location.href="reservation.php";</script>';
		}catch(PDOException $exception){
			$conn->rollBack();
			//echo  '<script>alert("an error occured while creating account!."); window.location.href="index.php";</script>';
             echo  '<script>alert("an error Occured while booking your Reservation!."); window.location.href="reservation.php";</script>';
		  
			echo $exception->getMessage();
		}
?>