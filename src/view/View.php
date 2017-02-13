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
        $this->title = $combo["name"];
        $character = $combo["character"];
        $description = $combo["description"];
        $moveList = $combo["moves"];

        ob_start();
        include("layout/combo_page.php");
        $this->content = ob_get_clean();

        //$this->content = getScriptOutput("layout/combo_page.php");
        //$this->content = "<p>".$combo["character"]." combo :</p>\n";
        //$this->content .= "<p>".$combo["description"]."</p>\n";
        //$this->content .= "<p>";
        //foreach($combo["moves"] as $move){
            //$this->content .= $move.", ";
        //}
        //$this->content .= "</p>";
    }
}
