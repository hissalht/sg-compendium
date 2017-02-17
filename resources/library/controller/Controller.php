<?php
class Controller{
    private $view;
    private $comboStorage;
    private $userdb;

    public function __construct(View $view, ComboStorage $comboStorage, UserDatabase $userdb){
        $this->view = $view;
        $this->comboStorage = $comboStorage;
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
            $this->view->setConnectionFeedback("Connection success.");
        }else{
            $this->view->setConnectionFeedback("Connection failed.");
        }
    }

    public function disconnect(){
        if(key_exists("user", $_SESSION)){
            unset($_SESSION["user"]);
            $this->view->setConnectionFeedback("Disconnected.");
        }
    }

    public function userConnected(){
        return key_exists("user", $_SESSION);
    }

    public function showNewCombo(){
        $this->view->makeNewComboPage();
    }

    public function saveNewCombo($data){
        if(!$this->userConnected()){
            $this->view->makeForbiddenPage();
            return;
        }

        $comboBuilder = new ComboBuilder($data);
        if(!$comboBuilder->isValid()){
            $_SESSION["currentNewCombo"] = $comboBuilder;
            $this->view->displayComboCreationFailure();
        }else{
            $combo = $comboBuilder->createCombo();
            $id = $this->comboStorage->create($combo);
            $this->view->displayComboCreationSuccess($id);
        }
    }
}
?>
