<?php

include_once 'db.php';

class User extends DB{

    private $nombre;
    private $username;

    public function userExists($user, $pass){

        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE nickname = :user AND pass = :pass AND verificado = 1');
        $query->execute(['user' => $user, 'pass' => $pass]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE nickname = :user');
        $query->execute(['user' => $user]);

        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['nombre'];
            $this->username = $currentUser['nickname'];
        }
    }

    public function getNombre(){
        return $this->nombre;
    }
}

?>