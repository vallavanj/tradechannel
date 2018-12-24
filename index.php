<?php
include_once('function.php');
$con = new admin();
if(isset($_POST['submit'])) {
	
	$username=$_POST['username'];
	$password=$_POST['password'];
	$res=$con->login($username,$password);
	if($res){
		
		session_start();
		$row=mysqli_fetch_array($res);
		$_SESSION['username'] = $row['username'];
		$_SESSION['id'] = $row['id']; 
		header("Location:pages/event.php");
	}
	else {
		echo "username password error";
	}
	
}


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Admin Panel</title>

        <!-- Bootstrap Core CSS -->
        <link href="assets/admin/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="assets/admin/css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="assets/admin/css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="assets/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
	<style>
	label.error {
		color:red;
	}
	</style>
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="login-panel panel panel_custom">
                        <div class="panel-heading panel_heding_custom_login" >
                           <!-- <h3 class="panel-title">Admin Sign In</h3>  -->
						   <div class="row text-center">
									<div class="col-sm-2">
										<img src="assets\admin\images\ic_logo_transparent_small.png" style="width:60px;height: auto;margin: 5px 15px;" alt="Trade Channel">
									</div>
									<div class="col-sm-5"><h2 class="text-center">Trade Channel</h2></div>
							</div>
                        </div>
                        <div class="panel-body">
							<div class="row">
								<h4 class="text-center">Admin Login</h4>
							</div>
									
							 <form  method="post" id="admin-login" class="form-signin" action="" novalidate="novalidate">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="username" name="username" type="text" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                    </div>
                                    
									 	<!--<a href="pages/dashboard.php" class="btn btn-md btn-primary ">Login</a>  -->
                                    <!-- Change this to a button or input when using this as a form -->
									<div class="text-center">
										<button type="submit"  name="submit" class="btn btn_custom">Login</button> 
									</div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="assets/admin/js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="assets/admin/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="assets/admin/js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="assets/admin/js/startmin.js"></script>
		<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
		<script>
		$(function() {
			   $("#admin-login").validate({
				  // Specify the validation rules
					rules: {
						username: "required",
						password: "required"
							
					 },
					messages: {
						username: "Please enter your Username",
						 password:  "Please enter  the Password"
						  
					},
					submitHandler: function(form) {
						form.submit();
					}
				});

			  }); 
  
		</script>

    </body>
</html>
