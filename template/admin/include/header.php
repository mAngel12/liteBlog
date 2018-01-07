<html>
    <head>
	<title><?php echo "Admin Panel - ".WEBSITE_TITLE." - ".htmlspecialchars( $results['pageTitle'] )?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="template/css/admin.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="template/js/admin.js"></script>
    </head>
<body>
    
<div id="throbber" style="display:none; min-height:120px;"></div>
<div id="noty-holder"></div>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="admin.php">
                <h3><b><?php echo "Admin Panel - ".WEBSITE_TITLE ?></b></h3>
            </a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">     
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo htmlspecialchars( $_SESSION['username']) ?> <b class="fa fa-angle-down"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="admin.php?action=logout"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="index.php"><i class="fa fa-fw fa-globe"></i> Go to Homepage</a>
                </li>
                <li>
                    <a data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-fw fa-newspaper-o"></i> Posts<i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-1" class="collapse">
                        <li><a href="admin.php?action=listPosts"><i class="fa fa-angle-double-right"></i> Posts List</a></li>
                        <li><a href="admin.php?action=newPost"><i class="fa fa-angle-double-right"></i> Add Post</a></li>
                        <li><a href="admin.php?action=listComments"><i class="fa fa-angle-double-right"></i> List of Comments</a></li>
                    </ul>
                </li>
                <li>
                    <a data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-fw fa-newspaper-o"></i> Administrators<i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-2" class="collapse">
                        <li><a href="admin.php?action=listAdmins"><i class="fa fa-angle-double-right"></i> Admin List</a></li>
                        <li><a href="admin.php?action=newAdmin"><i class="fa fa-angle-double-right"></i> Add Admin</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
