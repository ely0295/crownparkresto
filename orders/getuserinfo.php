<?php 
session_start();

//Getting User Info
	include '../connect.php';
	$Get_query = "select * FROM user_information";
	$result = $conn->query($Get_query);
	if($result->rowCount() > 0){
		?>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Address</th>
						<th>Email</th>
						<th>Contact #</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($row1 = $result->fetch(PDO::FETCH_ASSOC)){
							?>
							<tr>
								<td>
									<span class="custom-checkbox">
										<input type="checkbox" id="checkbox1" name="options[]" value="1">
										<label for="checkbox1"></label>
									</span>
								</td>
								<td><?php echo $row1["fname"]; ?></td>
								<td><?php echo $row1["lname"]; ?></td>
								<td><?php echo $row1["address"]; ?></td>
								<td><?php echo $row1["email"]; ?></td>
								<td><?php echo $row1["contact"]; ?></td>
								<td>
									<a href="Javascript:getupdatemodal('<?php echo $row1["customer_id"]; ?>','<?php echo $row1["fname"]; ?>','<?php echo $row1["lname"]; ?>','<?php echo $row1["address"]; ?>','<?php echo $row1["email"]; ?>','<?php echo $row1["contact"]; ?>','<?php echo $row1["date_inserted"]; ?>')" class="edit" ><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
									<a href="Javascript:Deletemodal('<?php echo $row1["customer_id"]; ?>')" class="delete"  ><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
								</td>
							</tr>
							<?php
						}
					
					?>
					
					 
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
					<ul class="pagination">
						<li class="page-item disabled"><a href="#">Previous</a></li>
						<li class="page-item"><a href="#" class="page-link">1</a></li>
						<li class="page-item"><a href="#" class="page-link">2</a></li>
						<li class="page-item active"><a href="#" class="page-link">3</a></li>
						<li class="page-item"><a href="#" class="page-link">4</a></li>
						<li class="page-item"><a href="#" class="page-link">5</a></li>
						<li class="page-item"><a href="#" class="page-link">Next</a></li>
					</ul>
				</div>
        	</div>   
		<?php	
	}
		




?>