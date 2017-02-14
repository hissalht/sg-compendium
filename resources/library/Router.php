<?php
require_once("view/View.php");
require_once("controller/Controller.php");
require_once("model/ComboStorageFile.php");

class Router {
    public function main(){
        session_start();
        $view = new View($this);
        $comboStorage = new ComboStorageFile(TMP_DIR . "combo.db");
        $controller = new Controller($view, $comboStorage);

        if(key_exists("reset", $_GET)){
            $comboStorage->reinit();
        }

        if(key_exists("login", $_POST) && key_exists("password", $_POST)){
            $controller->connect();
        }

        if(key_exists("combo", $_GET)){
            $controller->showCombo($_GET["combo"]);
        }else if(key_exists("list", $_GET)){
            $controller->showComboList();
        }else if(key_exists("about", $_GET)){
            $controller->showAbout();
        }else{
            $controller->showHome();
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

    public function getHomeURL(){
        return "index.php";
    }

    public function getConnectionURL(){
        return "index.php?connection";
    }
}
?>
