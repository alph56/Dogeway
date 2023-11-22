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
                $this->updateUserStatus($userData['id'], 'Disponible');
                return true;
            } else if($userData['verificado'] == 2) {
                // El usuario está suspendido
                $this->updateUserStatus($userData['id'], 'Suspendido');
                return "sus";
            }else {
                // El usuario no está verificado
                return "nover";
            }
        } else {
            // El usuario no existe
            return false;
        }
    }

    private function updateUserStatus($userId, $status) {
        $query = $this->connect()->prepare('UPDATE usuario SET status = :status WHERE id = :id');
        $query->execute(['status' => $status, 'id' => $userId]);
        
    }

    public function statusUserStatus($userId, $status) {
        $query = $this->connect()->prepare('UPDATE usuario SET status = :status WHERE id = :id');
        $query->execute(['status' => $status, 'id' => $userId]);
       
    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE nickname = :user');
        $query->execute(['user' => $user]);

        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['nombre'];
            $this->apellidos= $currentUser['apellidos'];
            $this->username = $currentUser['nickname'];
            $this->fotografia = $currentUser['fotografia'];
            $this->UniqueId = $currentUser['unique_id'];
            $this->userId = $currentUser['id'];
            $this->useremail = $currentUser['email'];
            $this->usertel = $currentUser['telefono'];
            $this->usermun = $currentUser['municipio'];
        }
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function getusername(){
        return $this->username;
    }

    public function getuserId(){
        return $this->userId;
    }

    public function getUniqueId(){
        return $this->UniqueId;
    }

    public function getFotografia(){
        return $this->fotografia;
    }
    public function getuseremail(){
        return $this->useremail;
    }

    public function getusertel(){
        return $this->usertel;
    }

    public function getusermun(){
        return $this->usermun;
    }
}

?>