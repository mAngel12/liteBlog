<?php include "template/admin/include/header.php" ?>

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row" id="main" >
            <div class="col-sm-12 col-md-12 well" id="content" >
                
                <?php if ( isset( $results['errorMessage'] ) ) { ?>
                    <div class="alert alert-danger">
                        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
                    </div>
                <?php } ?>
            
                <?php if ( isset( $results['statusMessage'] ) ) { ?>
                    <div class="alert alert-success">
                        <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
                    </div>
                <?php } ?>
                
                <div class="generic-container">
                    <div class="panel panel-default">
                        <div class="panel-heading"><span class="lead">List of Posts </span></div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th width="100"></th>
                                <th width="100"></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ( $results['posts'] as $post ) { ?>
                                <tr>
                                    <td><?php echo $post->title?></td>
                                    <td><?php echo date('j M Y', $post->publicationDate)?></td>
                                    <td><a href="admin.php?action=editPost&amp;postId=<?php echo $post->id?>" class="btn btn-success custom-width">edit</a></td>
                                    <td><a href="admin.php?action=deletePost&amp;postId=<?php echo $post->id?>" class="btn btn-danger custom-width">delete</a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="well">
                        <a href="admin.php?action=newPost">Add New Post</a>
                    </div>
                </div>
            </div>
        </div>
    <!-- /.row -->
    </div>
<!-- /.container-fluid -->
</div>

<?php include "template/admin/include/footer.php" ?>

