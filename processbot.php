<?php

/* Establishes a connection with database. First argument is the server name, second is the username for database, third is password (blank for me) and final is the database name 
*/
include("connect.php");
// If connection is established succesfully
if($conn)
{
     // Get users message from request object and escape characters
    $user_messages = $_POST['messageValue'];
	$user_messages = preg_replace('/[^A-Za-z0-9\-]/', '', $user_messages);
    // create SQL query for retrieving corresponding reply
    $query = "SELECT * FROM chatbot WHERE messages LIKE '%$user_messages%'";

     // Execute query on connected database using the SQL query
	 $makeQuery = $conn->query($query);
	if($makeQuery->rowCount() > 0){
		$result = $makeQuery->fetch(PDO::FETCH_ASSOC);
		echo $result['response'];
	}else{
		echo "Sorry, I can't understand you.";
	}
    
}else {

    // If connection fails to establish, echo an error message
    echo "Connection failed" . mysqli_connect_errno();
}
?>