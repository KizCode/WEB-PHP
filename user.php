<?php

class User {
    private $conn;
    private $table_name ="user";

    public $id_user;
    public $name;
    public $username;
    public $email;
    private $password;
    public $role_id;
    public $gambar;

    public function __construct($db, $id_user=null, $name=null, $username=null, $email=null, $password=null, $role_id=2, $gambar="default.jpg"){
        $this->conn = $db;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role_id = $role_id;
        $this->gambar = $gambar;

    }

    public function create(){
        $query =  " INSERT INTO " . $this->table_name . "SET id_user:id_user, name:name, username:username, email:email, password:password, role_id:role_id, gambar:gambar";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam[":Id_user . $this->id_user"];
        $stmt->bindParam[":name . $this->name"];
        $stmt->bindParam[":username . $this->username"];
        $stmt->bindParam[":email . $this->email"];
        $stmt->bindParam[":email  . $this->email"];
        $stmt->bindParam[":email . $this->email"];
    }
}
