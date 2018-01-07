<?php

require( "config/config.inc.php" );
require( "model/Admin.php" );
require( "model/Comment.php" );
require( "model/Post.php" );

session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";

if ( $action != "login" && $action != "logout" && !$username ) {
    login();
    exit;
}

switch ( $action ) {
    case 'login':
        login();
        break;
    case 'logout':
        logout();
        break;
    case 'newPost':
        newPost();
        break;
    case 'editPost':
        editPost();
        break;
    case 'deletePost':
        deletePost();
        break;
    case 'listPosts':
        listPosts();
        break;
    case 'listComments':
        listComments();
        break;
    case 'deleteComment':
        deleteComment();
        break;
    case 'newAdmin':
        newAdmin();
        break;
    case 'editAdmin':
        editAdmin();
        break;
    case 'deleteAdmin':
        deleteAdmin();
        break;
    case 'listAdmins':
        listAdmins();
        break;
    default:
        adminWelcome();
        break;
}

function adminWelcome() {
    $results = array();
    $results['pageTitle'] = "Welcome!";
    require( "template/admin/adminWelcome.php" );
}

function login() {
    $results = array();
    $results['pageTitle'] = "Admin Login | ".WEBSITE_TITLE;

    if ( isset( $_POST['login'] ) && isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
        
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        
        $conn = new PDO( 'mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD );
        
        $sql = "SELECT id FROM admins WHERE username = :login AND password = :passwd LIMIT 1";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":login", $username, PDO::PARAM_STR );
        $st->bindValue( ":passwd", $password, PDO::PARAM_STR );
        $st->execute();
        $user_id = $st->fetchColumn();

        if ( $user_id ) {
            $_SESSION['username'] = $username;
            header( "Location: admin.php" );
        } else {
            $results['errorMessage'] = "Incorrect username or password. Please try again.";
            require( "template/admin/loginForm.php" );
        }
    } else {
        require( "template/admin/loginForm.php" );
    }
}

function logout() {
    unset( $_SESSION['username'] );
    header( "Location: admin.php" );
}

function newPost() {
    $results = array();
    $results['pageTitle'] = "New Post";
    $results['formAction'] = "newPost";

    if ( isset( $_POST['saveChanges'] ) ) {
        $post = new Post;
        $post->storeFormValues( $_POST );
        $post->insert();
        header( "Location: admin.php?action=listPosts&status=changesSaved" );
    } elseif ( isset( $_POST['cancel'] ) ) {
        header( "Location: admin.php?action=listPosts" );
    } else {
        $results['post'] = new Post;
        require( "template/admin/editPost.php" );
    }
}

function editPost() {
    $results = array();
    $results['pageTitle'] = "Edit Post";
    $results['formAction'] = "editPost";
    
    if ( isset( $_POST['saveChanges'] ) ) {
        if ( !$post = Post::getById( (int)$_POST['postId'] ) ) {
          header( "Location: admin.php?action=listPosts&error=postNotFound" );
          return;
        }
        $post->storeFormValues( $_POST );
        $post->update();
        header( "Location: admin.php?action=listPosts&status=changesSaved" );
    } elseif ( isset( $_POST['cancel'] ) ) {
        header( "Location: admin.php?action=listPosts" );
    } else {
        $results['post'] = Post::getById( (int)$_GET['postId'] );
        require( "template/admin/editPost.php" );
    }
}

function deletePost() {
    if ( !$post = Post::getById( (int)$_GET['postId'] ) ) {
        header( "Location: admin.php?action=listPosts&error=postNotFound" );
        return;
    }

    $post->delete();
    header( "Location: admin.php?action=listPosts&status=postDeleted" );
}

function listPosts() {
    $results = array();
    $data = Post::getList();
    $results['posts'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "All Posts";

    if ( isset( $_GET['error'] ) ) {
        if ( $_GET['error'] == "postNotFound" ) $results['errorMessage'] = "Post not found!";
    }

    if ( isset( $_GET['status'] ) ) {
        if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved!";
        if ( $_GET['status'] == "postDeleted" ) $results['statusMessage'] = "Post deleted!";
    }

    require( "template/admin/listPosts.php" );
}

function listComments() {
    $results = array();
    $data = Comment::getList();
    $results['comments'] = $data['results'];
    $results['pageTitle'] = "List of Comments";

    if ( isset( $_GET['error'] ) ) {
        if ( $_GET['error'] == "postNotFound" ) $results['errorMessage'] = "Comment not found!";
    }

    if ( isset( $_GET['status'] ) ) {
        if ( $_GET['status'] == "commentDeleted" ) $results['statusMessage'] = "Comment deleted!";
    }

    require( "template/admin/listComments.php" );
}

function deleteComment() {
    if ( !$comment = Comment::getById( (int)$_GET['commentId'] ) ) {
        header( "Location: admin.php?action=listComments&error=commentNotFound" );
        return;
    }

    $comment->delete();
    header( "Location: admin.php?action=listComments&status=commentDeleted" );
}

function newAdmin() {
    $results = array();
    $results['pageTitle'] = "New Admin";
    $results['formAction'] = "newAdmin";

    if ( isset( $_POST['saveChanges'] ) ) {
        if ( !Admin::checkIfExist($_POST['username']) ) {
            $admin = new Admin;
            $admin->storeFormValues( $_POST );
            $admin->insert();
            header( "Location: admin.php?action=listAdmins&status=changesSaved" );
        }
        else {
            header( "Location: admin.php?action=listAdmins&error=userExist" );
        }
    } elseif ( isset( $_POST['cancel'] ) ) {
        header( "Location: admin.php?action=listAdmin" );
    } else {
        $results['admin'] = new Admin;
        require( "template/admin/editAdmin.php" );
    }
}

function editAdmin() {
    $results = array();
    $results['pageTitle'] = "Edit Admin";
    $results['formAction'] = "editAdmin";
    
    if ( isset( $_POST['saveChanges'] ) ) {
        if ( !$admin = Admin::getById( (int)$_POST['adminId'] ) ) {
            header( "Location: admin.php?action=listAdmins&error=postNotFound" );
            return;
        }
        $admin->storeFormValues( $_POST );
        $admin->update();
        header( "Location: admin.php?action=listAdmins&status=changesSaved" );
    } elseif ( isset( $_POST['cancel'] ) ) {
        header( "Location: admin.php?action=listAdmins" );
    } else {
        $results['admin'] = Admin::getById( (int)$_GET['adminId'] );
        require( "template/admin/editAdmin.php" );
    }
}

function deleteAdmin() {
    if ( !$admin = Admin::getById( (int)$_GET['adminId'] ) ) {
        header( "Location: admin.php?action=listAdmins&error=adminNotFound" );
        return;
    }

    $admin->delete();
    header( "Location: admin.php?action=listAdmins&status=adminDeleted" );
}

function listAdmins() {
    $results = array();
    $data = Admin::getList();
    $results['admins'] = $data['results'];
    $results['pageTitle'] = "All Admins";

    if ( isset( $_GET['error'] ) ) {
        if ( $_GET['error'] == "adminNotFound" ) $results['errorMessage'] = "Admin not found!";
        if ( $_GET['error'] == "userExist" ) $results['errorMessage'] = "Admin with this username exist! It is unable to save changes!";
    }

    if ( isset( $_GET['status'] ) ) {
        if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved!";
        if ( $_GET['status'] == "adminDeleted" ) $results['statusMessage'] = "Admin deleted!";
    }

    require( "template/admin/listAdmins.php" );
}

?>
