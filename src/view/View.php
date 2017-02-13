<?php
class View {
    private $title;
    private $content;

    private $router;

    public function __construct($router){
        $this->router = $router;
    }

    public function render(){
        $title = $this->title;
        $content = $this->content;
        include("squelette.php");
    }

    public function makeTestPage(){
        $this->title = "Page de test";
        $this->content = "<p>Contenu de la page</p>";
    }

    public function makeComboPage($combo){
        $this->title = $combo["name"];
        $this->content = "<p>".$combo["character"]." combo :</p>\n";
        $this->content .= "<p>".$combo["description"]."</p>\n";
        $this->content .= "<p>";
        foreach($combo["moves"] as $move){
            $this->content .= $move.", ";
        }
        $this->content .= "</p>";
    }
}
?>
