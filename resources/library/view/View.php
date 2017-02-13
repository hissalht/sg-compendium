<?php
class View {
    private $title;
    private $content;
    private $pageType;
    private $router;

    public function __construct($router){
        $this->router = $router;
    }

    public function render(){
        $title = $this->title;
        $content = $this->content;
        include(TEMPLATES_PATH . "squelette.php");
    }

    public function makeTestPage(){
        $this->title = "Page de test";
        $this->content = "<p>Contenu de la page</p>";
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
        $character = $combo->getCharacter();
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
}
