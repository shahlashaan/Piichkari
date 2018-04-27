<?php

require('db.php');
include("auth.php");
include 'class/Admin.php';


	$con = mysqli_connect("localhost","root","") or die(mysqli_error());
	$db = mysqli_select_db($con, 'piichkari') or die(mysqli_error($con));
	$sql = "SELECT * FROM report";
	$record = mysqli_query($con, $sql); 
	
	if(isset($_POST['ban'])){
	if (isset($_POST['reportedEmail'])){
	
	
	$email = stripslashes($_REQUEST['reportedEmail']);
    //escapes special characters in a string
    $email = mysqli_real_escape_string($con, $email);
	$admin = new Admin();
	//$email_address = $user->getEmail();
	$row = $admin->checkUser($email);
	echo $row;
	
	if($row>0){
		$admin->banUser($email);
	}
	}
}
	
	
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Piichkari</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="vendor/fonts/sans.css">
    <link rel="stylesheet" href="vendor/fonts/merriweather.css">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/fontastic.css">
    <link rel="stylesheet" href="css/user.default.css">



</head>
<body>
<div class="page">
    <!-- Main Navbar-->
    <header class="header">
        <nav class="navbar">
            <!-- Search Box-->
            <div class="search-box">
                <button class="dismiss"><i class="icon-close"></i></button>
                <form id="searchForm" action="#" role="search">
                    <input type="search" placeholder="Search for users..." class="form-control">
                </form>
            </div>
            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <!-- Navbar Header-->
                    <div class="navbar-header">
                        <!-- Navbar Brand --><a href="index.html" class="navbar-brand">
                        <div class="brand-text brand-big"><span>Piichkari </span><strong>Logo</strong></div>
                        <div class="brand-text brand-small"><strong>Logo</strong></div></a>
                        <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                    </div>
                    <!-- Navbar Menu -->
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <!-- Search-->
                        <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>
                        <!-- Logout    -->
                        <li class="nav-item"><a href="logout.php" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <nav class="side-navbar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center">
                <div class="avatar"><img src="img/profile.png" alt="..." class="img-fluid rounded-circle"></div>
                <div class="title">
                    <h1 class="h4">Admin babaji</h1>
                </div>
            </div>
            <!-- Sidebar Navidation Menus-->
            <ul class="list-unstyled">
                <li class="active"><a href="admin.home.php"><i class="icon-home"></i>Home </a></li>
                <li><a href="user.gallery.php"><i class="icon-grid"></i>Gallery</a></li>
                <li><a href="user.canvas.php"><i class="icon-picture"></i>Canvas</a></li>
                <li><a href="user.profile.php"><i class="icon-interface-windows"></i>Profile</a></li>
            </ul>
        </nav>
        <div class="content-inner">
            <!-- Page Header-->
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">Admin Dashboard</h2>
                </div>
            </header>

            <section class="tables">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h3 class="h4">User Reports</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Reported User</th>
                                                <th>Reported By</th>
                                                <th>Reason</th>
                                                <th>Options</th>
                                            </tr>
                                            </thead>
                                            <tbody>
											<?php
											
											while($ban = mysqli_fetch_assoc($record)){
                                                $bttn='<tr>
												<form method="post">
												<th scope="row">'.$ban['report_id'].'</th>
                                                <td>'.$ban['reported_person'].'</td>
                                                <td>'.$ban['personwho_reported'].'</td>
                                                <td>'.$ban['reason'].'</td>
                                                <td>
												
												<input type="submit" class="btn btn-secondary" name="profile" value="Profile">
                                                <input type="submit" class="btn btn-secondary" name="ban" value="Ban">
                                                <input type="submit" class="btn btn-secondary" name="discard" value="Discard">
												<input type="hidden" name="reportedEmail" value="'.$ban['email_address'].'">
												</td>
                                            </form>
											</tr>';
											echo $bttn;}
											?>	
								
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <footer class="main-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <p>Paint Your Dreams</p>
                        </div>
                        <div class="col-sm-6 text-right">
                            <p>Design by Piichkari</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>
<!-- Javascript files-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper.js/umd/popper.min.js"> </script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="vendor/jquery-validation/jquery.validate.min.js"></script>

<!-- Main File-->
<script src="js/user/front.js"></script>
</body>
</html>
