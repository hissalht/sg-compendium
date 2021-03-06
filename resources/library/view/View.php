<?php
require_once("model/ComboBuilder.php");
class View {
    private $title;
    private $content;
    private $pageType;
    private $router;
    private $menu;
    private $connectionFeedback;
    private $feedback;

    public function __construct($router, $feedback){
        $this->router = $router;
        $this->menu = array(
            "Home" => $this->router->getHomeURL(),
            "List" => $this->router->getComboListURL(),
            "New Combo" =>  $this->router->getNewComboURL(),
            "Sign in" => $this->router->getSigninURL(),
            "About" => $this->router->getAboutPageURL(),

        );
        $this->feedback = $feedback;
    }

    public function render(){
        //$title = $this->title;
        //$content = $this->content;
        //$userSpace = "<p>Ici bientôt, un formulaire de connexion</p>";
        if(key_exists("user", $_SESSION)){
            //user is connected
            $user = $_SESSION["user"];
            $userSpace = "<p>{$user->getName()} You are connected.</p>";
            $userSpace .= "<form method=\"POST\" action=\"".$this->router->getDisconnectionURL()."\"><input type=\"submit\" name=\"disconnect\" value=\"Disconnect\"></form>";

        }else{
            //$connectionFeedback = "Unknown login/password";
            ob_start();
            include(TEMPLATES_PATH . "connection_form.php");
            $userSpace = ob_get_clean();
        }
        if(!empty($this->connectionFeedback))
            $userSpace .= "<p class=\"feedback\" id=\"connection-feedback\">".$this->connectionFeedback."</p>";
        include(TEMPLATES_PATH . "squelette.php");
    }

    public function makeTestPage(){
        $this->title = "Accueil";
        $this->content = "<p>Bienvenue sur le combo compendium.</p>";
        $this->content .= "<p>Ce site est une base de donnée de combos pour le jeu <a href=\"http://skullgirls.com/fr/\">SkullGirls</a> développé par Reverge Labs.</p>";
    }

    public function makeHomePage(){
        //TODO
        $this->makeTestPage();
    }

    public function makeAboutPage(){
        $this->title = "About";
        $this->content = "<p>I am 21400748.</p>";
    }

    public function makeComboPage($combo){
        $this->title = "Combo page";
        $character = $combo->getCharacterName();
        $description = $combo->getDescription();
        $moveList = $combo->getMoves();

        ob_start();
        include(TEMPLATES_PATH . "combo_page.php");
        $this->content = ob_get_clean();
    }


    public function makeComboListPage($combos){
        $this->title = "Combo list";
        ob_start();
        include(TEMPLATES_PATH . "combo_list.php");
        $this->content = ob_get_clean();
    }

    public function makeNewComboPage($comboBuilder, $editedId=null){
        $this->title = "New combo";
        $comboData = $comboBuilder->getData();
        ob_start();
        include(TEMPLATES_PATH . "new_combo_form.php");
        $this->content = ob_get_clean();
    }

    //retourne la version "jolie" d'un move : un bouton LK à la place du texte dur LK
    public static function convertMove($move){
        $move = str_replace("LK", "<img src=\"img/layout/LK.png\" alt=\"LK\">", $move);
        $move = str_replace("MK", "<img src=\"img/layout/MK.png\" alt=\"MK\">", $move);
        $move = str_replace("HK", "<img src=\"img/layout/HK.png\" alt=\"HK\">", $move);
        $move = str_replace("LP", "<img src=\"img/layout/LP.png\" alt=\"LP\">", $move);
        $move = str_replace("MP", "<img src=\"img/layout/MP.png\" alt=\"MP\">", $move);
        $move = str_replace("HP", "<img src=\"img/layout/HP.png\" alt=\"HP\">", $move);
        $move = str_replace("DP", "<img src=\"img/layout/DP.png\" alt=\"DP\">", $move);
        $move = str_replace("RDP", "<img src=\"img/layout/RDP.png\" alt=\"RDP\">", $move);
        $move = str_replace("QCF", "<img src=\"img/layout/QCF.png\" alt=\"QCF\">", $move);
        $move = str_replace("QCB", "<img src=\"img/layout/QCB.png\" alt=\"QCB\">", $move);
        $move = str_replace("PP", "<img src=\"img/layout/PP.png\" alt=\"PP\">", $move);
        $move = str_replace("KK", "<img src=\"img/layout/KK.png\" alt=\"KK\">", $move);
        //$move = str_replace("2", "<img src=\"img/layout/2.png\" alt=\"2\">", $move);
        //$move = str_replace("1", "<img src=\"img/layout/1.png\" alt=\"1\">", $move);
        //$move = str_replace("3", "<img src=\"img/layout/3.png\" alt=\"3\">", $move);
        //$move = str_replace("4", "<img src=\"img/layout/4.png\" alt=\"4\">", $move);
        //$move = str_replace("9", "<img src=\"img/layout/9.png\" alt=\"9\">", $move);
        //$move = str_replace("6", "<img src=\"img/layout/6.png\" alt=\"6\">", $move);
        //$move = str_replace("7", "<img src=\"img/layout/7.png\" alt=\"7\">", $move);
        //$move = str_replace("8", "<img src=\"img/layout/8.png\" alt=\"8\">", $move);
        return $move;
    }

    public function setConnectionFeedback($feedback){
        $this->connectionFeedback = $feedback;
    }

    public function makeForbiddenPage($msg=null){
        $this->title = "INTERDIT";
        $this->content = "<p>Vous n'avez pas l'autorisation d'acceder à cette page</p>";
        if(!is_null($msg))
            $this->content .= "\n<p>Raison : ". $msg . "</p>";
    }

    public function displayComboCreationFailure($error){
        $_SESSION["creation_feedback"] = $error;
        $this->router->POSTredirect($this->router->getNewComboURL());
    }

    public function displayComboCreationSuccess($id){
        $_SESSION["creation_feedback"] = "Combo créé avec succès.";
        $this->router->POSTredirect($this->router->getComboURL($id));
    }

    public function displayComboDeletionSuccess($id){
        $_SESSION["creation_feedback"] = "Combo [" . $id . "] a bien été supprimé";
        $this->router->POSTredirect($this->router->getHomeURL());
    }

    public function displayComboDeletionFailure($id){
        $_SESSION["creation_feedback"] = "Combo [" . $id . "] n'a pas pu être supprimé. Vérifiez qu'il est bien présent dans la liste";
        $this->router->POSTredirect($this->router->getHomeURL());
    }

    public function makeNewUserPage($userBuilder){
        $this->title = "Nouvel utilisateur";
        $userData = $userBuilder->getData();
        ob_start();
        include(TEMPLATES_PATH . "new_user_form.php");
        $this->content = ob_get_clean();
    }

    public function displayUserCreationFailure($error){
        $_SESSION["creation_feedback"] = $error;
        $this->router->POSTredirect($this->router->getSigninURL());
    }

    public function displayUserCreationSuccess(){
        $_SESSION["creation_feedback"] = "Votre compte a bien été créé. Vous pouvez maintenant vous connecter";
        $this->router->POSTredirect($this->router->getHomeURL());
    }

}
