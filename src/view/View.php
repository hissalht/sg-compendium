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
        include("layout/squelette.php");
    }

    public function makeTestPage(){
        $this->title = "Page de test";
        $this->content = "<p>Contenu de la page</p>";
    }

    public function makeComboPage($combo){
        $this->title = "Combo page";
        $character = $combo->getCharacter();
        $description = $combo->getDescription();
        $moveList = $combo->getMoves();

        ob_start();
        include("layout/combo_page.php");
        $this->content = ob_get_clean();
    }
}
