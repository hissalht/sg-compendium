<?php
require_once("UserDatabase.php");
class UserDatabasePSQL implements UserDatabase {
    private $db;
    private $loginStatement;

    //public function __construct($user, $pass, $dbname){
    public function __construct(){
        $user = CONFIG["db"]["username"];
        $pass = CONFIG["db"]["password"];
        $dsn = "pgsql:host=".CONFIG["db"]["host"].";dbname=".CONFIG["db"]["dbname"];
        //$dsn = "pgsql:host={$config["db"]["host"]};dbname={$dbname}";

        $this->db = new PDO($dsn, $user, $pass);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $rq = "SELECT * FROM users WHERE login = :login";
        $this->loginStatement = $this->db->prepare($rq);
    }


    /** Return a User object on success, FALSE otherwise */
    public function checkAuth($login, $password){
        $data = array(":login" => $login);
        $this->loginStatement->execute($data);
        $result = $this->loginStatement->fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $line){
            if(password_verify($password, $result["hash"])){
                return new User($result["id"], $result["login"], $result["name"], $result["status"], $result["mail"]);
            }
        }
        return false;
    }
}
?>
