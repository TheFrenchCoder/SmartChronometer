<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/php/json/Json.class.php";

$json = new Json("database");
var_dump($json->getErrors());
var_dump($json->getInfos());

?>