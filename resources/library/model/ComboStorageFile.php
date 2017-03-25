<?php
require_once("ComboStorage.php");
require_once("Combo.php");
class ComboStorageFile implements ComboStorage {
    private $arr;
    private $nextId;
    private $file;

    public function __construct($file){
        $this->file = $file;
        if(file_exists($this->file)){
            $storedData = unserialize(base64_decode(file_get_contents($this->file)));
            $this->arr = $storedData['arr'];
            $this->nextId = $storedData['nextId'];
        } else {
            $this->arr = array();
            $this->nextId = 1;
        }
    }

    public function __destruct(){
        $dataToBeStored = array('arr' => $this->arr, 'nextId' => $this->nextId);
        file_put_contents($this->file, base64_encode(serialize($dataToBeStored)));
    }

    public function getCombo($id){
        if(key_exists($id, $this->arr)){
            return $this->arr[$id];
        }
        return false;
    }

    public function getAllCombos(){
        return $this->arr;
    }

    public function addCombo(Combo $combo){
        $this->arr[$this->nextId] = $combo;
        $this->nextId += 1;
        return ($this->nextId - 1);
    }

    public function reinit(){
        $this->arr = array(
            1 => new Combo(
                "BB baby combo",
                //"Big Band",
                0,
                "Babby Combo for new Big Band players (works midscreen, works in the corner, not hard, does no damage)",
                array("c.LK, c.MK, s.HP, j.MP, j.HP, QCB.HK Cymbal Clash, charge f.HP Take the A-Train"),
                "John Jhon",
                "very easy",
                2390
            ),
            2 => new Combo(
                "FURY OF THE WOLF",
                //"Beowulf",
                1,
                "Easy chair combo for Beowulf",
                array(
                    "c.LK, s.MP, c.HK, QCF.LK, 8LK, 2LK, c.MP (grab OTG), PP Blyat Dance"
                ),
                "xXx_WereWolfDarkShadowKiller_xXx",
                "very hard",
                4200
            ),
            3 => new Combo(
                "BB BnB mid-screen",
                //"Big Band",
                0,
                "Intermediate mid-screen bread'n'butter combo for Big Band.<br> * The j.HP is supposed to whiff. This causes Big Band to fastfall which lets you link a light normal after. If this is too hard, any combo that includes this can be done with j.MK instead of j.MKx2 for a little less damage.",
                array(
                    "c.LK c.MK s.HP",
                    "j.MP j.HP delay j.HK",
                    "tech forward",
                    "OTG c.HK xx DP.HP Beat Extend",
                    "j.LK, j.MK",
                    "s.MK",
                    "j.LP, j.LK, j.MKx2, j.HP*",
                    "c.LPx2, c.MK, s.HK xx H Take the A-Train xx Super Sonic Jazz",
                ),
                "Internet Dude",
                "Intermediate",
                8300
            )
        );
        $this->nextId = 4;
    }
}
?>
