<?php
require_once("view/View.php");
require_once("controller/Controller.php");
require_once("model/ComboStorageFile.php");

class Router {
    public function main(){
        session_start();
        $view = new View($this);
        $comboStorage = new ComboStorageFile("tempo/combo.db");
        $comboStorage->reinit();
        $controller = new Controller($view, $comboStorage);

        if(key_exists("combo", $_GET)){
            $controller->showCombo($_GET["combo"]);
        }else if(key_exists("list", $_GET)){
            $controller->showComboList();
        }else if(key_exists("about", $_GET)){
            $controller->showAbout();
        }

        $view->render();
    }

    public function getComboURL($id){
        return "index.php?combo=".$id;
    }

    public function getComboListURL(){
        return "index.php?list";
    }

    public function getAboutPageURL(){
        return "index.php?about";
    }
}
?>
