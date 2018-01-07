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
                        <input type="hidden" name="postId" value="<?php echo $results['post']->id ?>"/>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="title">Title</label>
                                <div class="col-md-7">
                                    <input type="text" name="title" id="title" class="form-control input-sm" required maxlength="255" value="<?php echo htmlspecialchars( $results['post']->title )?>" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="date">Date</label>
                                <div class="col-md-7">
                                    <input type="date" name="publicationDate" id="publicationDate" class="form-control input-sm" required maxlength="10" value="<?php echo $results['post']->publicationDate ? date( "Y-m-d", $results['post']->publicationDate ) : "" ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="content">Summary</label>
                                <div class="col-md-7">
                                    <textarea name="summary" id="summary" class="form-control input-sm" rows="6" required maxlength="1000"><?php echo htmlspecialchars( $results['post']->summary )?></textarea>
                                </div>
                            </div>
                        </div>

                       <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-md-3 control-lable" for="content">Summary</label>
                                <div class="col-md-7">
                                    <textarea name="content" id="content" class="form-control input-sm" rows="12" required maxlength="100000"><?php echo htmlspecialchars( $results['post']->content )?></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="well">
                            <div class="row">
                                <div class="form-actions floatRight">
                                    <input class="btn btn-success btn-sm" type="submit" name="saveChanges" value="Save" />
                                    <input class="btn btn-primary btn-sm" type="submit" formnovalidate name="cancel" value="Cancel" />
                                    <?php if ( $results['post']->id ) { ?>
                                        <a class="btn btn-danger btn-sm" href="admin.php?action=deletePost&amp;postId=<?php echo $results['post']->id ?>" onclick="return confirm('Do you want to delete this post?')">Delete Post</a>
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

