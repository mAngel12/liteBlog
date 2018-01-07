<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo WEBSITE_TITLE." - ".htmlspecialchars( $results['pageTitle'] )?></title>
    <meta name="Description" content="<?php echo WEBSITE_DESCRIPTION ?>" />
    <meta name="Keywords" content="<?php echo WEBSITE_KEYWORDS ?>" />
    <meta http-equiv="Content-Language" content="<?php echo WEBSITE_LANG ?>" />
    <meta name="Author" content="<?php echo WEBSITE_AUTHOR ?>" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="template/css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="template/js/captha.js"></script>

</head>
<body>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav">
            <h3><a href="index.php"><?php echo htmlspecialchars( $results['pageTitle'] )?></a></h3>
            <hr class="hr-special-style">
            <ul class="nav nav-pills nav-stacked">
              <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
              <li><a href="?action=archive"><span class="glyphicon glyphicon-book"></span> Archive</a></li>
              <li><a href="admin.php"><span class="glyphicon glyphicon-log-in"></span> Admin Panel</a></li>
            </ul><br>
        </div>