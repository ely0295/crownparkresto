<!DOCTYPE html>
<?php include("accessright.php");
date_default_timezone_set('Asia/Manila');
$CurrentdateNow =date("m/d/Y");
 if((isset($_SESSION['signed_in'])) ){
	$signedIn = true; 
 }else{
	$signedIn = false;
 }

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Crown Park Restaurant | Our Calendar</title>
    
    <!-- Core Stylesheet -->
    <link href="mycss.css" rel="stylesheet">
    <!-- Responsive CSS -->

    <link href="css/responsive/responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Template Stylesheet -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
<style>

.month {
  padding: 10px 25px;
  width: 100%;
  background: #333;
  text-align: center;
}

.month ul {
  margin: 0;
  padding: 0;
}

.month ul li {
  color: white;
  font-size: 20px;
  text-transform: uppercase;
  letter-spacing: 3px;
}

.month .prev {
	cursor:pointer;
  float: left;
  padding-left: 20px ;
  padding-right: 20px ;
  padding-top:5px;
   padding-bottom:5px;
   background-color: #595959;
  border-radius:50px;
  margin-top:20px;
  font-size:18pt;
   box-shadow: 2px 2px 2px -1px white;
}

.month .next {
	cursor:pointer;
  float: right;
  padding-left: 20px ;
  padding-right: 20px ;
  padding-top:5px;
   padding-bottom:5px;
   background-color: #595959;
  border-radius:50px;
  margin-top:20px;
  font-size:18pt;
   box-shadow: 2px 2px 2px -1px white;
}
.month .next:hover , .prev:hover {
	background:#80d4ff;
}

.weekdays {
  margin: 0;
  padding: 5px 0;
  background-color: #595959;
}

.weekdays li {
  display: inline-block;
  width: 13.8%;
  color: white;
  text-align: center;
  font-weight:bold;
}

.days {
	border:1px solid white;
	overflow:auto;
	border-radius:5px;
}
.days .list {
  width: 14.28%;
  text-align: left;
  float:left;
  font-size:11pt;
  font-weight:bold;
  color: #777;
  height:110px;
 box-shadow: -1px -1px 2px -1px black;
 border:1px solid lightgrey;
  padding:6px;
  cursor:pointer;
  background:white;
}
.days .list:hover {
  background:#d9d9d9 !important;
}
.activedate {
    background: #808080 !important;
  color: black !important;
}



#regForm {
  background-color: #ffffff;
  padding: 10px;
  margin-top:-40px;
}

/* Mark input boxes that gets an error on validation: */
.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
  padding:10px;
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

/* Mark the active step: */
.step.active {
  background-color: black;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: grey;
}
.loader {
	display: inline-block;
  border: 12px solid #f3f3f3;
  border-radius: 100%;
  border-top: 12px solid black;
  width: 100px;
  height: 100px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}
/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>
</head>
<body id="myPage" onload = "showCalendar('now');">
    <div id="preloader">
        <div class="caviar-load"></div>
    </div>
   <!-- ***** Header Area Start ***** -->
    <?php
	include("nav_panel.php");
	?>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Login Area Start ***** -->
	<div id="calendar" style ="margin-top:120px;background:white;color:white;">

	
	<div class="container" >
		<div class="container " style="overflow:auto;padding:10px;margin-top:70px;" >
			<div style ="box-shadow: 0 2px 3px -1px white;background:#d9d9d9 !important;border-radius:5px;min-width:700px;overflow:auto;">
				<div class="month" id = "displaypic" style = "padding:30px;">
				<ul>
				<li class="prev" onclick = "showCalendar('prev');">&#10094;</li>
				<li class="next" onclick = "showCalendar('next');" >&#10095;</li>
				<li>
				
				<div style='font-size:18px;' id = "Displaymonth"> </div>
				<div style='font-size:18px;' id = "Displayyear"> </div>
				</li>
				</ul>
				</div>
				<ul class="weekdays"> 
				<li>Sun</li> 
				<li>Mon</li>
				<li>Tue</li>
				<li>Wed</li>  
				<li>Thu</li> 
				<li>Fri</li>
				<li>Sat</li>
				</ul>
				<div id = "showresult" style ="background:grey;padding:5px;"  >
				</div>
				<div id = "Tloading" style = "display:none;color:black;">
					<div style = "text-align:center;margin-top:100px;margin-bottom:100px;">
					<div style = "text-align:center;" class="loader"></div>
					<h5>Please Wait..<br> Loading Calendar</h5>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
     

    <script src="https://apps.elfsight.com/p/platform.js" defer></script>
    <div class="elfsight-app-0e33443e-7c02-43d8-aabf-282a5578dc8f"></div>
    
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
	<div style = "margin-top:50px;" class="modal fade" id="Addevent" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style ="padding:20px;">
		<h4>Transaction Details</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
          
        </div>
        <div class="modal-body">
		
		     <form role="form"  id="regForm" action="addreservation.php" method= "post">
			<input type="hidden" class="form-control" id="Event_date" name = "Event_date" >
						
			<!-- One "tab" for each step in the form: -->
			<hr>
			<div class="tab" >
				<h5>Step 1 (Choose Table #)</h5>
				<div class="form-group">
						<label for="psw"><span class="glyphicon glyphicon-shopping-cart"></span> Table #</label>
						  <select class="form-control" id="service" name= "service">
						  <option disabled selected>Choose Below</option>
						  <?php 
						  include("connect.php");
							$sql = "SELECT * FROM  tbltable";
							$result = $conn->query($sql);
							if($result->rowCount() > 0){
								while($row = $result->fetch(PDO::FETCH_ASSOC)){
									?>
									<option value = "<?php echo $row["tableID"];?>" ><?php echo $row["chair_no"];?></option>
									<?php
									
								}
							}
						  
						  ?>
						  </select>
				</div>
				
				
			</div>

			<div class="tab">
			<h3>Step 2 (Choose Time)</h3>
			
			  <div class="row">
				  <div class="form-group"style ="padding:20px;">
				 
					  <button type="button" class="btn btn-danger btn-default accordion " onclick = "viewtime(document.getElementById('Event_date').value,1,document.getElementById('service').value)" style = "width:100%;border:1px solid black;">View Time List</button>
					<div class="panel" id = "Panel1">
					
					 </div>
					 <div id = "timeloading" style = "display:none;color:black;">
						<div style = "text-align:center;margin-top:100px;margin-bottom:100px;">
						<div style = "text-align:center;" class="loader"></div>
						<h5>Please Wait..<br> Loading Time Sheet</h5>
						</div>
					</div>
					
					</div>
					<div class="col-sm-6 ">
						<div class="form-group">
						  <label for="usrname"><span class="glyphicon glyphicon-hourglass"></span>Start Time</label>
						  <input type="text" readonly class="form-control" id="Start1" name = "start" >
						</div>
					</div>
					<div class="col-sm-6 ">
						<div class="form-group">
						  <label for="usrname"><span class="glyphicon glyphicon-hourglass"></span>End Time</label>
						  <input type="text" readonly class="form-control" id="End1" name = "end" >
						</div>
					</div>
				</div>
			</div>

			<div class="tab">
			 <h3>Step 3 (Read Business Policy and Notes)</h3>
				<div class="form-group"style ="padding:20px;">
					  <p>This website is for Crownpark Resto. Owner of the website reserve the right to change/update any information given on the website. For more details about a certain item, feel free to reach out to the given contact details</p>
                
				</div>
			</div>

			<div class="tab">
			<h3>Step 4 (Transaction Summary)</h3>
				<div class="form-group"style ="padding:20px;">
					<h4 style = "font-size:12pt;padding:10px;">Your Almost Done!</h4>
					<p id = "outputDate">Date:2021/1/2</p>
					<p id = "outputTime">Time:7:00am - 10:00am</p>
					<p class="text-warning"><small>Please review all details before Submitting <br>This action cannot be undone.</small></p>
				</div>
			</div>
			<!-- Circles which indicates the steps of the form: -->
			<div style="text-align:center;">
			  <span class="step"></span>
			  <span class="step"></span>
			  <span class="step"></span>
			  <span class="step"></span>
			</div>
			<div style="overflow:auto;">
			  <div style="float:right;">
				<button type="button" class="btn btn-danger btn-default pull-left"id="prevBtn" style = "border:1px solid black;"onclick="nextPrev(-1)">Previous</button>
				<button type="button"class="btn btn-danger btn-default pull-left" id="nextBtn" style = "border:1px solid black;" onclick="nextPrev(1)">Next</button>
			  </div>
			</div>
			 <p>Need <a href="#">help?</a></p>
			</form>
        </div>
      </div>
    </div>
  </div>
	
	
	<script>
var datenow = '<?php echo $CurrentdateNow; ?>';
var ifSignedin ='<?php echo $signedIn; ?>';
var datesplit = datenow.split("/");
var year =  datesplit[2];
var month = datesplit[0];
var days =  datesplit[1];
var currentTab = 0;
var monthdesc = ["January","February","March","April","May","June","July","August","September","October","November","December"];

function showCalendar(action) {
	var monthName = new Array();
	monthName[1] = "January";
	monthName[2] = "February";
	monthName[3] = "March";
	monthName[4] = "April";
	monthName[5] = "May";
	monthName[6] = "June";
	monthName[7] = "July";
	monthName[8] = "August";
	monthName[9] = "September";
	monthName[10] = "October";
	monthName[11] = "November";
	monthName[12] = "December";
	if(action == "next"){
		month = Number(month) + 1;
		if(month>12){
			month = 1;
			year = Number(year) + 1;
		}else{
			year = Number(year);
		}
		
	}else if(action == "now"){
		month = Number(month);
		year = Number(year);
	}else{
		month = Number(month) - 1;
		if(month<1){
			month = 12;
			year = Number(year) - 1;
		}else{
			year = Number(year);
		}		
	}
	document.getElementById("Displaymonth").innerHTML = monthName[month];
	document.getElementById("Displayyear").innerHTML = year;
	var xhttp;
	  xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("Tloading").style.display = "none";
			document.getElementById("showresult").innerHTML = this.responseText;									
		}
	  };
	  
	  document.getElementById("Tloading").style.display = "block";
	  xhttp.open("GET", "OurCalendar.php?month="+month+"&year="+year+"&currentdate="+datenow, true);
	  xhttp.send(); 
}
function showData(id){
	
	alert("ID: "+ id);
}
function showSched(Sday,Smonth,Syear){
	//alert(Sday+"/"+Smonth+"/"+Syear);
	var calendarYear = document.getElementById("Displayyear").innerHTML;
	var Month_name = document.getElementById("Displaymonth").innerHTML;

	var calendarMonth = monthdesc.indexOf(Month_name);
		//alert(calendarMonth);
	
	if(!ifSignedin){
		alert("Please Login to Book Schedule");
		return 0;
	}
	
	if(Syear < datesplit[2]){
		alert("cannot add event 1");
		
	}else{
	    //alert("Selected day: "+ Sday + "Selected month: "+ Smonth + "Selected year: "+ Syear);
	     //alert("current day: "+ datesplit[1] + "current month: "+ parseInt(datesplit[0]) + "current year: "+ datesplit[2]);
	     
        // for the current date
		if((Sday < datesplit[1])){		
		    //alert("cannot add event 1");
		     if(Smonth <= parseInt(datesplit[0]) ){
		        alert("cannot add event ");
		    }else{
		        	document.getElementById("Event_date").value = Syear+"/"+Smonth+"/"+Sday;
					//document.getElementById("venue").value ="";
					//document.getElementById("venuelocation").value ="";
					document.getElementById("Start1").value ="";
					document.getElementById("End1").value ="";
					document.getElementById("Panel1").style.maxHeight = null;
					currentTab = 0;
					showTab(0);
					$("#Addevent").modal();
		    }
		}
		else{
			document.getElementById("Event_date").value = Syear+"/"+Smonth+"/"+Sday;
			//document.getElementById("venue").value ="";
			//document.getElementById("venuelocation").value ="";
			document.getElementById("Start1").value ="";
			document.getElementById("End1").value ="";
			document.getElementById("Panel1").style.maxHeight = null;
			currentTab = 0;
			showTab(0);
			$("#Addevent").modal();
		}
	}
	
}

function setdateandtime(date){
	 var batcharray = [];
	var checkboxes =  document.getElementsByName("mycheckbox[]");
	var cbcounter= 0;
	
	for (var i = 0; i < checkboxes.length; i++) {
		
		if(checkboxes[i].checked == true){
			//alert(checkboxes[i].value);
			 batcharray.push(checkboxes[i].value);		
			cbcounter++; 
		}	 
	}	
	//alert(batcharray.length);	
	if(cbcounter == 0){
		alert("Please select item(s) Thank you!.");
		return 0;
	}else{
		if(batcharray.length>1){
		var start = batcharray[0].split("/");
		var end = batcharray[batcharray.length-1].split("/");
		 var xhttp;
		  xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				
				var response = JSON.stringify(this.responseText);
				//alert(response);
				var newreponse = (response).slice(1,12);
				if(newreponse == 'unavailable'){
					alert("Unavailable");
					
				}else{
					document.getElementById("Start1").value = String(start[0]);
					document.getElementById("End1").value = String(end[1]);
					var panel = document.getElementById("Panel1");
					  if (panel.style.maxHeight) {
					  panel.style.maxHeight = null;
					} else {
					  panel.style.maxHeight = panel.scrollHeight + "px";
					}
				}	
			}
		  };
		  
		  xhttp.open("GET", "checkSched.php?start="+start[0]+"&end="+end[1]+"&date="+date, true);
		  xhttp.send();   
		
		
		
		
		
		
		}else{
			var start = batcharray[0].split("/");
			 var xhttp;
		  xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var response = JSON.stringify(this.responseText);
				//alert(response);
				var newreponse = (response).slice(1,12);
				if(newreponse == 'unavailable'){
					alert("Unavailable");
				}else{
					//alert("available");
					document.getElementById("Start1").value = String(start[0]);
					document.getElementById("End1").value = String(start[1]);
					var panel = document.getElementById("Panel1");
					  if (panel.style.maxHeight) {
					  panel.style.maxHeight = null;
					} else {
					  panel.style.maxHeight = panel.scrollHeight + "px";
					}					
				}	
			}
		  };
		  xhttp.open("GET", "checkSched.php?start="+start[0]+"&end="+start[1]+"&date="+date, true);
		  xhttp.send();  
			
			
		}
	
	}

	
}
function viewtime(date,hrs,id){
	hrs = 1;
	//alert(date);
    var panel = document.getElementById("Panel1");
	var xhttp;
	  xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("timeloading").style.display = "none";
			panel.innerHTML = this.responseText;
			  if (panel.style.maxHeight) {
			  panel.style.maxHeight = null;
			} else {
			  panel.style.maxHeight = panel.scrollHeight + "px";
			}
		}
	  };
	  document.getElementById("timeloading").style.display = "block";
	  xhttp.open("GET", "GetTimeAndDate.php?date="+date+"&hrs="+hrs+"&id="+id, true);
	  xhttp.send();   

  
}
</script>
<script>
 // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  for(var tab1 = 0; tab1<x.length; tab1++){
	  if(tab1 == n){
		  x[tab1].style.display = "block";
			
	  }else{
		  x[tab1].style.display = "none";
  
	  }
  }
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }

	//document.getElementById("outputService").innerHTML = "Service: "+document.getElementById("service").value;
	//document.getElementById("outputVenue").innerHTML = "Event Name: "+document.getElementById("venue").value;
	//document.getElementById("outputlocation").innerHTML = "Location: "+document.getElementById("venuelocation").value;
	document.getElementById("outputDate").innerHTML = "Date: "+document.getElementById("Event_date").value;
	document.getElementById("outputTime").innerHTML = "Time: "+document.getElementById("Start1").value + " to "+ document.getElementById("End1").value;
					
  // ... and run a function that displays the correct step indicator:
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
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
	$("#Addevent").modal("hide");
    return false;
  }
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
      // and set the current valid status to false:
      valid = false;
    }else{
		 y[i].classList.remove("invalid");
	}
  }
  if (document.getElementById("service").value == "Choose Below" ) {
      // add an "invalid" class to the field:
	  document.getElementById("service").classList.add("invalid");
      // and set the current valid status to false:
      valid = false;
    }else{
		  document.getElementById("service").classList.remove("invalid");
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
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}

</script>

    <!-- ****** Footer Area End ****** -->

	<script src="css/main.js"></script>
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
</body>
</html>