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
    <link rel="stylesheet" href="css/canvas.css">
    <link rel="stylesheet" type="text/css" media="all" href="vendor/jquery/jquery.minicolors.css">

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
                        <div class="brand-text brand-small"><strong>Logo</strong></div>
                    </a>
                        <!-- Toggle Button--><a id="toggle-btn" href="#"
                                                class="menu-btn active"><span></span><span></span><span></span></a>
                    </div>
                    <!-- Navbar Menu -->
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <!-- Search-->
                        <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i
                                class="icon-search"></i></a></li>
                        <!-- Logout    -->
                        <li class="nav-item"><a href="logout.php" class="nav-link logout">Logout<i
                                class="fa fa-sign-out"></i></a></li>
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
                <li class="active"><a href="user.canvas.php"><i class="icon-picture"></i>Canvas</a></li>
                <li><a href="user.profile.php"><i class="icon-interface-windows"></i>Profile</a></li>
            </ul>
        </nav>
        <div class="content-inner">
            <!-- Page Header-->
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">Canvas</h2>
                </div>
            </header>
            <div class="page-content">
                <!-- Main canvas-->
                <div class="row">
                    <div class="col-lg-9">
                        <div id="canvas-pad" class="container">
                            <div style="padding-top: 15px;">
                                <canvas style="height: 440px; width: 790px; border-style: groove; border-width: 10px;"></canvas>
                                <button class="btn btn-secondary float-left" id="undoCanvas">Undo</button>
                                <button class="btn btn-secondary" id="clearCanvas" style="margin-left: 5px">Clear
                                </button>
                                <button type="button" class="btn btn-secondary dropdown-toggle float-right"
                                        data-toggle="dropdown">
                                    Download
                                </button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item" id="savePNG">PNG</button>
                                    <button class="dropdown-item" id="saveJPG">JPG</button>
                                </div>
                                <form style="display: inline;" class="float-right form-inline">
                                    <input class="mr-2 form-control" style=" border:1px solid black;" id="imageTitle" type="text" required placeholder="Give a Title">
                                    <button type="submit" class="btn btn-secondary float-right" style="margin-right: 5px">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--canvas controller-->
                    <div class="container-fluid col-lg-3" style="padding-top: 15px;">
                        <div class="jumbotron">
                            <button class="btn-block" id="inlinecolors" data-inline="true" value="#000"></button>
                            <hr/>
                            <button class="btn btn-primary bouton-image btn-block brushBouton" onclick="brush()"
                                    id="brushButton">Brush
                            </button>
                            <button class="btn btn-primary bouton-image btn-block eraserBouton" onclick="eraser()"
                                    id="eraserButton">Eraser
                            </button>
                            <hr/>
                            <button type="button" class="btn btn-block btn-primary dropdown-toggle"
                                    data-toggle="dropdown">
                                <p id="sizeText" style="display: inline;">Medium</p>
                            </button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item" onclick="smallSize()">Small</button>
                                <button class="dropdown-item" onclick="mediumSize()">Medium</button>
                                <button class="dropdown-item" onclick="largeSize()">Large</button>
                            </div>
                        </div>
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
    <script type="text/javascript" src="vendor/jquery/jquery.minicolors.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/canvas_pad.js"></script>
    <script src="js/canvas_app.js"></script>

    <!-- Main File-->
    <script src="js/user/front.js"></script>
    <script src="vendor/sweet-alert/sweetalert.min.js"></script>
</body>
</html>