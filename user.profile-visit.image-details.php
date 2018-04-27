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
    <link rel="stylesheet" href="css/profile-card.css">
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
            <!-- Sidebar Navidation Menus-->
            <ul class="list-unstyled">
                <li><a href="user.home.php"><i class="icon-home"></i>Back to Home </a></li>

                <div class="container wrap">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="well well-sm jumbotron">
                                <h4>Abraham Lincoln</h4>
                                <p>
                                    Drawings : 25
                                    <br/>
                                    Likes: 120
                                </p>
                                <button class="btn btn-secondary btn-block">Report User</button>
                                <button class="btn btn-secondary btn-block" onclick="location.href='user.profile-visit.php'">View Gallery</button>
                            </div>
                        </div>
                    </div>
                </div>
            </ul>
        </nav>
        <div class="content-inner">
            <!-- Page Header-->


            <div class="page-content">
                <div class="container">
                    <div class="pp-section pp-container-readable" style="background-color: white">
                        <div class="pp-post"><a class="h3" href="blog-post.html">Image Title</a>
                            <div class="pp-post-meta mt-2">
                                <ul>
                                    <li><i class="fa fa-calendar-check-o"
                                           aria-hidden="true"></i><span>November 04, 2017</span>
                                    </li>
                                    <li><i class="fa fa-comments" aria-hidden="true"></i><a
                                            href="#pp-comment">Comments</a></li>
                                    <li><i class="fa fa-thumbs-up"></i><a data-toggle="modal" data-target="#myModal"
                                                                          href="">45</a></li>
                                </ul>
                            </div>
                            <img class="img-fluid mt-3" src="images/blog-4.jpg" alt="Blog Image"/>
                            <br/><br/>
                            <button type="button" class="btn btn-default btn-lg">
                                <i class="fa fa-thumbs-up"></i> Like
                            </button>
                        </div>

                        <!--people who likes it modal-->
                        <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true" class="modal fade text-left">
                            <div role="document" class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 id="exampleModalLabel" class="modal-title">People who liked</h4>
                                        <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                                            <span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">Cras justo odio</li>
                                            <li class="list-group-item">Dapibus ac facilisis in</li>
                                            <li class="list-group-item">Morbi leo risus</li>
                                            <li class="list-group-item">Porta ac consectetur ac</li>
                                            <li class="list-group-item">Vestibulum at eros</li>
                                            <li class="list-group-item">Cras justo odio</li>
                                            <li class="list-group-item">Dapibus ac facilisis in</li>
                                            <li class="list-group-item">Morbi leo risus</li>
                                            <li class="list-group-item">Porta ac consectetur ac</li>
                                            <li class="list-group-item">Vestibulum at eros</li>
                                            <li class="list-group-item">Cras justo odio</li>
                                            <li class="list-group-item">Dapibus ac facilisis in</li>
                                            <li class="list-group-item">Morbi leo risus</li>
                                            <li class="list-group-item">Porta ac consectetur ac</li>
                                            <li class="list-group-item">Vestibulum at eros</li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="pp-blog-details">
                            <div class="pp-comments" id="pp-comment">
                                <div class="h2">Comments</div>
                                <div class="media"><img class="img-fluid mr-3" src="img/profile.png" alt="Image"/>
                                    <div class="media-body">
                                        <div class="h5 mt-0">Tamim Iqbal</div>
                                        <p class="text-muted">Nov 23, 2017 11:45am</p>
                                        <p>I love this</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pp-section"></div>
                        <div class="row" id="pp-drop-comment">
                            <div class="col">
                                <div class="h4 mb-3">Drop a Comment</div>
                                <form action="" method="POST">
                                    <div class="row mb-3">
                                        <div class="col">
                                    <textarea class="form-control" type="text" name="message"
                                              placeholder="*Your Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <button class="btn btn-primary" type="submit">Post Comment</button>
                                        </div>
                                    </div>
                                    <br/>
                                </form>
                            </div>
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
<script src="vendor/popper.js/umd/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/jquery.cookie/jquery.cookie.js"></script>
<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
<!-- Main File-->
<script src="js/user/front.js"></script>

</body>
</html>