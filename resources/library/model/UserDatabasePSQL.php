<?php
require_once("UserDatabase.php");
require_once("User.php");
class UserDatabasePSQL implements UserDatabase {
    private $db;
    private $loginStatement;

    //public function __construct($user, $pass, $dbname){
    public function __construct(){
        //$user = CONFIG["db"]["username"];
        $user = DB_USER;
        //$pass = CONFIG["db"]["password"];
        $pass = DB_PASS;
        //$dsn = "pgsql:host=".CONFIG["db"]["host"].";dbname=".CONFIG["db"]["dbname"];
        $dsn = "pgsql:host=".DB_HOST.";dbname=".DB_NAME;
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
            if(password_verify($password, $line["hash"])){
                return new UserAccount($line["id"], $line["login"], $line["name"], $line["status"], $line["mail"]);
            }
        }
        return false;
    }
}
?>
