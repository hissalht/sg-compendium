<?php

//if(!defined("CONFIG"))
    //define("CONFIG", array(
        //"db" => array(
            //"dbname" => "sg_compendium_db",
            //"username" => "21400748",
            //"password" => "",
            //"host" => "localhost"
        //)
    //));
if(!defined("DB_NAME")) define("DB_NAME", "21400748_bd");
if(!defined("DB_USER")) define("DB_USER", "21400748");
if(!defined("DB_PASS")) define("DB_PASS", "rah2Thiekai1Rah9");
if(!defined("DB_HOST")) define("DB_HOST", "postgresql.info.unicaen.fr");
if(!defined("DB_PORT")) define("DB_PORT", "5432");

if(!defined("LIBRARY_PATH"))
    define("LIBRARY_PATH", realpath(dirname(__FILE__)."/library"));
if(!defined("TEMPLATES_PATH"))
    define("TEMPLATES_PATH", realpath(dirname(__FILE__)."/templates")."/");
if(!defined("TMP_DIR"))
    define("TMP_DIR", realpath(dirname(__FILE__)."/../tmpdir")."/");
?>
