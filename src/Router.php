<?php
require_once("view/View.php");
require_once("controller/Controller.php");

class Router {
    public function main(){
        session_start();
        $view = new View($this);
        $controller = new Controller($view);

        $controller->showCombo();
        $view->render();
    }
}
?>
