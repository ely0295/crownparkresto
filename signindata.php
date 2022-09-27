<?php 
session_start();
if(isset($_POST['btnlogin'])){
	include("connect.php");
	$uname = $_POST['uname'];
	
	$psw =  $_POST['psw'];
	
	$sql = "Select U.*,C.* from user_account as U join client as C on U.client_id= C.client_id WHERE BINARY  username = '".$uname."' AND userpass = '".$psw."'";         	
	$result = $conn->query($sql);
	if ($result->rowCount() > 0) {
		// output data of each row
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			//set the $_SESSION['signed_in'] variable to TRUE
			$_SESSION['signed_in'] = true;
			//we also put the user_id and user_name values in the $_SESSION, so we can use it at various pages
				$_SESSION['name']    = $row['firstname'];
				$_SESSION['fullname']    = $row['firstname']." ".$row['middlename']." ".$row['lastname'];
				$_SESSION['client_id']    = $row['client_id'];
				$_SESSION['acc_id']    = $row['acc_id'];
				$_SESSION['email']    = $row['email'];
				$_SESSION['usertype']    = $row['usertype'];
				$conn=null;
				?>
			<script>
				window.location.href = "index.php";
			</script>
				<?php	
		}
	} else {
		echo  '<script>alert("Invalid Username or Password! Please try again"); window.location.href="index.php";</script>';	
	}

	$conn=null;


}


?>