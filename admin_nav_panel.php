<nav class="navbar navbar-expand bg-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><img src="img/logo.png" width="40" height="40"></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0 bg-dark">
                    <i class="fa fa-bars "></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2 bg-dark"></i>
                            <span class="d-none d-lg-inline-flex" >Messages</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/bg-img/avatar.png" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jake Ekaj</h6>
                                        <small>Do you have vegetarian options?</small>
                                    </div>
                                </div>
                            </a>
                          
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all messages</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2 bg-dark"></i>
                            <span class="d-none d-lg-inline-flex">Notifications</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Order#: 123456</h6>
                                <small>Due: 1:00 PM</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Order#: 213456</h6>
                                <small>Due: 1:00 PM</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Order#: 312456</h6>
                                <small>Due: 1:00 PM</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/bg-img/avatar.png" alt="" width="40" height="40">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['name'];?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="index.php" class="dropdown-item">Homepage</a>
                            <a href="dashboard.php" class="dropdown-item">Dashboard</a>
                            <a href="profile.php" class="dropdown-item">My Profile</a>
                            <a  href="logout.php?action=out" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>