<?php

require( "config/config.inc.php" );
require( "model/Comment.php" );
require( "model/Post.php" );

$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

switch ( $action ) {
    case 'archive':
        archive();
        break;
    case 'viewPost':
        viewPost();
        break;
    default:
        homepage();
        break;
}

function archive() {
    $results = array();
    $data = Post::getList();
    $results['posts'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "Post Archive | ".WEBSITE_TITLE;
    require( "template/archive.php" );
}

function viewPost() {
    if ( !isset($_GET["postId"]) || !$_GET["postId"] ) {
        homepage();
        return;
    }
    
    if ( isset( $_POST['addComment'] ) ) {
        $comment = new Comment;
        $comment->storeFormValues( $_POST );
        $comment->insert();
        header( "Location: ?action=viewPost&postId=".$_GET["postId"]);
    }

    $results = array();
    $results['post'] = Post::getById( (int)$_GET["postId"] );
    $data = Comment::getListByPostId( (int)$_GET["postId"] );
    $results['comments'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = $results['post']->title . " | ".WEBSITE_TITLE;
    require( "template/viewPost.php" );
}

function homepage() {
    $results = array();
    $data = Post::getList( POSTS_IN_HOMEPAGE );
    $results['posts'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = WEBSITE_TITLE;
    require( "template/homepage.php" );
}

?>
