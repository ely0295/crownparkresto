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

    <!-- Template Stylesheet -->
    <link href="css/dashboard.css" rel="stylesheet">
</head>
<script>



function updateproduct(product_code,product_name,price,category_code){
	document.getElementById("uproduct_code").value = product_code;
	document.getElementById("udescription").value = product_name;
	document.getElementById("uprice").value = price;
	$("select[name='uCategory']").find("option[value='"+category_code+"']").attr("selected",true);

	$("#updateproduct").modal();
}


function loadReslist(res_status,res_date) {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		 document.getElementById("Tloading").style = "display:none;";
		// alert(this.responseText);
		document.getElementById("reservationlist").innerHTML = this.responseText;
    }
  };
  document.getElementById("reservationlist").innerHTML = "";
  document.getElementById("Tloading").style = "display:block;";
  xhttp.open("GET", "filters.php?status="+res_status+"&date="+res_date, true);
  xhttp.send();   
}
//search res Data
function searchRes_data(id){
	valueid = document.getElementById(id).value;
	var xhttp;
	  xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("reservationlist").innerHTML = this.responseText;
			document.getElementById("Tloading").style = "display:none;";	
		}
	  };
	  document.getElementById("reservationlist").innerHTML = "";
	  document.getElementById("Tloading").style = "display:block;";
	  xhttp.open("GET", "filters.php?searchCode="+valueid, true);
	  xhttp.send();
}
function addproduct() {
     $("#addproduct").modal('show');
	 
}
function updateproduct(product_code,product_name,price,category_code) {
	document.getElementById("uproduct_code").value = product_code;
	document.getElementById("udescription").value = product_name;
	document.getElementById("uprice").value = price;
	$("select[name='uCategory']").find("option[value='"+category_code+"']").attr("selected",true);

     $("#updateproduct").modal('show');
	 
}
</script>
<body>
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
					<a href="admin_orders.php" class="nav-link nav-link "><i class="fa fa-globe me-2"></i>Orders</a>
					<a href="admin_reservation.php" class="nav-link nav-link "><i class="fa fa-calendar me-2"></i>Reservations</a>
					<a href="admin_clients.php" class="nav-link nav-link active"><i class="fa fa-male me-2"></i>Clients</a>
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
                        <h3 class="mb-0"><span class="fa fa-paste"></span>Products </h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
				
                    <thead>
						<tr>
                            <th colspan = "3" style = "color:white;">
							
							</th>
                            <th colspan = "3"  style= "text-align:right;">
								<a  class="btn btn-primary"  role="button" href="javascript:addproduct();" ><span  class="glyphicon glyphicon-circle-arrow-left"></span> <b style ="margin-left:5px;"> Add New Product</b></a>										
							</th>
                            
                        </tr>
						<tr style = "display:none;" >
                            
							
                            <th colspan = "5" >
								<form  action="javascript:searchRes_data('searchticketInput');" >
									<div class="input-group" style = "width:100%;" >
								
									<div class="form-group has-feedback has-clear">
									  <input oninput = "showclear();" required type="text" class="form-control"id = "searchticketInput" placeholder="keywords( Product Code, Description )">
									  
									</div>
									<span class="input-group-btn">
									  <button type="submit" class="btn btn-primary" id="exampleButton1">Search</button>
									</span>
									</div>
									<span class="form-control-clear glyphicon glyphicon-remove form-control" id = "clearbtn" style = "display:none;width:140px;cursor:pointer;" onclick = "clearsearch();"> Clear Search</span>
								  
								</form>
							</th>
                            
                        </tr>
                        <tr>
							<th>Product Code</th>
                            <th>Product Description</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
					<div id = "Tloading" style = "display:none;">
						<div style = "text-align:center;margin-top:100px;margin-bottom:100px;">
						<div style = "text-align:center;" class="loader"></div>
						<h5>Please Wait..<br>Fetching List.</h5>
						</div>
					</div>
                    <tbody id = "reservationlist">
						<?php
						$current_date = date('Y-m-d');
						include 'connect.php';
						$Get_query = "select * from product ";						
						$result = $conn->query($Get_query);
						$counter= 1;
						if($result->rowCount() > 0){
							while($row1 = $result->fetch(PDO::FETCH_ASSOC)){
								?>
							<tr>
								<td><?php echo $row1["product_code"]?></td>
								<td><?php echo $row1["product_name"]?></td>
								<td><?php echo $row1["price"]?></td>
								<td ><?php echo $row1["category_code"]?> </td>
								<td class="td-actions text-right">
									
									<a href="javascript:updateproduct('<?php echo $row1["product_code"]?>','<?php echo $row1["product_name"]?>','<?php echo $row1["price"]?>',			
									'<?php echo $row1["category_code"]?>')" rel="tooltip" class="btn btn-success btn-just-icon btn-sm" data-original-title="" title="View/Edit">
										<i class="material-icons">View/Edit</i>
									</a>
									
								</td>
							</tr>
							<?php	
							$counter++;
							}
						}else{
							?>
							 <tr>
                            <td class="text-center" colspan = "6" >No Data Found</td>
                          
							</tr>
							<?php	
						}
						
						?>
					
                    </tbody>
                </table>
                    </div>
                </div>
            </div>
        

    <!--  Order Area End -->
        <br><br><br><br>
        <!-- Modal Section Start  -->
  <div class="modal section-padding-100" id="addproduct">
	 <div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form  method = "post" action = "product\addproduct.php" enctype="multipart/form-data"  >
				<div class="modal-header">						
					<h4 class="modal-title">Product Details</h4>
				</div>
				<div class="modal-body">					
					<div class="row" style = "text-align:left;padding:0px;">
					 
					<div class="col-sm-12" style = "text-align:left;"  >
					   <div class="form-group">
						  <label for="exampleLname"> Category</label>
						  <select class="form-control" id="Category" name = "Category" required> 
							<option value="none" selected >Choose Below</option>
							 <?php 
						  include("connect.php");
							$sql = "SELECT * FROM  categories";
							$result = $conn->query($sql);
							if($result->rowCount() > 0){
								while($row = $result->fetch(PDO::FETCH_ASSOC)){
									?>
									<option value = "<?php echo $row["cat_id"];?>" ><?php echo $row["cat_desc"];?></option>
									<?php
									
								}
							}
						  
						  ?>
						</select>
						 </div>
					  </div>
					  
					 
						
					  <div class="col-sm-12" style = "text-align:left;"  >
					   <div class="form-group">
						  <label for="exampleLname"> Product Description</label>
						  <input type="text"style = "font-size:11pt;" autocomplete="off"  class="form-control" id="description" name="description" placeholder="Enter description" required >
						</div>
					  </div>
						<div class="col-sm-12" style = "text-align:left;"  >
					   <div class="form-group">
						  <label for="exampleLname"> Price</label>
						  <input type="number" style = "font-size:11pt;" autocomplete="off"  class="form-control" id="price" name="price" required >
						</div>
					  </div>
						<div class="col-sm-6 " style = "text-align:left;" >
					   <div class="form-group">
						  <p>Please Choose Image </p>
						  <input  type="file" accept="image/*" class="form-control" id="fileuploadimg" name = "fileuploadimg"  >
					</div>
					  </div>						
											  
					</div>					  
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" onclick = " $('#addproduct').modal('hide');" value="Cancel">
					<input type="submit" class="btn btn-success" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>

<div id="updateproduct" class="modal section-padding-100" >
	<div class="modal-dialog">
		<div class="modal-content">
			<form  method = "post" action = "product\updateproduct.php" enctype="multipart/form-data"  >
				<div class="modal-header">						
					<h4 class="modal-title">Product Details</h4>
				
				</div>
				<div class="modal-body">					
					<div class="row" style = "text-align:left;padding:0px;">
					  <input type="hidden"style = "font-size:11pt;" autocomplete="off"  class="form-control" id="uproduct_code" name="uproduct_code" placeholder="Enter description" required >
						
					<div class="col-sm-12" style = "text-align:left;"  >
					   <div class="form-group">
						  <label for="exampleLname"> Category</label>
						  <select class="form-control" id="uCategory" name = "uCategory" required> 
							<option value="none" selected >Choose Below</option>
							 <?php 
						  include("connect.php");
							$sql = "SELECT * FROM  categories";
							$result = $conn->query($sql);
							if($result->rowCount() > 0){
								while($row = $result->fetch(PDO::FETCH_ASSOC)){
									?>
									<option value = "<?php echo $row["cat_id"];?>" ><?php echo $row["cat_desc"];?></option>
									<?php
									
								}
							}
						  
						  ?>
						</select>
						 </div>
					  </div>
					  
					 
						
					  <div class="col-sm-12" style = "text-align:left;"  >
					   <div class="form-group">
						  <label for="exampleLname"> Product Description</label>
						  <input type="text"style = "font-size:11pt;" autocomplete="off"  class="form-control" id="udescription" name="udescription" placeholder="Enter description" required >
						</div>
					  </div>
						<div class="col-sm-12" style = "text-align:left;"  >
					   <div class="form-group">
						  <label for="exampleLname"> Price</label>
						  <input type="number" style = "font-size:11pt;" autocomplete="off"  class="form-control" id="uprice" name="uprice" required >
						</div>
					  </div>
						<div class="col-sm-6 " style = "text-align:left;" >
					   <div class="form-group">
						  <p>Please Choose Image </p>
						  <input  type="file" accept="image/*" class="form-control" id="fileuploadimg" name = "fileuploadimg"  >
					</div>
					  </div>						
											  
					</div>					  
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" onclick = " $('#updateproduct').modal('hide');" value="Cancel">
					<input type="submit" class="btn btn-success" value="Save">
				</div>
			</form>
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