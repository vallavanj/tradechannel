   <!-- Navigation -->
            <nav class="navbar navbar-inverse  navbar-fixed-top" role="navigation" style="background:#f15a22;border: none;">
                <div class="navbar-header">
					<div class="row">
						<div class="col-lg-2">
							<img src="..\assets\admin\images\ic_logo_transparent_small.png" style="width: 40px;height: auto;margin: 5px 15px;" alt="Trade Channel">
						</div>
						<div class="col-lg-10">
							<a class="navbar-brand" style="color:#fff;font-size:20px;" href="event.php">Trade Channel Inc</a>
						</div>
					</div>
					
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                

                <ul class="nav navbar-right navbar-top-links">
                   
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#fff;">
                            <i class="fa fa-user fa-fw"></i><?php echo $_SESSION['username']; ?><b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <!--<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a> </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a> </li>  -->
                            <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            
                           <!-- <li>
                                <a href="dashboard.php" ><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>  -->
							<li>
						
                                <a href="event.php" 
								<?php 
								$uri = $_SERVER['REQUEST_URI'];
								if (strpos($uri, 'event_add.php') !== false) { echo 'class="active"';}  
								if (strpos($uri, 'event_edit.php') !== false) { echo 'class="active"';} 
								if (strpos($uri, 'event_view.php') !== false) { echo 'class="active"';} 		?>
								><i class="fa fa-outdent fa-fw"></i> Events</a>
                            </li>
                          
                        </ul>
                    </div>
                </div>
            </nav>