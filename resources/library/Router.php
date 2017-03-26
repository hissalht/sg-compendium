<?php
require_once("view/View.php");
require_once("controller/Controller.php");
//require_once("model/ComboStorageFile.php");
require_once("model/ComboStoragePSQL.php");
require_once("model/UserDatabasePSQL.php");

class Router {
    public function main(){
        session_start();
        $feedback = isset($_SESSION["creation_feedback"]) ? $_SESSION["creation_feedback"] : "";
        $_SESSION["creation_feedback"] = "";

        $view = new View($this, $feedback);
        //$comboStorage = new ComboStorageFile(TMP_DIR . "combo.db");
        $comboStorage = new ComboStoragePSQL();
        $userdb = new UserDatabasePSQL();
        $controller = new Controller($view, $comboStorage, $userdb);

        if(key_exists("reset", $_GET)){
            $comboStorage->reinit();
        }

        if(key_exists("login", $_POST) && key_exists("password", $_POST)){
            $controller->connect();
        }

        if(key_exists("disconnect", $_POST)){
            $controller->disconnect();
        }

        if(isset($_POST[UserBuilder::LOGIN_REF]) &&
                isset($_POST[UserBuilder::NAME_REF]) &&
                isset($_POST[UserBuilder::MAIL_REF]) &&
                isset($_POST[UserBuilder::PASSWORD_REF])){
            $controller->saveNewUser($_POST);
        }

        if(key_exists("combo", $_GET)){
            $controller->showCombo($_GET["combo"]);
        }else if(key_exists("list", $_GET)){
            $controller->showComboList();
        }else if(key_exists("about", $_GET)){
            $controller->showAbout();
        }else if(key_exists("new", $_GET)){
            $controller->showNewCombo();
        }else if(key_exists("save", $_GET)){
            $controller->saveNewCombo($_POST);
        }else if(key_exists("edit", $_GET)){
            //édite un combo existant
            $controller->showModifyCombo($_GET["edit"]);
        }else if(key_exists("replace", $_GET)){
            //remplace un combo existant
            $controller->replaceCombo($_POST, $_GET["replace"]);
        }else if(key_exists("delete", $_GET)){
            //supprime un combo existant
            $controller->deleteCombo($_GET["delete"]);
        }else if(key_exists("signin", $_GET)){
            $controller->showNewUser();
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
        return "index.php";
    }

    public function getDisconnectionURL(){
        return "index.php";
    }

    public function getNewComboURL(){
        return "index.php?new";
    }

    public function getComboSubmissionURL(){
        return "index.php?save";
    }

    public function getComboEditingURL($replacedId){
        return "index.php?edit=" . $replacedId;
    }

    public function getComboReplacementURL($replacedId){
        return "index.php?replace=" . $replacedId;
    }

    public function getComboDeletionURL($id){
        return "index.php?delete=" . $id;
    }

    public function getSigninURL(){
        return "index.php?signin";
    }

    public function getNewUserURL(){
        return "index.php?newUser";
    }

    public function POSTredirect($url){
        error_log($url);
        header("Location: ".$url, true, 303);
    }
}
?>
