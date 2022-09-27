 <header class="header_area" id="header" style="background-color: rgba(0, 0, 0, 0.85);">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 h-100">
                    <nav class="h-100 navbar navbar-expand-lg align-items-center">
                        <a class="navbar-brand" href="index.php"><img src="img/logo.png" style="width: 50px; height: 50px;">&nbsp;Crown Park Restaurant</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#caviarNav" aria-controls="caviarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="fa fa-bars"></span></button>
                        <div class="collapse navbar-collapse" id="caviarNav">
                            <ul class="navbar-nav ml-auto" id="caviarMenu">
                                <li class="nav-item ">
                                    <a class="nav-link" href="index.php#home">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php#menu">Menu</a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="index.php#reservation">Reservation</a>
                                </li>
								<?php
								if((isset($_SESSION['signed_in'])) ){
									if($_SESSION['usertype']=="administrator"){
										?>
										<li class="nav-item dropdown">
											<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['name'];?></a>
											<div class="dropdown-menu" aria-labelledby="navbarDropdown">
												<a class="dropdown-item" href="profile.php">Profile</a>
												<a class="dropdown-item" href="dashboard.php">Dashboard</a>
												<a class="dropdown-item" href="logout.php?action=out">Logout</a>
											</div>
										</li>
										<?php
										
									}else{
										?>
										<li class="nav-item dropdown">
											<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['name'];?></a>
											<div class="dropdown-menu" aria-labelledby="navbarDropdown">
												<a class="dropdown-item" href="profile.php">Profile</a>
												<a class="dropdown-item" href="cart.php">Cart</a>
												<a class="dropdown-item" href="orders.php">Orders</a>
												<a class="dropdown-item" href="reservation.php">Reservations</a>
												<a class="dropdown-item" href="logout.php?action=out">Logout</a>
											</div>
										</li>
										<?php
									}
								}else{
									?>
									 <li class="nav-item">
										<a class="nav-link" href="account.php">Log In</a>
									</li>
									<?php
								}	
								?>
								
                               
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>