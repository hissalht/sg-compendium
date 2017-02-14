<?php
class UserAccount {
    private $login;
    private $name;
    private $status;
    private $mail;
    private $id;

    public function __construct($id, $login, $name, $status, $mail){
        $this->login = $login;
        $this->name = $name;
        $this->status = $status;
        $this->mail = $mail;
        $this->id = $id;
    }

    public function getLogin(){
        return $this->login;
    }

    public function getName(){
        return $this->name;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getMail(){
        return $this->mail;
    }

    public function getId(){
        return $this->id;
    }
}
?>
