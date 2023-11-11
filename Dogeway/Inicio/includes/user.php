<?php

include_once 'db.php';

class User extends DB{

    private $nombre;
    private $username;

    public function userExists($user, $pass) {
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE nickname = :user AND pass = :pass');
        $query->execute(['user' => $user, 'pass' => $pass]);
    
        if ($query->rowCount()) {
            $userData = $query->fetch(PDO::FETCH_ASSOC);
            if ($userData['verificado'] == 1) {
                // El usuario está verificado
                return true;
            } else {
                // El usuario no está verificado
                return "nover";
            }
        } else {
            // El usuario no existe
            return false;
        }
    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE nickname = :user');
        $query->execute(['user' => $user]);

        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['nombre'];
            $this->username = $currentUser['nickname'];
            $this->userId = $currentUser['id'];
        }
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getusername(){
        return $this->username;
    }

    public function getuserId(){
        return $this->userId;
    }
}

?>