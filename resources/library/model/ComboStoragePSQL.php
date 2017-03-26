<?php
require_once("ComboStorage.php");
require_once("Combo.php");
class ComboStoragePSQL implements ComboStorage {
    private $db;
    private $getByIdStatement;
    private $getAllStatement;
    private $addStatement;
    private $replaceStatement;

    public function __construct(){
        $user = DB_USER;
        $pass = DB_PASS;
        $dsn = "pgsql:host=".DB_HOST.";dbname=".DB_NAME;

        $this->db = new PDO($dsn, $user, $pass);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->getByIdStatement = $this->db->prepare(
            "SELECT * FROM combos WHERE id = :comboId");
        $this->getAllStatement = $this->db->prepare("SELECT * FROM combos ORDER BY id");
        $this->addStatement = $this->db->prepare(
            "INSERT INTO Combos (name, description, author, charac, moves, difficulty, damages)
            VALUES (
                :name, :description, :author, :charac, :moves, :difficulty, :damages
            )
            RETURNING id"
        );
        $this->replaceStatement = $this->db->prepare(
            "UPDATE Combos
             SET
                 name = :name, description = :description, author = :author,
                 charac = :charac, moves = :moves, difficulty = :difficulty,
                 damages = :damages
             WHERE id = :id"
        );
    }

    public function getCombo($id){
        $data = array(":comboId" => $id);
        $this->getByIdStatement->execute($data);
        $result = $this->getByIdStatement->fetchAll(PDO::FETCH_ASSOC);
        $line = $result[0];

        return new Combo($line["name"], $line["charac"],
            $line["description"], self::array_psql_to_php($line["moves"]),
            $line["author"], $line["difficulty"], $line["damages"]);
    }


    public function getAllCombos(){
        $this->getAllStatement->execute(array());
        $statementResult = $this->getAllStatement->fetchAll(PDO::FETCH_ASSOC);
        $id = 1;

        $result = array();
        foreach($statementResult as $line){
            $combo = new Combo($line["name"], $line["charac"],
                $line["description"], self::array_psql_to_php($line["moves"]),
                $line["author"], $line["difficulty"], $line["damages"]);
            $result[$id] = $combo;
            $id++;
        }
        return $result;
    }


    public function addCombo(Combo $combo){
        $moves = "'\"" . implode("\",\"", $combo->getMoves()) . "\"'";
        $data = array(
            ":name" => $combo->getName(),
            ":description" => $combo->getDescription(),
            ":author" => $combo->getAuthor(),
            ":charac" => $combo->getCharacterId(),
            ":moves" => $moves,
            ":difficulty" => $combo->getDifficultyId(),
            ":damages" => $combo->getDamages(),
        );
        $this->addStatement->execute($data);
        $result = $this->addStatement->fetchAll(PDO::FETCH_ASSOC);
        $line = $result[0];
        return $line["id"];
    }


    public function replaceCombo(Combo $newCombo, $replacedId){
        $moves = "'\"" . implode("\",\"", $newCombo->getMoves()) . "\"'";
        $data = array(
            ":name" => $newCombo->getName(),
            ":description" => $newCombo->getDescription(),
            ":author" => $newCombo->getAuthor(),
            ":charac" => $newCombo->getCharacterId(),
            ":moves" => $moves,
            ":difficulty" => $newCombo->getDifficultyId(),
            ":damages" => $newCombo->getDamages(),
            ":id" => $replacedId
        );
        $this->replaceStatement->execute($data);
        //$result = $this->replaceStatement->fetchAll(PDO::FETCH_ASSOC);
        //$line = $result[0];
        //return $line["id"];
        return $replacedId;
    }


    private static function array_psql_to_php($str){
        $s = trim($str, "{}\"");
        return explode("\",\"", $s);
    }
}
?>
