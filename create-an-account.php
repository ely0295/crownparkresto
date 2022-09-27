<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Crown Park Restaurant | Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Core Stylesheet -->
    <link href="mycss.css" rel="stylesheet">
    <!-- Responsive CSS -->

    <link href="css/responsive/responsive.css" rel="stylesheet">

 
<style>
h1 {
  text-align: center;  
}


/* Mark input boxes that gets an error on validation: */
.invalid {
  background-color: #ffdddd;
  border:1px solid  #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
.center {
    display:inline-block;
    margin: 0 auto;
}
</style>
<script>
function senddata(){
    // ... the form gets submitted:
	if(document.getElementById("vr_Code").value == document.getElementById("inputCode").value){
		  document.getElementById("regForm").submit();
	}else{
		alert("Verification code is invalid");
	}
}
function verifyemail(email){

	var fname = document.getElementById("inputFname").value;
	var lname = document.getElementById("inputlname").value;
	var fullname = fname+" "+ lname;
	var vr_code = document.getElementById("vr_Code").value;
	alert("Temporary Code: "+vr_code + " email Under Maintenace");
	var xhttp;
	  xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var response = JSON.stringify(this.responseText);
			var newreponse = (response).slice(6,17)
			if(newreponse != 'emanotsent'){
				document.getElementById("entercode").style.display = "block";
				document.getElementById("sendercode").style.display = "none";		
			}						
		}
	  };
	  xhttp.open("GET", "emailfunction.php?verifyemail="+email+"&name="+fullname+"&vr_code="+vr_code, true);
	  xhttp.send(); 
}
function checkemail(email){	
	 var xhttp;
	  xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var response = JSON.stringify(this.responseText);
			var newreponse = (response).slice(6,17)
			alert(newreponse);
			if(newreponse == 'availabless'){
				document.getElementById("nextBtn").disabled = false; 
				document.getElementById("eresult").innerHTML = "Success! Email is Available";	
					document.getElementById("eresult").classList.remove("alert-danger");				
				 document.getElementById("eresult").classList.add("alert-success");
				 document.getElementById("eresult").style.display = "block";
			}else{
				document.getElementById("nextBtn").disabled = true;
				document.getElementById("eresult").innerHTML = "Sorry Not Available";
				document.getElementById("eresult").classList.remove("alert-success");
				document.getElementById("eresult").classList.add("alert-danger");
				 document.getElementById("eresult").style.display = "block";				
			}						
		}
	  };
	  xhttp.open("GET", "emailfunction.php?checkemail="+email, true);
	  xhttp.send(); 
}
function checkpass(){	
    if(document.getElementById("inputpass1").value == document.getElementById("inputpass2").value){
		document.getElementById("passresult").innerHTML = "Passwords Matched!";
	}else{
		document.getElementById("passresult").innerHTML = "Passwords do not Matched!";
	}
	
}
</script>
</head> 

<body>
    <div id="preloader">
        <div class="caviar-load"></div>
    </div>
    <!-- ***** Header Area Start ***** -->
    <?php
	include("nav_panel.php");
	?>
    <!-- ***** Header Area End ***** -->
    
    <!-- ***** Login Area Start ***** -->  
	<div class = "container" >
   <div class="jumbotron"  style ="color:black; ">
		<div id="members" class="container text-center" style = "padding-top:80px;width:100%;margin-bottom:30px;">
		<form id="regForm" action="addclient.php" method = "post">
		<h2 class="text-center">Account Registration</h2> 
		<div class="row" style = "padding:10px;">
			<div class = "tab">
				<fieldset style = "box-shadow: 0 2px 3px -1px black;margin-bottom:10px;">
			   <div class="card text-white bg-info mb-3" style="width:100%;">
				<div class="card-header" style="color:white;padding:10px;"><b> Step 1( Basic Information )</b></div>			
				</div>		
				<div class="row" style = "padding:20px;text-align:left;">
						<!-- First Name -->
					  <div class="col-sm-3 "  >
					   <div class="form-group">
						  <label for="exampleFname">First Name</label>
						  <input style = "font-size:11pt;" type="text"  autocomplete="off" class="form-control"onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32"    placeholder="Enter Your First Name" id="inputFname" name="inputFname"  required>
						</div>
					  </div>
					  <!-- Middle Name -->
					  <div class="col-sm-4 "  >
					   <div class="form-group">
						  <label for="exampleMname">Middle Name</label>
						  <input type="text"style = "font-size:11pt;" autocomplete="off" class="form-control"onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32"  id="inputmname" name="inputmname" placeholder="Enter Your Middle Name" required >
						</div>
					  </div>
					  <!-- Last Name -->
					  <div class="col-sm-5 " style = "text-align:left;"  >
					   <div class="form-group">
						  <label for="exampleLname"> Last Name</label>
						  <input type="text"style = "font-size:11pt;" autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32"  class="form-control" id="inputlname" name="inputlname" placeholder="Enter Your Last Name" required >
						</div>
					  </div>
					  
					  <!-- Date of Birth -->
					  <div class="col-sm-6 "  >
					   <div class="form-group">
						  <label for="exampleLname">Date of Birth</label>
						  <div class="form-group" style = "background:red;">
							<div class="container" style = "padding:1px;float:left;width:20%;" >
								<select style = "font-size:11pt;" class="form-control" id="inputday" name="inputday"required>
								<option value="Day" selected disabled>Day</option>
								<?php
								for ($x = 1; $x <= 31; $x++) {
									?><option value = "<?php echo $x;  ?>" ><?php echo $x;  ?></option> <?php
								}
								?>		
								
							  </select>
							</div>
							<div class="container" style = "padding:1px;float:left;width:40%;" >
							  <select style = "font-size:11pt;" class="form-control" id="inputmonth" name="inputmonth" required>
								<option value="Month" selected disabled>Month</option>
								<option value = "1">January</option>
								<option value = "2">Febuary</option>
								<option value = "3">March</option>
								<option value = "1" >January</option>
								<option value = "2" >Febuary</option>
								<option value = "3" >March</option>
								<option value = "4">April</option>
								<option value = "5" >May</option>
								<option value = "6" >June</option>		
								<option value = "7" >July</option>
								<option value = "8" >August</option>
								<option value = "9"  >September</option>
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
						</div>
					  </div>
						  <!-- Gender  -->
					   <div class="col-sm-3 "  >
					   <div class="form-group">
						  <label for="exampleSelect1">Gender</label>
						  <select style = "font-size:11pt;" class="form-control" id="inputgender" name="inputgender" required >
							<option value="select" selected disabled>Please select Gender</option>
							<option>Male</option>
							<option>Female</option>
							
						  </select>
						</div>
					  </div>
					<!-- Contact Number   -->
					  <div class="col-sm-4 "  >
					   <div class="form-group">
						  <label for="exampleInputEmail1">Contact Number</label>
						  <input style = "font-size:11pt;" type="text" class="form-control" id="inputcontact" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" name="inputcontact"  maxlength="11" size="11" aria-describedby="emailHelp" placeholder="Enter Number" required >
						 <small id="emailHelp" class="form-text text-muted">Please Provide a valid Phone Number (+63)</small>
						</div>
					  </div>				  
					  <!-- Address  -->
					  <div class="col-sm-12 "  >
					  <div class="row" style = "padding:10px;">
						<div class="col-sm-1 " style = "padding:5px;" >
								<label for="exampleLname">House #</label>
								<input style = "font-size:11pt;" class="form-control force-upcase" autocomplete="off" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"  placeholder="e.g 39" maxlength="50" size="50" type="text"  id="inputhouse" name="inputhouse">
						</div>
						<div class="col-sm-2 "style = "padding:5px;"  >
								 <label for="exampleLname">Zone Number:</label>
								<input  style = "font-size:11pt;"class="form-control force-upcase"  onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"  autocomplete="off" placeholder="e.g. 1" maxlength="50" size="50" type="text" id="inputzone" name="inputzone">
						</div>
						<div class="col-sm-2 "style = "padding:5px;"  >
								 <label for="exampleLname">Subdivision:</label>
									<input style = "font-size:11pt;" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32"  class="form-control" autocomplete="off" id="inputsub" name="inputsub" aria-describedby="emailHelp" placeholder="Subdivision Name" required >
						</div>
						<div class="col-sm-2 "style = "padding:5px;"  >
								 <label for="exampleLname">Barangay:</label>
								<input style = "font-size:11pt;" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32"  class="form-control" autocomplete="off" id="inputbrgy" name="inputbrgy" aria-describedby="emailHelp" placeholder="Barangay Name" required >
						</div>
						<div class="col-sm-3 "style = "padding:5px;"  >
								<label for="exampleLname">City, Town, or Municipality:</label>
								<input style = "font-size:11pt;" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32"  class="form-control" id="inputcity" autocomplete="off" name="inputcity" aria-describedby="emailHelp" placeholder="City, Town, or Municipality" required >
						</div>
						
						<div class="col-sm-2 " style = "padding:5px;" >
								<label for="exampleLname">Province:</label>
								<input style = "font-size:11pt;" type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32"  class="form-control"autocomplete="off" id="inputprov" name="inputprov" aria-describedby="emailHelp" placeholder="Province Name" required >
						</div>
						
						
					  
					  </div>
						
					  </div>
					
					 
					  
					  
				</div>
				</fieldset>
			</div>
			
			<div class = "tab" style= "text-align:center;padding-bottom:10px;">
				<div class = "center" style = "box-shadow: 0 2px 3px -1px black;max-width:500px;">
			   <div class="card text-white bg-info mb-3" style="width:100%;">
				<div class="card-header" style="color:white;padding:10px;"><b> Step 2(Acount Details)</b></div>			
				</div>		
				<div class="row" style = "padding:20px;text-align:left;">
						 <div class="col-sm-12 "  >
					   <div class="form-group">
					       <small style = "float:left;"  id="emailHelp" class="form-text text-muted">Please Provide Valid email address, We'll never share your email with anyone else.</small>
							<small style = "float:left;color:red;width:100%;"  id="emailHelp" class="form-text text-muted">This act as your Username</small>						
						  <label for="exampleInputEmail1">Email address</label>
						  <div style = "overflow:auto;margin-bottom:10px;">
							 <input style = "width:100%;float:left;" autocomplete="off" type="text"   class="form-control" name="inputemail" id="inputemail" aria-describedby="emailHelp" placeholder="Enter email" required>  
							<div style = "display:none;width:100%;float:left;margin-top:10px;"  id = "eresult" class="alert">
							  <strong>Success!</strong> Email available
							</div>
						  </div>
						  <button  class="btn btn-primary" type="button" onclick = "checkemail(document.getElementById('inputemail').value)" >Check email Availabiliy</button>
						 
							  
						</div>
						 
					  </div>
					    <!-- Password -->
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
			</div>

			<div class = "tab" style= "text-align:center;padding-bottom:10px;">
				<div class = "center" style = "box-shadow: 0 2px 3px -1px black;max-width:500px;">
			   <div class="card text-white bg-info mb-3" style="width:100%;">
				<div class="card-header" style="background: #435d7d;color:white;padding:10px;"><b> Your Almost Done! (Verify Your account)</b></div>			
				</div>		
				<div class="row" style = "padding:20px;text-align:left;">
						<?php
						
							function secure_random_string($length) {
							$random_string = '';
							for($i = 0; $i < $length; $i++) {
								$number = random_int(0, 36);
								$character = base_convert($number, 10, 36);
								$random_string .= $character;
							}
						 
							return $random_string;
							}
							
						   ?><input type="hidden" id="vr_Code" name="vr_Code" value= "<?php echo secure_random_string(5);?>">
						<?php
						?>
						<div class="col-sm-12 " style = "padding:20px;text-align:center;"  >
					   <div  id = "sendercode" class="form-group">
						  <label for="exampleMname" style = "width:100%;">Send Verification Code to your Email:</label>
						 <button  class="btn btn-primary" type="button" onclick = "verifyemail(document.getElementById('inputemail').value)" >Yes! Send me a Code</button>
						 
						 </div>
					  </div>
					  <div id = "entercode" style = "display:none;"class="col-sm-12 "  >
					   <div class="form-group">
						<small class="form-text text-muted">Success! We have sent a verification code to your email </small>						
						  
						  <label for="exampleFname">Enter Verification Code</label>
						  <input style = "font-size:11pt;margin-bottom:20px;" type="text"  autocomplete="off" class="form-control"   placeholder="Enter Code" id="inputCode" name="inputCode"  required>
						  <button  name = "btn-post" class="btn btn-primary" type="button" onclick = "senddata()" >Verify and Submit</button>
						 
						</div>
					  </div>
					  
					  
					  
				</div>
				</div>
			</div>
			<hr>
			<div style="overflow:auto;text-align:center;">
				<div>
				  <button  class="btn btn-primary btn-lg" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
				  <button  class="btn btn-primary btn-lg" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
				</div>
			  </div>
			  <!-- Circles which indicates the steps of the form: -->
			  <div style="text-align:center;margin-top:40px;">
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
			  </div>
		  </div>
		  </form>
	   </div>
	   
</div>
</div>

    <!-- ***** Login Area End ***** -->
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
    <!-- Jquery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap-4 js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/others/plugins.js"></script>
    <!-- Active JS -->
    <script src="js/active.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if(n == 1){
	  document.getElementById("nextBtn").disabled = true;
  }else{
	   document.getElementById("nextBtn").disabled = false; 
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").style.display = "none";
	document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }else{
		 y[i].classList.remove("invalid");
	}
  }
   if (document.getElementById("inputday").value == "Day" ) {
      // add an "invalid" class to the field:
	  document.getElementById("inputday").classList.add("invalid");
      // and set the current valid status to false:
      valid = false;
    }else{
		  document.getElementById("inputday").classList.remove("invalid");
	}
	if (document.getElementById("inputmonth").value == "Month" ) {
      // add an "invalid" class to the field:
	  document.getElementById("inputmonth").classList.add("invalid");
      // and set the current valid status to false:
      valid = false;
    }else{
		  document.getElementById("inputmonth").classList.remove("invalid");
	}
	if (document.getElementById("inputyear").value == "Year" ) {
      // add an "invalid" class to the field:
	  document.getElementById("inputyear").classList.add("invalid");
      // and set the current valid status to false:
      valid = false;
    }else{
		  document.getElementById("inputyear").classList.remove("invalid");
	}
	if (document.getElementById("inputgender").value == "select" ) {
      // add an "invalid" class to the field:
	  document.getElementById("inputgender").classList.add("invalid");
      // and set the current valid status to false:
      valid = false;
    }else{
		  document.getElementById("inputgender").classList.remove("invalid");
	}
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>
</html>