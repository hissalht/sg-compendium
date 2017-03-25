<?php
require_once("ComboStorage.php");
require_once("Combo.php");
class ComboStoragePSQL implements ComboStorage {
    private $db;
    private $getByIdStatement;
    private $getAllStatement;

    public __construct(){
        $user = DB_USER;
        $pass = DB_PASS;
        $dsn = "pgsql:host=".DB_HOST.";dbname=".DB_NAME;

        $this->db = new PDO($dsn, $user, $pass);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->getByIdStatement = $this->db->prepare("SELECT * FROM combos WHERE id = :comboId");
        $this->getAllStatement = $this->db->prepare("SELECT * FROM combos");
    }

    public function getCombo($id){
        $data = array(":comboId" => $id);
        $this->getByIdStatement->execute($data);
        $result = $this->getByIdStatement->fetchAll(PDO::FETCH_ASSOC);
        $line = $result[0];

        return new Combo($line["name"], $line["charac"], $line["description"],
            $line["moves"], $line["difficulty"], $line["damages"]);
    }
    public function getAllCombos(){
        $this->getAllStatement->execture(array());
        $statementResult = $this->getAllStatement->fetchAll(PDO::FETCH_ASSOC);

        $result = array();
        foreach($statementResult as $line){
            
        }
        return $result;
    }
    public function addCombo(Combo $combo){
    }
}
?>
