<?php
class Controller{
    private $view;
    private $comboStorage;

    public function __construct(View $view, ComboStorage $comboStorage){
        $this->view = $view;
        $this->comboStorage = $comboStorage;
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
        //$user = $this->userdb->checkAuth($_POST["login"], $_POST["password"]);
        //if($user){
            $_SESSION["user"] = "adrien";
            //$_SESSION["feedback"] = "You successfuly connected. Welcome {$user->name} !";
        //}
    }
}
?>
