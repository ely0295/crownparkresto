<!DOCTYPE html>
<?php include("accessright.php") ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Crown Park Restaurant | Orders</title>

    <!-- Core Stylesheet -->
    <link href="mycss.css" rel="stylesheet">
 
    <!-- Responsive CSS -->
    <link href="css/responsive/responsive.css" rel="stylesheet"> 
</head>
<body>
     <!-- Spinner Start -->
    <div id="preloader">
        <div class="caviar-load"></div>
    </div>
    <!-- Spinner End -->
    
   <?php
	include("nav_panel.php");
	?>
    <!-- ***** Header Area End ***** -->
  
   <!--  Order Area Start -->

            <div class="container-fluid container-order-area pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="mb-0"><span class="fa fa-calendar heading-icon"></span>My Reservations</h3>
                        <button class="booking-bot btn btn-sm btn-danger mb-0" onclick="window.location.href = 'mycalendar.php'"><span class="fa fa-plus"></span> Add Reservation</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-hover mb-0">
                            <thead>
                                <tr>
                                 
                                    <th scope="col">Date</th>
                                    <th scope="col">Reservation Number</th>
                                    <th scope="col">Time</th>
                                    <th scope="col" class="d-none d-sm-table-cell">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
									$client_id = $_SESSION['client_id'];
									include 'connect.php';
									$Get_query = "select A.* from reservation as A where A.fkclient_id ='$client_id' ";						
									$result = $conn->query($Get_query);
									$counter= 1;
									if($result->rowCount() > 0){
										while($row = $result->fetch(PDO::FETCH_ASSOC)){
											$ordercode = $row["reservation_code"];
											$date = strtotime($row["res_date"]);
											
											?>
											 <tr>
												<td><?php echo date('d M Y' , strtotime($row["res_date"])); ?></td>
												<td><?php echo $row["reservation_code"]?></td>
												<td><?php echo $row["starttime"]; ?> - <?php echo $row["endtime"]; ?></td>
												
												<td class="d-none d-sm-table-cell"><?php echo $row["res_status"]?></td>
												<td><button class="tda btn btn-sm btn-danger" onclick="vieworder('<?php echo $row["reservation_code"]?>')">CANCEL</button></td>
											</tr>
											<?php
											
										}
									}
									?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        


    <!--  Order Area End -->
    <!-- Modal Section Start  -->
     <div class="modal section-padding-50" id="mymodal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">RES# - 0121</h5>
                  </div>
                  <div class="modal-body">
                     <div class="cart-description">
                            <div class="table-responsive">
                                 <table class="table">
                               <tr class="text-light bg-dark">
                                   <th>TABLE NUMBER</th>
                                   <th>PARTY SIZE</th>
                                   <th>DATE</th>
                                   <th>TIME</th>
                                </tr>
                                 <tr>
                                   <td>#5</th>
                                   <td><input type="number" name="" value="4" class="form-cart1"></td>
                                   <td><input type="date" name="" value="2022-05-01"class="form-control"></td>
                                   <td><input type="time" name="" value="13:00" class="form-control"></td>
                                </tr>
                                <tr class="text-light bg-dark">
                                   <th>DISH</th>
                                   <th>QUANTITY</th>
                                   <th>AMOUNT</th>
                                   <th>ACTION</th>
                                </tr>
                                 <tr>
                                   <td>3 Kind Cold Cuts</th>
                                   <td><input type="number" name="" value="1" class="form-cart1"></td>
                                   <td>&#8369;417</td>
                                   <td><button class="btn btn btn-sm btn-danger bot">REMOVE</button></td>
                                </tr>
                                <tr>
                                   <td>Crown Park Dumpling</th>
                                    <td><input type="number" name="" value="1" class="form-cart1"></td>
                                   <td>&#8369; 189</td>
                                   <td><button class="btn btn-sm btn-danger bot">REMOVE</button></td>
                                </tr>
                                <tr>
                                   <td>Calamares</th>
                                   <td><input type="number" name="" value="1" class="form-cart1"></td>
                                   <td>&#8369; 288</td>
                                   <td><button class="btn btn-sm btn-danger bot">REMOVE</button></td>
                                </tr>
                                <tr>
                                   <th colspan="2">Total: </th>
                                   <th>&#8369; 894</th>
                                   <th></th>
                                </tr>

                             </table>
                            </div>
                             <small class="text-muted">Note: You can only update reservation details 30 mins before the reservation time.</small>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-sm btn-primary">&#9733;RATE</button>
                     <button type="button" class="btn btn-sm btn-info" onclick="update()">UPDATE</button>
                     <button type="button" class="btn btn-sm btn-secondary" onclick="cancel()">CANCEL</button>
                     <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">CLOSE</button>
                    
                  </div>
                </div>
              </div>
        </div>

    <!-- Modal Section End  -->
    <!-- Modal Section Start  -->
     <div class="modal section-padding-100" id="mymodal1">
              <div class="modal-dialog mt-5">
                <div class="modal-content">
                  <div class="modal-header bg-dark">
                    <h5 class="text-light">Book a Table!</h5>
                  </div>
                  <div class="modal-body mx-4 p-3">
                    <div class="row mt-1">
                        <div class="col-6">
                            <label class="form-label">Date: </label>
                            <input type="date" name="" class="booking-form" />
                        </div>
                        <div class="col-6">
                            <label class="form-label">Time: </label>
                            <input type="time" name="" class="booking-form" />
                        </div>
                    </div>
                    <div class="row mt-1">
                         <div class="col-6">
                            <label class="form-label" >Party Size: </label>
                            <input type="number" name="" class="booking-form" placeholder="Party Size" >
                        </div>
                         <div class="col-6">
                            <label class="form-label" >Number of tables: </label>
                            <input type="number" name="" class="booking-form" placeholder="1" >
                        </div>
                    </div>
                    
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="cursor-point btn btn-sm btn-primary" onclick="addFood()">PLACE RESERVATION</button>
                     <button type="button" class="cursor-point btn btn-sm btn-danger" data-dismiss="modal">CLOSE</button>
                  </div>
                </div>
              </div>
        </div>

    <!-- Modal Section End  -->
   <!-- Modal Section Start  -->
     <!-- Modal Section Start  -->
     <div class="modal section-padding-100" id="mymodal2">
              <div class="modal-dialog mt-5">
                <div class="modal-content">
                  <div class="modal-body p-3">
                        <div class="col-12 pt-4">
                            <p class="h4">Successfully Placed Reservation!</p>
                            <p class="h5">Res#: 012154745614</p>
                            <p class="h6 text-primary">Would you like to reserve food as well?</p>
                           
                        </div>
                  </div>
                   <div class="modal-footer">
                     <small class="text-muted">Note: You will receive this reservation number via email and thru SMS shortly.</small>
                     <button type="button" class="cursor-point btn btn-sm btn-primary" onclick="redirectToMenu()">YES</button>
                     <button type="button" class="cursor-point btn btn-sm btn-danger" data-dismiss="modal">NO</button>
                  </div>
                </div>
              </div>
        </div>

    <!-- Modal Section End  -->






<!-- ****** Footer Area Start ****** -->
    <footer class="caviar-footer-area mt-5">
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
    <script type="text/javascript">
        function cancel(){
            if (confirm('Are you sure you want to cancel this reservation? If yes, press OK.')) {
              alert('Order Cancelled Successfully!');
            }
        }
         function update(){
            if (confirm('Are you sure you want to update reservation details? If yes, press OK.')) {
              alert('Updated Successfully!');
            }
        }
        function view() {
              $("#mymodal").modal();
        }
         function bookNow() {
              $("#mymodal1").modal();
        }
        function addFood(){
             $("#mymodal1").modal('hide');
            $("#mymodal2").modal();
        }
        function redirectToMenu() {
            window.location.href="menu1.html";
        }
       
    </script>

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

</body>