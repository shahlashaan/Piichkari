<?php 
require('db.php');
include("auth.php");

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
    <link rel="stylesheet" href="css/gallery.css">
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
                        <li class="nav-item"><a href="index.php" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
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
                    <h1 class="h4"><?php echo $_SESSION['name']; ?></h1>
                </div>
            </div>
            <!-- Sidebar Navidation Menus-->
            <ul class="list-unstyled">
                <li><a href="user.home.php"><i class="icon-home"></i>Home </a></li>
                <li class="active"><a href="user.gallery.php"><i class="icon-grid"></i>Gallery</a></li>
                <li><a href="user.canvas.php"><i class="icon-picture"></i>Canvas</a></li>
                <li><a href="user.profile.php"><i class="icon-interface-windows"></i>Profile</a></li>
            </ul>
        </nav>
        <div class="content-inner">
            <!-- Page Header-->
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">Gallery</h2>
                </div>
            </header>


            <div class="page-content">
                <div class="container">
                    <div class="container px-6">
                        <div class="pp-gallery">
                            <div class="card-columns">
                                <div class="card"><a href="user.gallery.image-details.php">
                                    <figure class="pp-effect"><img class="img-fluid" src="images/1-nature.jpg" alt="Nature"/>
                                        <figcaption>
                                            <div class="h4">Forest</div>
                                        </figcaption>
                                    </figure>
                                </a></div>
                                <div class="card"><a href="user.gallery.image-details.php">
                                    <figure class="pp-effect"><img class="img-fluid" src="images/2-nature.jpg" alt="Nature"/>
                                        <figcaption>
                                            <div class="h4">Bird</div>
                                        </figcaption>
                                    </figure>
                                </a></div>
                                <div class="card"><a href="user.gallery.image-details.php">
                                    <figure class="pp-effect"><img class="img-fluid" src="images/4-nature.jpg" alt="Nature"/>
                                        <figcaption>
                                            <div class="h4">Sunrise</div>
                                        </figcaption>
                                    </figure>
                                </a></div>
                                <div class="card"><a href="user.gallery.image-details.php">
                                    <figure class="pp-effect"><img class="img-fluid" src="images/5-nature.jpg" alt="Nature"/>
                                        <figcaption>
                                            <div class="h4">Greenery</div>
                                        </figcaption>
                                    </figure>
                                </a></div>
                                <div class="card"><a href="user.gallery.image-details.php">
                                    <figure class="pp-effect"><img class="img-fluid" src="images/8-nature.jpg" alt="Nature"/>
                                        <figcaption>
                                            <div class="h4">Bird</div>
                                        </figcaption>
                                    </figure>
                                </a></div>
                                <div class="card"><a href="user.gallery.image-details.php">
                                    <figure class="pp-effect"><img class="img-fluid" src="images/9-nature.jpg" alt="Nature"/>
                                        <figcaption>
                                            <div class="h4">Flower</div>
                                        </figcaption>
                                    </figure>
                                </a></div>
                            </div>
                        </div>
                    </div>
                    <div class="pp-section"></div>
                </div>
            </div>
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