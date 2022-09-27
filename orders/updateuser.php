<?php 
    session_start();
    //Updating User Info
    include '../connect.php';
    date_default_timezone_set('Asia/Manila');
    $action_date = date("y-m-d h:i:sa");
    $user_id = "U002121";
    if(isset($_REQUEST["userid"])){
        $userid = $_REQUEST["userid"];
        $fname = $_REQUEST["fname"];
        $lname = $_REQUEST["lname"];
        $address = $_REQUEST["address"];
        $email = $_REQUEST["email"];
        $contact = $_REQUEST["contact"];
        $date_inserted = $_REQUEST["date_inserted"];
        try{
            $conn->beginTransaction();
            $Get_query = "Update user_information Set fname='$fname',lname='$lname' ,address='$address',email='$email',contact='$contact',date_inserted='$date_inserted' where customer_id=".$userid;
            $conn->query($Get_query);   

            $insert_logs = "insert INTO `actionlogs`(`table_name`, `table_id`, `table_action`, `action_dt`, `act_by`) VALUES ('user_information','$userid','UPDATE','$action_date','$user_id')";
            $conn->query($insert_logs); 
            $conn->commit();
            echo "Updated";

        }catch(PDOException  $ex){
            $conn->rollBack(); 
            echo "Not-Updated";  
        }
    }
?>