<?php
// On démarre la session si besoin dans le futur
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
     <title>Main Chrono</title>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="css/maine.css"/>
</head>

<body>

<div class="NavBar">
    <p>Rôles</p>
  <ul>
    <?php 
        if(!isset($_SESSION['user_username'])){
            echo 
            '
                <li> <a href="php/users/login.php">Connection</a> </li>
            ';
            $infos = "Utilisateur non connecté(e)";
        }else {
            
            echo 
            '
                <li> <a href="php/users/login.php">Re-Connection</a> </li>
                <li> <a href="php/races/start.php">Départ</a> </li>
                <li> <a href="php/races/raceSelector.php">Selecteur de Course</a> </li>
                <li> <a href="php/races/judge.php">Juges</a> </li>
                <li> <a href="php/races/finish.php">Arrivée</a> </li>
                <li> <a href="php/admin.php">Administration</a></li>
                <li> <a href="php/races/results.php">Résultats</a></li>    
            ';
            $infos = "Utilisateur connecté(e) en tant que " . $_SESSION['user_username'];
    } ?>

  </ul>

    <p>Options competiteurs</p>

  <form method="GET" action="">
      <input type="text" name="name" placeholder="Nom">
    <br><br>
      <input type="text" name="firstname" placeholder="Prénom">
    <br><br>
      <input type="text" name="number" placeholder="Dossard">
    <br><br>
      <input id="research" type="submit" name="research" value="1">
      <label for="research">Rechercher</label>
    <br>
  </form>
    
</div>
  
</body>
</html>

<?php

include_once $_SERVER['DOCUMENT_ROOT']."/include/debug.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/include/setup.php";
include_once $_SERVER['DOCUMENT_ROOT']."/include/part/footer.php";

?>