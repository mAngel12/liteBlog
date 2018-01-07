<!DOCTYPE html>
<html>
    <head>
        <title><?php echo htmlspecialchars( $results['pageTitle'] )?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="template/css/login.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="wrapper">
                <form action="admin.php?action=login" method="post" class="form-signin">
                    <input type="hidden" name="login" value="true" />
                    <h2 class="form-signin-heading">Admin Panel Login</h2>
                    <?php if ( isset( $results['errorMessage'] ) ) { ?>
                        <div class="alert alert-danger">
                            <p><?php echo $results['errorMessage'] ?></p>
                        </div>
                    <?php } ?>

                    <hr class="style">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required autofocus="" maxlength="20"/>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required maxlength="20"/>
                    <button class="btn btn-lg btn-primary btn-block"  name="login" value="Login" type="submit" >Login</button>
                </form>			
            </div>
        </div>
    </body>
</html>