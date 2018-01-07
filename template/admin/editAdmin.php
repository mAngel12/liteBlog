<?php include "template/admin/include/header.php" ?>

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row" id="main" >
            <div class="col-sm-12 col-md-12 well" id="content">
                <div class="generic-container">
                    <div class="well lead">
                        <?php echo $results['pageTitle']?>
                    </div>
                    
                    <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
                        <input type="hidden" name="adminId" value="<?php echo $results['admin']->id ?>"/>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="username">Username</label>
                                <div class="col-md-7">
                                    <input type="text" name="username" id="username" class="form-control input-sm" required maxlength="255" value="<?php echo htmlspecialchars( $results['admin']->username )?>" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="password">Password</label>
                                <div class="col-md-7">
                                    <input type="password" name="password" id="password" class="form-control input-sm" required maxlength="255" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="well">
                            <div class="row">
                                <div class="form-actions floatRight">
                                    <input class="btn btn-success btn-sm" type="submit" name="saveChanges" value="Save" />
                                    <input class="btn btn-primary btn-sm" type="submit" formnovalidate name="cancel" value="Cancel" />
                                    <?php if ( $results['admin']->id ) { ?>
                                        <a class="btn btn-danger btn-sm" href="admin.php?action=deleteAdmin&amp;adminId=<?php echo $results['admin']->id ?>" onclick="return confirm('Do you want to delete this user?')">Delete Admin</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- /.row -->
    </div>
<!-- /.container-fluid -->
</div>

<?php include "template/admin/include/footer.php" ?>