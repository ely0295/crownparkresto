

<?php 
if(isset($_REQUEST['month']) && isset($_REQUEST['year'])  && isset($_REQUEST['currentdate'])){	
	function events($pday,$pmonth,$pyear){			
		// Connection
		include("connect.php");
		$tablerow = array ();
		$sql = "SELECT * FROM reservation  ORDER BY res_date DESC";
		$result = $conn->query($sql);
		$count = 0;
		if($result->rowCount()> 0){
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				$tablerow[$count][0] =  $row["reservation_code"];
				$tablerow[$count][1] =  "";
				$tablerow[$count][2] =  $row["res_date"];
				$count++;
			}
		}
		for($i = 0;$i< count($tablerow);$i++){
			$datetb = explode("-",$tablerow[$i][2]);		
			if($datetb[2] == $pday && $datetb[1] == $pmonth && $datetb[0] == $pyear){
				return true;
				 exit;
			}
		}
	}
	
	//fucntion for getting row details
	
	$month =  $_REQUEST['month'];
	$year =  $_REQUEST['year'];
	$currentdate =  $_REQUEST['currentdate'];

    $first_day = mktime(0,0,0,$month, 1, $year);  // Here we generate the first day of the month 
    $day_of_week = date('D', $first_day);         // day of week for 1st day of month
	//echo $day_of_week;
   
    switch($day_of_week) {                        // blank days before months first day
        case "Sun": $blankdays = 0; break; 
        case "Mon": $blankdays = 1; break; 
        case "Tue": $blankdays = 2; break; 
        case "Wed": $blankdays = 3; break; 
        case "Thu": $blankdays = 4; break; 
        case "Fri": $blankdays = 5; break; 
        case "Sat": $blankdays = 6; break; 
    }
   
    $days_in_month = cal_days_in_month(0, $month, $year); // days in the month
	echo '<div class="days">';

		$day_count = 1;
		$blank_cnt =  $blankdays;  
		while ( $blank_cnt > 0 )                     // blank day table cells
		{ 
			echo "<div class = 'list'></div>"; 
			$blank_cnt--; 
			$day_count++;
		}
	   
		$day_num = 1;                                // day number
		$cnt = $blankdays;                           // skip blank days in first week
		while ( $day_num <= $days_in_month ) {       // count days until done
		  if ($cnt==7) {$cnt = 0;};
		  while ($cnt < 7) {
				
			  //if($date[0] == $day_num && $date[1] == $month && $date[2] == $year){
				if(events($day_num,$month,$year)){
						
					 
					$listdate = date_create_from_format("m-d-Y", $month."-".$day_num."-".$year)->format("Y-m-d");
					// Connection
					include("connect.php");
					$tablerow = array ();
					$sql = "SELECT * FROM reservation where res_date like '%$listdate%' ORDER BY res_date DESC";
					
					$result = $conn->query($sql);
					$count = 0;
					if($result->rowCount() > 0){
						while($row = $result->fetch(PDO::FETCH_ASSOC)){
							$tablerow[$count][0] =  $row["reservation_code"];
							$tablerow[$count][1] =  "";
							$tablerow[$count][2] =  $row["res_date"];
							$tablerow[$count][3] =  $row["starttime"];
							$tablerow[$count][4] =  $row["endtime"];
							$count++;
						}
					}
					?>
				   <div class = 'list' <?php if($result->rowCount() != "no" ){ echo "onclick ='showSched($day_num,$month,$year);' ";} ?> >
				   <?php echo $day_num; ?>
				  
				   <ul style="text-align:left;margin-left:-35px;margin-top:-2px;">
						
				   
					  <li class="btn btn-primary"  style= "border-radius:10px;background:#1a8cff;margin-top:-5px;padding:0;width:100%;"  >
							No. of Reservations	<?php echo count($tablerow); ?>
						     </li>
				   </ul>
				   </div>
					<?php
					
					
					
				
					
			  }else{
				  if ($day_num > $days_in_month) {
					 echo "<div class = 'list'>";				  
				   echo '</div>';
				  }else{
					echo "<div class = 'list' onclick ='showSched($day_num,$month,$year);'>$day_num";				  
				   echo '</div>';   
				  }
				   
			  }
		   
			$day_num++; 
			$day_count++;
			$cnt++;
			
		  }
		}

		while ( $cnt > 1 && $cnt <=6 ) {            // continue with $cnt for end of month blank days
			echo "<div class = 'list'></div>";
			$cnt++;
		}
	   
	echo '</div>';


}

?>
