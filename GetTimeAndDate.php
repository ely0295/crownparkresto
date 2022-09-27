<?php
if(isset($_REQUEST['date'])){
	
	$Cdate =  $_REQUEST['date'];
	
	$hrs =  $_REQUEST['hrs'];
	$tableID =  $_REQUEST['id'];
	$splitcolumns = explode("/",$Cdate);
	$listdate = date_create_from_format("m-d-Y", $splitcolumns[1]."-".$splitcolumns[2]."-".$splitcolumns[0])->format("Y-m-d");
	
	include("connect.php");
	$tablerow = array ();
	$sql = "SELECT R.*,S.* FROM reservation as R JOIN tbltable as S on R.tableID = S.tableID where R.res_date like '%$listdate%' and R.tableID = '$tableID' ORDER BY R.res_date ASC";
					
	
	$result = $conn->query($sql);
	$count = 0;
	if($result->rowCount() > 0){
		while($row = $result->fetch(PDO::FETCH_ASSOC)){

			$tablerow[$count][0] =  $row["reservation_code"];
							$tablerow[$count][1] =  $row["tableID"];
							$tablerow[$count][2] =  $row["res_date"];
							$tablerow[$count][3] =  $row["starttime"];
							$tablerow[$count][4] =  $row["endtime"];
			$count++;
		}
	}
	
	?>
	<div class="container" style = "width:100%;">				 
	<table style = "text-align:center;" id = "timeTBL" class="table table-condensed">
	<thead >
		<tr>
			<th  style = "text-align:center;"></th>
			<th  style = "text-align:center;">Start Time</th>
			<th  style = "text-align:center;" >End Time</th>
			<th  style = "text-align:center;">Status</th>
		</tr>
	</thead>
	<tbody>
	<?php
	
	for($i=7;$i<24;){
		$hasevent = "";
		
		for($ct=0;$ct<count($tablerow);$ct++){
			
		  $split = explode("-",$tablerow[$ct][3]);
			if(date('H:i:a', strtotime($i.":00")) == date('H:i:a', strtotime($split[0]))){
				
				$Starttime = $tablerow[$ct][3];
				$Endtime = $tablerow[$ct][4];
				$Etime = explode(":",$Endtime);
				//echo $Etime[0];
				$i = $Etime[0];
				//12 and so on					
						?>
						
						<tr style = "background:black;color:white;">
						<td>
							
						</td>
						<td><?php echo date('h:i:a', strtotime($Starttime)); ?></td>
						<td><?php echo date('h:i:a', strtotime($Endtime));  ?></td>
						<td>Unavailable</td>
						</tr>
						
						<?php
						
						
			}			
			
		}
		// 7-12
		?>
		<tr >
			<td>
				<span class="custom-checkbox">
					<input type="checkbox" id="mycheckbox" name="mycheckbox[]" value="<?php echo  date('h:i:a', strtotime($i.":00")); ?>/<?php echo  date('h:i:a', strtotime($i+$hrs.":00"));  ?>">
					<label for="checkbox1"></label>
				</span>
			</td>
			<td><?php echo  date('h:i:a', strtotime($i.":00")); ?></td>
			<td><?php echo  date('h:i:a', strtotime($i+$hrs.":00"));  ?></td>
			<td>Available</td>
		</tr>
		<?php
		$i++;
		
	}
	?>
	
		</tbody>
	</table>
	<button type="button" class="btn btn-danger btn-default pull-right"id="prevBtn" style = "border:1px solid black;margin-bottom:10px;"onclick = "setdateandtime('<?php echo $listdate ?>')">Select Time</button>
				
	</div>
	<?php

}


?>
