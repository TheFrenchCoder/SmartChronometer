<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/php/json/Json.Class.php";

$json = new Json("database");
$json->getError();

?>