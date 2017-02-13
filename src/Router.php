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

        $controller->showCombo(2);
        $view->render();
    }
}
?>
