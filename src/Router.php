<?php
require_once("view/View.php");

class Router {
    public function main(){
        session_start();
        $view = new View($this);
        //$storage = new ComboStorage;
        $view->makeTestPage();
        $view->render();
    }
}
?>
