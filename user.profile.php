<?php 
require('db.php');
include 'class/User.php';
include("auth.php");
//echo $_SESSION['email'];
if (isset($_POST['name'])){
	
	
	$name = stripslashes($_REQUEST['name']);
    //escapes special characters in a string
    $name = mysqli_real_escape_string($con, $name);
	$checkPassword = stripslashes($_REQUEST['checkPassword']);
    //escapes special characters in a string
    $checkPassword = mysqli_real_escape_string($con, $checkPassword);
	$email_address = $_SESSION['email'];
	$user = new User();
	//$email_address = $user->getEmail();
	$user->changeName($checkPassword, $name, $email_address);
	
}
if (isset($_POST['oldpass'])){
	
	$oldpass = stripslashes($_REQUEST['oldpass']);
	$oldpass = mysqli_real_escape_string($con, $oldpass);
	$newpassword2 = stripslashes($_REQUEST['newpassword2']);
	$newpassword2 = mysqli_real_escape_string($con, $newpassword2);
	$email_address = $_SESSION['email'];
	$user = new User();
	//$email_address = $user->getEmail();
	$user->changePassword($newpassword2, $oldpass, $email_address);
}
if (isset($_POST['passwordToDel'])){
	
	$passwordToDel = stripslashes($_REQUEST['passwordToDel']);
	$passwordToDel = mysqli_real_escape_string($con, $passwordToDel);
	$email_address = $_SESSION['email'];
	$user = new User();
	//$email_address = $user->getEmail();
	$user->deleteAccount($passwordToDel, $email_address);
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
	<script src="js/PasswordCheck.js"></script>


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
                        <!-- Navbar Brand --><a href="index.php" class="navbar-brand">
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
                    <h1 class="h4"><?php echo $_SESSION['email']; ?></h1>
                </div>
            </div>
            <!-- Sidebar Navidation Menus-->
            <ul class="list-unstyled">
                <li><a href="user.home.php"><i class="icon-home"></i>Home </a></li>
                <li><a href="user.gallery.php"><i class="icon-grid"></i>Gallery</a></li>
                <li><a href="user.canvas.php"><i class="icon-picture"></i>Canvas</a></li>
                <li class="active"><a href="user.profile.php"><i class="icon-interface-windows"></i>Profile</a></li>
            </ul>
        </nav>
        <div class="content-inner">
            <!-- Page Header-->
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">Profile</h2>
                </div>
            </header>
            <!-- Forms Section-->
            <section class="forms">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-lg-6">
                            <!-- Name-->
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h3 class="h4">Name</h3>
                                </div>
                                <div class="card-body">
                                    <form  method="post">
                                        <div class="form-group">
                                            <label class="form-control-label">Enter Name</label>
                                            <input type="text"  name="name" placeholder="Taslima Koly" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Enter Password</label>
                                            <input type="password" name="checkPassword" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Update" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Delete Account-->
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h3 class="h4">Delete Account</h3>
                                </div>
                                <div class="card-body">
                                    <form name="deletePassword" method="post">>
                                        <div class="form-group">
                                            <label class="form-control-label">Enter Password</label>
                                            <input type="password" name="passwordToDel" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Delete Account" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Password-->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h3 class="h4">Password</h3>
                                </div>
                                <div class="card-body">
                                    <p>Do you want to change your passsword?</p>
                                    <form name="passwordChange" method="post">
                                        <div class="form-group">
                                            <label class="form-control-label">Enter Old Password</label>
                                            <input type="password" name="oldpass" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Enter New Password</label>
                                            <input type="password" name="newpassword1" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Confirm New Password</label>
                                            <input type="password" name="newpassword2" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Update" class="btn btn-primary">
                                        </div>
                                    </form>
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

