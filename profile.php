
<!DOCTYPE html>
<?php
	include("accessright.php");
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Crown Park Restaurant | Profile Page</title>

    <!-- Core Stylesheet -->
    <link href="mycss.css" rel="stylesheet">
 
    <!-- Responsive CSS -->
    <link href="css/responsive/responsive.css" rel="stylesheet"> 
</head>
<body>
    
  <!-- ***** Header Area Start ***** -->
    <?php
	include("nav_panel.php");
	?>
    <!-- ***** Header Area End ***** -->
  <?php
	//get user info
	include 'connect.php';
	$client_id = $_SESSION['client_id'];
	
	$Get_userinfo = "select U.*,C.*  from user_account as U JOIN client as C on U.client_id = C.client_id where C.client_id = '$client_id '";
	$result = $conn->query($Get_userinfo);
	if($result->rowCount() > 0){
		$inforow = $result->fetch(PDO::FETCH_ASSOC);		
	}
	
  ?>
   <!--  Profile Area Start -->
        <div class="container profile-container">
            <div class="row">
                <div class="col-md-4 bg-dark profile-card1">
                    <div class="profile-image text-center">
                        <img src="img/bg-img/avatar.png" width="200" height="200">
                    </div>
                    <div class="profile-description1 text-center py-3">
                        <h3><?php echo $inforow["firstname"]?> <?php echo $inforow["lastname"]?></h3>
                        <small class="text-muted">Registered on 5/1/2022</small>

                    </div>
                   <div class="d-grid gap-2">
                      <button class="btn btn-outline-danger btn-block bg-light" type="button" id="update-profile" onclick="update()">Update Profile</button>
                      <button class="btn btn-outline-danger btn-block bg-light" type="button" id="change-password" onclick="updatepass()">Change Password</button>
                   </div>
                </div>
                 <div class="col-md-8 profile-card2">
                    <div class="profile-description py-3">
                        <h3 class="text-center"><span class="fa fa-user heading-icon" ></span> Personal Information</h3>
                        <table class="table table-hover">
                            <tr>
                                <th>First Name:</th>
                                <td><?php echo $inforow["firstname"]?> </td>
                            </tr>
                            <tr>
                                <th>Middle Name:</th>
                                <td><?php echo $inforow["middlename"]?></td>
                            </tr>
                            <tr>
                                <th>Last Name:</th>
                                <td><?php echo $inforow["lastname"]?></td>
                            </tr>
                            <tr>
                                <th>Birthdate: </th>
                                <td><?php echo $inforow["DOB"]?></td>
                            </tr>
                            <tr>
                                <th>Gender:</th>
                                <td><?php echo $inforow["gender"]?></td>
                            </tr>
                            <tr>
                                <th>Email Address:</th>
                                <td><?php echo $inforow["email"]?></td>
                            </tr>
                            <tr>
                                <th>Contact Number:</th>
                                <td><?php echo $inforow["contact_no"]?></td>
                            </tr>
                            <tr>
                                <th>Client ID#:</th>
                                <td><?php echo $inforow["client_id"]?></td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td><?php echo $inforow["house_num"]?>/<?php echo $inforow["zone"]?>/<?php echo $inforow["subdivision"]?>/<?php echo $inforow["barangay"]?>/<?php echo $inforow["city"]?>/<?php echo $inforow["province"]?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="modal section-padding-100" id="updateinfomodal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"> <span class="fa fa-user heading-icon" ></span>Updating User Information</h5>
                  </div>
                  <div class="modal-body">
				    
                     <div class="profile-description py-3">
                          
                        <table class="table table-hover">
							<form id="regForm" action="updateclient.php" method = "post">
                            <tr>
                                <th>First Name:</th>
                                <td><input style = "font-size:11pt;" type="text"  autocomplete="off" class="form-control"onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32"   value = "<?php echo $inforow["firstname"]?>" placeholder="Enter Your First Name" id="inputFname" name="inputFname"  required></td>
                            </tr>
                            <tr>
                                <th>Middle Name:</th>
                                 <td><input style = "font-size:11pt;" type="text"  autocomplete="off" class="form-control"onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32"   value = "<?php echo $inforow["middlename"]?>" placeholder="Enter Your First Name" id="inputmname" name="inputmname"  required></td>
                            </tr>
                            <tr>
                                <th>Last Name:</th>
                                 <td><input style = "font-size:11pt;" type="text"  autocomplete="off" class="form-control"onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32"   value = "<?php echo $inforow["lastname"]?>" placeholder="Enter Your First Name" id="inputlname" name="inputlname"  required></td>
                            </tr>
                            <tr>
                                <th>Birthdate: </th>
                                <td>
								<div class="form-group" style = "background:red;">
							<div class="container" style = "padding:1px;float:left;width:20%;" >
								<select style = "font-size:11pt;" class="form-control" id="inputday" name="inputday"required>
								<option value="Day" selected disabled>Day</option>
								<?php
								for ($x = 1; $x <= 31; $x++) {
									if ($x >= 1 && $x <=9){
										?><option value = "0<?php echo $x;  ?>" >0<?php echo $x;  ?></option> <?php
									}
									else{
										?><option value = "<?php echo $x;  ?>" ><?php echo $x;  ?></option> <?php
									}
									
								}
								?>		
								
							  </select>
							</div>
							<div class="container" style = "padding:1px;float:left;width:40%;" >
							  <select style = "font-size:11pt;" class="form-control" id="inputmonth" name="inputmonth" required>
								<option value="Month" selected disabled>Month</option>
								<option value = "01">January</option>
								<option value = "02">Febuary</option>
								<option value = "03">March</option>
								<option value = "01" >January</option>
								<option value = "02" >Febuary</option>
								<option value = "03" >March</option>
								<option value = "04">April</option>
								<option value = "05" >May</option>
								<option value = "06" >June</option>		
								<option value = "07" >July</option>
								<option value = "08" >August</option>
								<option value = "09"  >September</option>
								<option value = "10" >October</option>
								<option value = "11" >November</option>
								<option value = "12" >December</option>							
							  </select>
							</div>
							<div class="container" style = "padding:1px;float:left;width:40%;" >
							  <select style = "font-size:11pt;" class="form-control" id="inputyear" name="inputyear" required>
								<option value="Year" selected disabled>Year</option>
									<?php
									$yearnow = date('Y');
									for ($x = $yearnow; $x >= 1700; $x--) {
										 ?><option value = "<?php echo $x;  ?>" ><?php echo $x;  ?></option> <?php
									}
								?>
							  </select>
							</div>		
						</div>
								</td>
                            </tr>
                            <tr>
                                <th>Gender:</th>
                                <td> <select style = "font-size:11pt;" class="form-control" id="inputgender" name="inputgender" required >
							<option value="select" selected disabled>Please select Gender</option>
							<option value = "MALE">MALE</option>
							<option value = "FEMALE">FEMALE</option>
							
						  </select></td>
                            </tr>
                            <tr>
                                <th>Contact Number:</th>
                                <td>
								<input style = "font-size:11pt;" type="text" class="form-control" id="inputcontact" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" name="inputcontact"  maxlength="11" size="11" aria-describedby="emailHelp" placeholder="Enter Number" value = "<?php echo $inforow["contact_no"]?>" required >
						 <small id="emailHelp" class="form-text text-muted">Please Provide a valid Phone Number (+63)</small>
								</td>
                            </tr>
                            <tr>
                                <th>Address:</th>
								
                                <td><div class="row" style = "padding:10px;">
						<div class="col-sm-4 " style = "padding:5px;" >
								<label for="exampleLname">House #</label>
								<input style = "font-size:11pt;" class="form-control force-upcase" autocomplete="off" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"  placeholder="e.g 39" maxlength="50" size="50" type="text" value = "<?php echo $inforow["house_num"]?>" id="inputhouse" name="inputhouse">
						</div>
						<div class="col-sm-4 "style = "padding:5px;"  >
								 <label for="exampleLname">Zone Number:</label>
								<input  style = "font-size:11pt;"class="form-control force-upcase"  onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"  autocomplete="off" placeholder="e.g. 1" maxlength="50" size="50" type="text" value = "<?php echo $inforow["zone"]?>" id="inputzone" name="inputzone">
						</div>
						<div class="col-sm-4 "style = "padding:5px;"  >
								 <label for="exampleLname">Subdivision:</label>
									<input style = "font-size:11pt;" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32"  class="form-control" autocomplete="off" id="inputsub" name="inputsub" value = "<?php echo $inforow["subdivision"]?>" aria-describedby="emailHelp" placeholder="Subdivision Name" required >
						</div>
						<div class="col-sm-4 "style = "padding:5px;"  >
								 <label for="exampleLname">Barangay:</label>
								<input style = "font-size:11pt;" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32"  class="form-control" autocomplete="off" id="inputbrgy" name="inputbrgy" value = "<?php echo $inforow["barangay"]?>" aria-describedby="emailHelp" placeholder="Barangay Name" required >
						</div>
						<div class="col-sm-4 "style = "padding:5px;"  >
								<label for="exampleLname">City, Town, or Municipality:</label>
								<input style = "font-size:11pt;" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32"  class="form-control" id="inputcity" autocomplete="off" name="inputcity" value = "<?php echo $inforow["city"]?>" aria-describedby="emailHelp" placeholder="City, Town, or Municipality" required >
						</div>
						
						<div class="col-sm-4 " style = "padding:5px;" >
								<label for="exampleLname">Province:</label>
								<input style = "font-size:11pt;" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32"  class="form-control"autocomplete="off" id="inputprov" value = "<?php echo $inforow["province"]?>" name="inputprov" aria-describedby="emailHelp" placeholder="Province Name" required >
						</div>
						
						
					  
					  </div></td>
                            </tr>
                        </table>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-sm btn-info"  >UPDATE</button>
                     <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">CLOSE</button>
                    
                  </div>
				  </form>
                </div>
              </div>
        </div>
		<div class="modal section-padding-100" id="changepassmodal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"> <span class="fa fa-key heading-icon" ></span>Updating Password</h5>
                  </div>
				  <form id="regForm" action="updatepass.php" method = "post">
                  <div class="modal-body">
				    
                     <div class="profile-description py-3">
                       <div class="col-sm-12 "  >
					   <div class="form-group">
						  <label for="exampleMname">Enter Password</label>
						  <input type="password"style = "font-size:11pt;" autocomplete="off" class="form-control" id="inputpass1" name="inputmname" placeholder="Enter Password" required >
						</div>
					  </div>
					<div class="col-sm-12 "  >
					   <div class="form-group">
						  <label for="exampleMname">re-Enter Password</label>
						  <input type="password" style = "font-size:11pt;" autocomplete="off" class="form-control" onchange="checkpass()"  id="inputpass2" name="inputpass2" placeholder="Enter Password" required >
						  <small style = "float:left;color:red;width:100%;"  id="passresult" class="form-text text-muted"></small>						
						  
						</div>
					  </div>
					  
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-sm btn-info" id = "btnsavepass" disabled  >Update Password</button>
                     <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">CLOSE</button>
                    
                  </div>
				  </form>
                </div>
              </div>
        </div>
<!-- ****** Footer Area Start ****** -->
    <footer class="caviar-footer-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-text">
                         <img src="img/logo.png" class="img-thumbnail rounded-circle" width="70" height="70">
                        <a href="#" class="navbar-brand">Crown Park Restaurant</a>
                        <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved &#8482;</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ****** Footer Area End ****** -->
	<script>
	
	 function update() {
              $("#updateinfomodal").modal();
        }
		function updatepass() {
              $("#changepassmodal").modal();
        }
		function checkpass(){	
			if(document.getElementById("inputpass1").value == document.getElementById("inputpass2").value){
				document.getElementById("passresult").style = "color:black;";
				document.getElementById("passresult").innerHTML = "Passwords Matched!";
				document.getElementById("btnsavepass").disabled = false;
			}else{
				document.getElementById("passresult").stlyle = "color:red;";
				document.getElementById("passresult").innerHTML = "Passwords do not Matched!";
				document.getElementById("btnsavepass").disabled = true;
			}
			
		}
	</script>
   <!--  Profile Area End -->

    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/others/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
	<script>
		var gender = '<?php echo $inforow["gender"]; ?>';
		var dob = '<?php echo $inforow["DOB"]; ?>';
		var mydates = dob.split("-");
		
		$("select[name='inputmonth']").find("option[value='"+mydates[1]+"']").attr("selected",true);
		$("select[name='inputday']").find("option[value='"+mydates[2]+"']").attr("selected",true);
		$("select[name='inputyear']").find("option[value='"+mydates[0]+"']").attr("selected",true);
		$("select[name='inputgender']").find("option[value='"+gender+"']").attr("selected",true);
		</script>

</body>