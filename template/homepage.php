<?php include "template/include/header.php" ?>

<div class="col-sm-9">
    <h4><small>RECENT POSTS</small></h4>
    <hr>
    
<?php foreach ( $results['posts'] as $post ) { ?>
    
    <h2><?php echo htmlspecialchars( $post->title )?></h2>
    <h5><span class="glyphicon glyphicon-time"></span> Published on <?php echo date('j F Y', $post->publicationDate)?>.</h5>
    <p><?php echo htmlspecialchars( $post->summary )?></p>
    <div class="mainbutton" >
        <a class="btn btn-default" role="button" href=".?action=viewPost&amp;postId=<?php echo $post->id?>" >Read More</a>
    </div>
    <br><hr><br>
    
<?php } ?>

<?php include "template/include/footer.php" ?>