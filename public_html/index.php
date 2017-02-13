<?php
require_once("../resources/config.php");
set_include_path(LIBRARY_PATH);
require_once("Router.php");

$router = new Router();
$router->main();
?>
