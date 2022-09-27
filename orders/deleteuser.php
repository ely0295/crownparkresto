<?php 
    session_start();
    //Getting User Info
    date_default_timezone_set('Asia/Manila');
    $action_date = date("y-m-d h:i:sa");
    $user_id = "U002121";

    include '../connect.php';
    if(isset($_REQUEST["userid"])){
        $id = $_REQUEST["userid"];
        try{
            $Get_query = "Delete FROM user_information where customer_id=".$id;
            $conn->beginTransaction();
            $conn->query($Get_query);   
            $insert_logs = "insert INTO `actionlogs`(`table_name`, `table_id`, `table_action`, `action_dt`, `act_by`) VALUES ('user_information','$id','DELETE','$action_date','$user_id')";
            $conn->query($insert_logs); 
            $conn->commit();
            echo "Deleted";

        }catch(PDOException  $ex){
            $conn->rollBack(); 
            echo "Not-Deleted";  
        }
    }
	
	

?>