<?php
require_once("model/UserBuilder.php");
require_once("model/ComboBuilder.php");
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
        if(!$this->userConnected()){
            $this->view->makeForbiddenPage();
            return;
        }
        $this->view->makeNewComboPage($this->newCombo());
    }

    public function saveNewCombo($data){
        if(!$this->userConnected()){
            $this->view->makeForbiddenPage();
            return;
        }

        $data["author"] = $_SESSION["user"]->getId();

        $comboBuilder = new ComboBuilder($data);
        if(!$comboBuilder->isValid()){
            $_SESSION["currentNewCombo"] = $comboBuilder;
            $this->view->displayComboCreationFailure($comboBuilder->getError());
        }else{
            $combo = $comboBuilder->createCombo();
            $id = $this->comboStorage->addCombo($combo);
            $this->view->displayComboCreationSuccess($id);
        }
    }

    public function newCombo(){
        if(key_exists("currentNewCombo", $_SESSION)){
            $builder = $_SESSION["currentNewCombo"];
            unset($_SESSION["currentNewCombo"]);
            return $builder;
        }else
            return new ComboBuilder(array());
    }

    public function showModifyCombo($modifiedId){
        if(!$this->userConnected()){
            $this->view->makeForbiddenPage("Connectez-vous ou créez un compte afin de publier des combos");
            return;
        }
        $modifiedAuthor = $this->comboStorage->getCombo($modifiedId)->getAuthor();
        if($modifiedAuthor != $_SESSION["user"]->getId()){
            $this->view->makeForbiddenPage("Vous n'êtes pas l'auteur de ce combo");
            return;
        }
        $this->view->makeNewComboPage($this->getNewEditedCombo($modifiedId), $modifiedId);
    }

    public function replaceCombo($comboData, $replacedId){
        if(!$this->userConnected()){
            $this->view->makeForbiddenPage("Connectez-vous pour pouvoir éditer vos combos");
            return;
        }
        $modifiedAuthor = $this->comboStorage->getCombo($replacedId)->getAuthor();
        if($modifiedAuthor != $_SESSION["user"]->getId()){
            $this->view->makeForbiddenPage("Vous n'êtes pas l'auteur de ce combo");
            return;
        }

        $comboData["author"] = $_SESSION["user"]->getId();
        $comboBuilder = new ComboBuilder($comboData);
        if(!$comboBuilder->isValid()){
            $_SESSION["currentEditedCombo"] = $comboBuilder;
            $this->view->displayComboCreationFailure($comboBuilder->getError());
        }else{
            $combo = $comboBuilder->createCombo();
            //$id = $this->comboStorage->addCombo($combo);
            $id = $this->comboStorage->replaceCombo($combo, $replacedId);
            $this->view->displayComboCreationSuccess($id);
        }
    }

    public function getNewEditedCombo($modifiedId){
        if(key_exists("currentEditedCombo", $_SESSION)){
            $builder = $_SESSION["currentEditedCombo"];
            unset($_SESSION["currentEditedCombo"]);
            return $builder;
        }else
            return $this->comboStorage->getCombo($modifiedId)->getComboBuilder();
    }

    public function deleteCombo($id){
        if(!$this->userConnected()){
            $this->view->makeForbiddenPage("Connectez-vous pour pouvoir éditer vos combos");
            return;
        }
        $modifiedAuthor = $this->comboStorage->getCombo($id)->getAuthor();
        if($modifiedAuthor != $_SESSION["user"]->getId()){
            $this->view->makeForbiddenPage("Vous n'êtes pas l'auteur de ce combo");
            return;
        }
        if($this->comboStorage->deleteCombo($id) > 0){
            $this->view->displayComboDeletionSuccess($id);
        }else{
            $this->view->displayComboDeletionFailure($id);
        }
    }

    public function showNewUser(){
        $this->view->makeNewUserPage($this->newUser());
    }

    public function saveNewUser($data){
        $userBuilder = new UserBuilder($data);
        if(!$userBuilder->isValid()){
            $_SESSION["currentNewUser"] = $userBuilder;
            $this->view->displayUserCreationFailure("BBB".$userBuilder->getError());
        }else{
            $user = $userBuilder->createUser();
            $this->userdb->addUser($user, $data[UserBuilder::PASSWORD_REF]);
            $this->view->displayUserCreationSuccess();
        }
    }

    public function newUser(){
        if(key_exists("currentNewUser", $_SESSION)){
            $builder = $_SESSION["currentNewUser"];
            unset($_SESSION["currentNewUser"]);
            return $builder;
        }else
            return new UserBuilder(array());
    }
}
?>
