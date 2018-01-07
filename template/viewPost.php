<?php include "template/include/header.php" ?>

<div class="col-sm-9">
    
    <h1><?php echo htmlspecialchars( $results['post']->title )?></h1>
    <h5><span class="glyphicon glyphicon-time"></span> Published on <?php echo date('j F Y', $results['post']->publicationDate)?>.</h5>
    <p style="font-style: italic;"><?php echo htmlspecialchars( $results['post']->summary )?></p>
    <p><?php echo $results['post']->content?></p>
    <br><hr><br>
    
    <h4><span class="glyphicon glyphicon-comment"></span> Leave a Comment:</h4><br/>

        <form action="?action=viewPost&postId=<?php echo htmlspecialchars( $results['post']->id )?>" method="post">
        <input type="hidden" name="postId" value="<?php echo $results['post']->id ?>"/>
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable" for="username">Your Name: </label>
                    <div class="col-md-7">
                        <input type="text" name="username" id="username" class="form-control input-sm" required maxlength="100" value="">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable" for="content">Your Comment: </label>
                    <div class="col-md-7">
                        <textarea rows="12" name="content" id="content" class="form-control input-sm" required maxlength="100000"></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label class="col-md-3 control-lable" for="content">Captha: </label>
                    <div class="col-md-7">
                        <p id="operation"/></p>
                        <p><input type="number" id="answer" class="form-control input-sm" value="1" min="1" max="10"/></p>
                        <p><input type="button" id="capthaButton" value="Check Captha!" class="btn btn-primary btn-block" /></p>
                    </div>
                </div>
            </div>

            <div class="form-actions floatRight">
                <input id="addComment" name="addComment" type="submit" value="Add Comment" class="btn btn-success" disabled = "true"/>
            </div>
        </form>
        <br><br>

        <p><span class="badge"><?php echo $results['totalRows']?></span> Comments:</p><br>

        <div class="row">
            <?php foreach ( $results['comments'] as $comment ) { ?>
                <div class="col-sm-12">
                    <h4><span class="glyphicon glyphicon-hand-right" ></span> <?php echo $comment->username?> </h4>
                <p>
                    <?php echo $comment->content?>
                </p>
                <br>
            </div>
            <?php } ?>
        </div>
    
<?php include "template/include/footer.php" ?>