<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $this->title; ?></title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
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
<?php
echo "<p class=\"feedback\">\n";
echo $this->feedback;
echo "</p>\n";
?>
        <h2><?php echo $this->title; ?></h2>
        <div id="content">
            <?php echo $this->content . "\n"; ?>
        </div>
    </body>
</html>
