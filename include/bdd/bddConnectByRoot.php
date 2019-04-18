<?php 
    try {
    $bdd = new PDO('mysql:host=localhost;dbname=dbchrono;charset=utf8', 'root', 'espace21');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } 

    catch(Exception $e) {
    die('Erreur : '.$e->getMessage());

    }

?>