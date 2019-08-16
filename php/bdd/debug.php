<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/php/bdd/fDatabase.php";
$bdd = new DataBase([ 
    "login" => ["root", "espace21"],
    "host" => ["mysql", "localhost", "dbchrono", "utf8"]
    ]);