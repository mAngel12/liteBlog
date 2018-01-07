<?php include "template/admin/include/header.php" ?>

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row" id="main" >
            <div class="col-sm-12 col-md-12 well" id="content">
                <h1>Dear <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>, Welcome to Admin Panel!</h1></br>
                
                <h4><strong><i class="fa fa-file-code-o"></i> Configuration from config.inc.php:</strong></h4>
                <br/>
                <ul>
                    <li>Your website is called <code class="home-badge"><?php echo WEBSITE_TITLE ?></code>.</li>
                    <li>The description of the site is: <code class="home-badge"><?php echo WEBSITE_DESCRIPTION ?></code>.</li>
                    <li>The keywords are: <code class="home-badge"><?php echo WEBSITE_KEYWORDS ?></code>.</li>
                    <li>The author of the site is: <code class="home-badge"><?php echo WEBSITE_AUTHOR ?></code>.</li>
                    <li>Actual language: <code class="home-badge"><?php echo WEBSITE_LANG ?></code>.</li>
                    <li>In the homepage is displayed <code class="home-badge"><?php echo POSTS_IN_HOMEPAGE ?></code> posts.</li>
                    <li>There is a text in the footer: <code class="home-badge"><?php echo FOOTER_TEXT ?></code>.</li>
                </ul>
            </div>
        </div>
    <!-- /.row -->
    </div>
<!-- /.container-fluid -->
</div>

<?php include "template/admin/include/footer.php" ?>