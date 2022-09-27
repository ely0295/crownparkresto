<!DOCTYPE html>
<?php include("accessright_admin.php") ?>
<html lang="en"> 

<head>
    <meta charset="utf-8">
    <title>Crown Park Restaurant | Admin Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="style/crudtable.css">
    <!-- Template Stylesheet -->
    <link href="css/dashboard.css" rel="stylesheet">
	<script src="javascript/crudscripts2.js"></script>	
</head>

<body onload = "retrieveOrders(1,10)">
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <div class="sidebar bg-light pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h5 class="">Crown Park Restaurant</h5>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/bg-img/avatar.png" alt="" width="40" height="40">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION['name'];?></h6>
                        <span>Administrator</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="dashboard.php" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
					<a href="admin_orders.php" class="nav-link nav-link active"><i class="fa fa-globe me-2"></i>Orders</a>
					<a href="admin_reservation.php" class="nav-link nav-link "><i class="fa fa-calendar me-2"></i>Reservations</a>
					<a href="admin_clients.php" class="nav-link nav-link"><i class="fa fa-male me-2"></i>Clients</a>
                    <a href="admin_tables.php" class="nav-link nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                     <a href="admin_products.php" class="nav-link nav-link"><i class="fa fa-table me-2"></i>Products</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php
			include("admin_nav_panel.php");
			?>
            <!-- Navbar End -->


            <div class="container-fluid container-order-area pt-4 px-4">
                <div class="text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="mb-0"><span class="fa fa-paste"></span> Orders</h3>
						
						<a href="javascript:Printme()" class="btn btn-info" ><i class="fa fa-print me-2" >&#xE147;</i> <span>Print List</span></a>
                    </div>
					<div class="row">
					
					<div class="col-sm-2" style= "display:flex;">
					<div class="input-group" >
						<div class="input-group">
							<input  readonly value = "Show "type="text" class="form-control" id="usr" >
						</div>
					</div>
					<div class="input-group" >	
						<div class="input-group" >
						<select  style = "width:80px;background:white;"onchange = "retrieveOrders(1,this.value)" class="form-control" id="perpage">
							<option  value = "5">5</option>
							<option selected value = "10"> 10</option>
							<option value = "25">25</option>
						</select>
						</div>
					</div>
					</div>
					<div class="col-sm-4" style= "display:flex;"> 
						<div class="input-group">
							<div class="input-group">
								<select onchange = "datefilter()" class="form-control" id="filterdate">
									<option selected value = "all_dates" >All dates: </option>
									<option value = "spec_date" >Specific Date</option>
								</select>
							</div>
						</div>
						<div id = "inputdate" class="input-group" style = "display:none;">
							<div class="input-group">
								<input onchange = "filterbydate(this.value,1,document.getElementById('perpage').value)" type="date" class="form-control" id="inputdatevalue">
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<form method ="GET" action = "Javascript:if(document.getElementById('searchinput').value != ''){searchuserdata('details',document.getElementById('searchinput').value)}else{alert('search field cannot be empty')};">
							<div class="input-group">
								<input onkeyup = "if(this.value.length == 0){searchuserdata('*',document.getElementById('searchinput').value);}" id = "searchinput" type="text" class="form-control" placeholder="Search">
								<div class="input-group-btn">
								<button class="tda btn btn-sl btn-danger"type="submit">Search</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<br>
                <div id = "Userlist" ></div>
				<div id = "loading" style = "text-align:center;display:none;padding:20px;" >
					<img style = "width:90px;height:90px;" src="resources\loading2.gif">
					<p id = "loadingdesc" style = "font-weight: bold;font-size: 10pt;color: black;"><em>Fetching Data <br>Please Wait..</em></p>
				</div>
				
                </div>
            </div>
        

    <!--  Order Area End -->
        <br><br><br><br>
        <!-- Modal Section Start  -->
     <div class="modal section-padding-100 my-5" id="mymodal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">ORDER# - 0121</h5>
                  </div>
                  <div class="modal-body">
                     <div class="cart-description">
                             <table class="table">
                                <tr class="text-light bg-dark">
                                   <th>DISH</th>
                                   <th>QUANTITY</th>
                                   <th>AMOUNT</th>
                                </tr>
                                 <tr>
                                   <td>3 Kind Cold Cuts</th>
                                   <td>x1</td>
                                   <td>&#8369;417</td>
                                </tr>
                                <tr>
                                   <td>Crown Park Dumpling</th>
                                   <td>x1</td>
                                   <td>&#8369; 189</td>
                                </tr>
                                <tr>
                                   <td>Calamares</th>
                                   <td>x1</td>
                                   <td>&#8369; 288</td>
                                </tr>
                                <tr>
                                   <th colspan="2">Total: </th>
                                   <th>&#8369; 894</th>
                                </tr>
                                <tr>
                                   <th colspan="2">Status: </th>
                                   <th>
                                      <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                          <option selected>Pending Pickup</option>
                                          <option value="1">Paid</option>
                                      </select>
                                   </th>
                                </tr>
                             </table>
                             
                             <label class="fw-bold">Pickup Time:</label>
                             <input type="time" name="" value="13:00" size="4">
                             <small class="text-muted">Note: You can adjust pick-up time. Click "Update" once done.</small>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-sm btn-secondary" onclick="update()">UPDATE</button>
                     <button type="button" class="btn btn-sm btn-secondary" onclick="cancel()">CANCEL</button>
                     <button type="button" class="btn btn-sm btn-danger" onclick="closed()">CLOSE</button>

                  </div>
                </div>
              </div>
        </div>
            <!-- Widgets End -->

            
            <!-- Recent Sales End -->




            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-dark rounded-top p-4">
                    <div class="row">
                        <div class="col-12 text-center w-100">
                            &copy; <a href="#" class="text-secondary">Crown Park Restaurant</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->
    </div>
	<!-- Print Modal HTML -->
	<div class="modal section-padding-100 my-5" id="printModal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Print Module</h5>
                  </div>
                  <div class="modal-body">		
						<input type="button" class="btn btn-success" onclick="fnExcelReport();" value="Export to CSV">
						<div style = 'max-height:450px;overflow:auto;display:none;' id = "printdata">

						</div>
						<iframe id="txtArea1" style="display:none"></iframe>
                  </div>
                  <div class="modal-footer">
                   <input type = "hidden" id = "customerid">
						
						<input type="button"  class="btn btn-default" onclick = "$('#printModal').modal('hide');" value="Cancel">
                  </div>
                </div>
              </div>
    </div>

	<script>

	function Printme(){
		var datastr = "<table id = 'tabledata' class='table table-striped table-hover' border='1' >";
		var myTab = document.getElementById('mytable');
			for (i = 0; i < myTab.rows.length; i++) {			
				if(i == 0){
					datastr = datastr	+ "<thead><tr>";
				}else{
					datastr = datastr	+ "<tr>";
				}
				var objCells = myTab.rows.item(i).cells;
				for (var j = 0; j < objCells.length-1; j++) {
					if(i == 0){
						if(j == 0){
							datastr = datastr + '<th> # </th>';	
						}else{
							datastr = datastr + '<th> ' + objCells.item(j).innerHTML+ "</th>";	
						}										
					}else{
						if(j == 0){
							datastr = datastr + '<td> ' + i + "</td>";	
						}else{
							datastr = datastr + '<td> ' + objCells.item(j).innerHTML+ "</td>";	
						}					
					}				
				}
				if(i == 0){
					datastr = datastr	+ "</thead></tr>";
				}else{				
					datastr = datastr	+ "</tr>";
				}
			}
			datastr = datastr	+ "</table>";
				
			document.getElementById('printdata').innerHTML = datastr;
			$('#printModal').modal('show');		
	}
	function fnExcelReport()
	{
		var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
		var textRange; var j=0;
		tab = document.getElementById('tabledata'); // id of table

		for(j = 0 ; j < tab.rows.length ; j++) 
		{     
			tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
			//tab_text=tab_text+"</tr>";
		}

		tab_text=tab_text+"</table>";
		tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
		tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
		tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

		var ua = window.navigator.userAgent;
		var msie = ua.indexOf("MSIE "); 

		if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
		{
			txtArea1.document.open("txt/html","replace");
			txtArea1.document.write(tab_text);
			txtArea1.document.close();
			txtArea1.focus(); 
			sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
		}  
		else                 //other browser not tested on IE 11
			sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  
		$('#printModal').modal('hide');	
		return (sa);
	}
	</script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
	
    <!-- Template Javascript -->
    <script src="js/dashboard.js"></script>
</body>

</html>