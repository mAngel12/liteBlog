<?php

class Admin {
    
    public $id = null;
    public $username = null;
    public $password = null;
    
    public function __construct( $data=array() ) {
        if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
        if ( isset( $data['username'] ) ) $this->username = $data['username'];
        if ( isset( $data['password'] ) ) $this->password = md5($data['password']);
    }
    
    public function storeFormValues ( $params ) {
        $this->__construct( $params );
    }
    
    public static function checkIfExist ( $username ) {
        $conn = new PDO( 'mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT id FROM admins WHERE username = :username";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":username", $username, PDO::PARAM_STR );
        $st->execute();
        $user_id = $st->fetchColumn();
        if( $user_id ) {
            return true;
        }
        else {
            return false;
        }
    }
    
    public static function getById( $id ) {
        $conn = new PDO( 'mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM admins WHERE id = :id";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":id", $id, PDO::PARAM_INT );
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ( $row ) return new Admin( $row );
    }

    public static function getList() {
        $conn = new PDO( 'mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM admins";

        $st = $conn->prepare( $sql );
        $st->execute();
        $list = array();
        while ( $row = $st->fetch() ) {
            $admin = new Admin( $row );
            $list[] = $admin;
        }
        $conn = null;
        return ( array ( "results" => $list ));
    }

    public function insert() {
        $conn = new PDO( 'mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD );
        $sql = "INSERT INTO admins ( username, password ) VALUES ( :username, :password )";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":username", $this->username, PDO::PARAM_INT );
        $st->bindValue( ":password", $this->password, PDO::PARAM_STR );
        $st->execute();
        $this->id = $conn->lastInsertId();
        $conn = null;
    }

    public function update() {
        $conn = new PDO( 'mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD );
        $sql = "UPDATE admins SET username=:username, password=:password WHERE id = :id";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":username", $this->username, PDO::PARAM_INT );
        $st->bindValue( ":password", $this->password, PDO::PARAM_STR );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->execute();
        $conn = null;
    }

    public function delete() {
        $conn = new PDO( 'mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD );
        $st = $conn->prepare ( "DELETE FROM admins WHERE id = :id LIMIT 1" );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->execute();
        $conn = null;
    }
}

?>