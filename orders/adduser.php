<?php 
    session_start();
    //Getting User Info
    include '../connect.php';
    // user info
    date_default_timezone_set('Asia/Manila');
    $action_date = date("y-m-d h:i:sa");
    $user_id = "U002121";

    if(isset($_REQUEST["fname"])){
        try{
            $conn->beginTransaction();
            // prepare sql and bind parameters
            $stmt = $conn->prepare("insert INTO user_information (fname,lname,address,email,contact,date_inserted)
            VALUES (:fname,:lname,:address,:email,:contact,:date_inserted)");
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':contact', $contactno);
            $stmt->bindParam(':date_inserted', $date_inserted);

            $fname = $_REQUEST["fname"];
            $lname = $_REQUEST["lname"];
            $address = $_REQUEST["address"];
            $email = $_REQUEST["email"];
            $contactno = $_REQUEST["contactno"];
            $date_inserted = $_REQUEST["date_inserted"];
            
            $stmt->execute();
            //$conn->query($insert_query);

            $getlastrowID = "select * FROM user_information  ORDER BY customer_id DESC LIMIT 1";
            $result = $conn->query($getlastrowID);
            $row1 = $result->fetch(PDO::FETCH_ASSOC);

            $id = $row1["customer_id"];
            $insert_logs = "insert INTO `actionlogs`(`table_name`, `table_id`, `table_action`, `action_dt`, `act_by`) VALUES ('user_information','$id','ADD','$action_date','$user_id')";
            $conn->query($insert_logs);     
            $conn->commit();
            echo "Saved";

        }catch(PDOException  $ex){
            $conn->rollBack(); 
            echo "Not-Saved"; 
        }
    }
	
	

?>