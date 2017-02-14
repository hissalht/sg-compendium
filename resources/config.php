<?php

if(!defined("CONFIG"))
    define("CONFIG", array(
        "db" => array(
            "dbname" => "sg_compendium_db",
            "username" => "21400748",
            "password" => "",
            "host" => "localhost"
        )
    ));

if(!defined("LIBRARY_PATH"))
    define("LIBRARY_PATH", realpath(dirname(__FILE__)."/library"));
if(!defined("TEMPLATES_PATH"))
    define("TEMPLATES_PATH", realpath(dirname(__FILE__)."/templates")."/");
if(!defined("TMP_DIR"))
    define("TMP_DIR", realpath(dirname(__FILE__)."/../tmpdir")."/");
?>
