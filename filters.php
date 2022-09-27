<?php session_start();
//for filter function
if(isset($_REQUEST['status']) or isset($_REQUEST['date'])){
	include 'connect.php';
	$res_status = $_REQUEST['status'];
	$res_date = $_REQUEST['date'];
	if($res_status == "All"){
		$Get_query = "select R.*,C.* from reservation as R join client as C on R.fkclient_id= C.client_id where R.dateissued like '%$res_date%' ORDER BY starttime ASC ";						
	
	}else{
		$Get_query = "select R.*,C.* from reservation as R join client as C on R.fkclient_id= C.client_id where R.dateissued like '%$res_date%' and R.res_status = '$res_status' ORDER BY starttime ASC";						
	
	}
							
		$result = $conn->query($Get_query);
		if($result->rowCount() > 0){
			$counter = 1;
			while($row1 = $result->fetch(PDO::FETCH_ASSOC)){
			?>
							<tr>
								<td>
									<span class="custom-checkbox">
										<input type="checkbox" disabled id="checkbox1" name="mycheckbox[]"  value="<?php echo $row1["reservation_code"]; ?>">
											<label for="checkbox1"></label>
									</span>
								</td>
								<td><?php echo $row1["reservation_code"]?></td>
								<td><?php echo $row1["dateissued"]?></td>
								<td><?php echo $row1["res_date"]?> From <?php echo date('h:i:a', strtotime($row1["starttime"]));?> to <?php echo date('h:i:a', strtotime($row1["endtime"])) ?></td>
								<td class="text-right"><?php echo $row1["res_status"]?> </td>
								<td class="td-actions text-right">
									<a href="javascript:updatereservation('<?php echo $row1["reservation_code"]?>')" rel="tooltip" class="btn btn-info btn-just-icon btn-sm" data-original-title="" title="Update Status">
										<i class="material-icons">Update Status</i>
									</a>
									<a href="javascript:updateresdata('<?php echo $row1["reservation_code"]?>','<?php echo $row1["dateissued"]?>','<?php echo $row1["res_date"]?>',
									'<?php echo date('h:i:a', strtotime($row1["starttime"]))?>','<?php echo date('h:i:a', strtotime($row1["endtime"]))?>',
									'<?php echo $row1["res_status"]?>','<?php echo $row1["location"]?>',
									'<?php echo $row1["venue_name"]?>','<?php echo $row1["fkclient_id"]?>','<?php echo $row1["firstname"]." ".$row1["middlename"]." ".$row1["lastname"]?>',
									'<?php echo $row1["contact_no"]?>','<?php echo $row1["fkservice_id"]?>')" rel="tooltip" class="btn btn-success btn-just-icon btn-sm" data-original-title="" title="View/Edit">
										<i class="material-icons">View/Edit</i>
									</a>
									<a href="javascript:deletereservation('<?php echo $row1["reservation_code"]?>')" rel="tooltip" class="btn btn-danger btn-just-icon btn-sm" data-original-title="" title="Delete Item">
										<i class="material-icons">Delete</i>
									</a>
								</td>
							</tr>
							<?php	
							$counter++;
			}													
		}
		else{
			?><tr>
			<center>
			<td colspan = "6">
			<center><img src="images/no_data_found.png"  width="150" height="150">
			<i class="material-icons">No Data Found!. Please try Again</i>
			</center>
			</td>
			
			
			</tr>
			<?php
		}
}
if(isset($_REQUEST['searchCode'])){
	include 'connect.php';
	$search_Code = $_REQUEST['searchCode'];
	
	
		$Get_query = "select R.*,C.* from reservation as R join client as C on R.fkclient_id= C.client_id where R.reservation_code like '%$search_Code%' or C.firstname like '%$search_Code%' or C.middlename like '%$search_Code%' or C.lastname like '%$search_Code%' ORDER BY starttime ASC";						

							
		$result = $conn->query($Get_query);
		if($result->rowCount() > 0){
			$counter = 1;
			while($row1 = $result->fetch(PDO::FETCH_ASSOC)){
			?>
							<tr>
								<td class="text-center"><span class="custom-checkbox">
										<input type="checkbox" disabled id="checkbox1" name="mycheckbox[]"  value="<?php echo $row1["reservation_code"]; ?>">
											<label for="checkbox1"></label>
									</span></td>
								<td><?php echo $row1["reservation_code"]?></td>
								<td><?php echo $row1["dateissued"]?></td>
								<td><?php echo $row1["res_date"]?> From <?php echo date('h:i:a', strtotime($row1["starttime"]));?> to <?php echo date('h:i:a', strtotime($row1["endtime"])) ?></td>
								<td class="text-right"><?php echo $row1["res_status"]?> </td>
								<td class="td-actions text-right">
									<a href="javascript:updatereservation('<?php echo $row1["reservation_code"]?>')" rel="tooltip" class="btn btn-info btn-just-icon btn-sm" data-original-title="" title="Update Status">
										<i class="material-icons">Update Status</i>
									</a>
									<a href="javascript:updateresdata('<?php echo $row1["reservation_code"]?>','<?php echo $row1["dateissued"]?>','<?php echo $row1["res_date"]?>',
									'<?php echo date('h:i:a', strtotime($row1["starttime"]))?>','<?php echo date('h:i:a', strtotime($row1["endtime"]))?>',
									'<?php echo $row1["res_status"]?>','<?php echo $row1["location"]?>',
									'<?php echo $row1["venue_name"]?>','<?php echo $row1["fkclient_id"]?>','<?php echo $row1["firstname"]." ".$row1["middlename"]." ".$row1["lastname"]?>',
									'<?php echo $row1["contact_no"]?>','<?php echo $row1["fkservice_id"]?>')" rel="tooltip" class="btn btn-success btn-just-icon btn-sm" data-original-title="" title="View/Edit">
										<i class="material-icons">View/Edit</i>
									</a>
									<a href="javascript:deletereservation('<?php echo $row1["reservation_code"]?>')" rel="tooltip" class="btn btn-danger btn-just-icon btn-sm" data-original-title="" title="Delete Item">
										<i class="material-icons">Delete</i>
									</a>
								</td>
							</tr>
							<?php	
							$counter++;
			}													
		}
		else{
			?><tr>
			<center>
			<td colspan = "6">
			<center><img src="images/no_data_found.png"  width="150" height="150">
			<i class="material-icons">No Data Found!. Please try Again</i>
			</center>
			</td>
			
			
			</tr>
			<?php
		}
}		
?>