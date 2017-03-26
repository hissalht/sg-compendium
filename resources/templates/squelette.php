<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $this->title; ?></title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="user-space">
            <?php echo $userSpace; ?>
        </div>
        <h1>Combo compendium</h1>
        <nav class="menu">
            <ul>
<?php
foreach($this->menu as $text => $url){
    echo "<li><a href=\"".$url."\">".$text."</a></li>\n";
}
?>
            </ul>
        </nav>
        <p class="feedback">
<?php
if(key_exists("creation_feedback", $_SESSION)){
    echo $_SESSION["creation_feedback"] . "\n";
    unset($_SESSION["creation_feedback"]);
}
?>
        </p>
        <h2><?php echo $this->title; ?></h2>
        <div id="content">
            <?php echo $this->content . "\n"; ?>
        </div>
    </body>
</html>
