<?php

class Comment {
    
    public $id = null;
    public $username = null;
    public $content = null;
    public $postId = null;
    
    public function __construct( $data=array() ) {
        if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
        if ( isset( $data['username'] ) ) $this->username = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['username'] );
        if ( isset( $data['content'] ) ) $this->content = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['content'] );
        if ( isset( $data['postId'] ) ) $this->postId = (int) $data['postId'];
    }
    
    public function storeFormValues ( $params ) {
        $this->__construct( $params );
    }
    
    public static function getById( $id ) {
        $conn = new PDO( 'mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM comments WHERE id = :id";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":id", $id, PDO::PARAM_INT );
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ( $row ) return new Comment( $row );
    }
    
    public static function getPostName( $postId ) {
        $conn = new PDO( 'mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT title FROM posts WHERE id = :id";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":id", $postId, PDO::PARAM_INT );
        $st->execute();
        $row = $st->fetchColumn();
        $conn = null;
        if ( $row ) return $row;
    }
    
    public static function getList() {
        $conn = new PDO( 'mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM comments";

        $st = $conn->prepare( $sql );
        $st->execute();
        $list = array();
        while ( $row = $st->fetch() ) {
            $comment = new Comment( $row );
            $list[] = $comment;
        }
        $conn = null;
        return ( array ( "results" => $list ));
    }
    
    public static function getListByPostId( $postId ) {
        $conn = new PDO( 'mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM comments
            WHERE postId = :postId ORDER BY id DESC";

        $st = $conn->prepare( $sql );
        $st->bindValue( ":postId", $postId, PDO::PARAM_INT );
        $st->execute();
        $list = array();

        while ( $row = $st->fetch() ) {
            $comment = new Comment( $row );
            $list[] = $comment;
        }

        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query( $sql )->fetch();
        $conn = null;
        return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    }

    public function insert() {
        $conn = new PDO( 'mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD );
        $sql = "INSERT INTO comments ( username, content, postId ) VALUES ( :username, :content, :postId )";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":username", $this->username, PDO::PARAM_STR );
        $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
        $st->bindValue( ":postId", $this->postId, PDO::PARAM_INT );
        $st->execute();
        $this->id = $conn->lastInsertId();
        $conn = null;
    }

    public function delete() {
        $conn = new PDO( 'mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD );
        $st = $conn->prepare ( "DELETE FROM comments WHERE id = :id LIMIT 1" );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->execute();
        $conn = null;
    } 
}

?>