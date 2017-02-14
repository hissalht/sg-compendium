<?php
class Controller{
    private $view;
    private $comboStorage;
    private $userdb;

    public function __construct(View $view, ComboStorage $comboStorage, UserDatabase $userdb){
        $this->view = $view;
        $this->combotStorage = $comboStorage;
        $this->userdb = $userdb;
    }

    public function showCombo($id){
        $combo = $this->comboStorage->getCombo($id);
        $this->view->makeComboPage($combo);
    }

    public function showAbout(){
        $this->view->makeAboutPage();
    }

    public function showHome(){
        $this->view->makeHomePage();
    }

    public function showComboList(){
        $this->view->makeComboListPage($this->comboStorage->getAllCombos());
    }

    public function connect(){
        $user = $this->userdb->checkAuth($_POST["login"], $_POST["password"]);
        if($user){
            $_SESSION["user"] = $user;
            //$_SESSION["feedback"] = "You successfuly connected. Welcome {$user->name} !";
        }else{
            //$_SESSION["feedback"] = "Connection failed";
        }
    }

    public function disconnect(){
        if(key_exists("user", $_SESSION)){
            unset($_SESSION["user"]);
        }
    }

    public function userConnected(){
        return key_exists("user", $_SESSION);
    }
}
?>
