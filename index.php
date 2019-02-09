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
        if(!isset($_SESSION['username'])){
            echo 
            '
                <li> <a href="php/login.php">Connection</a> </li>
            ';
            $infos = "Utilisateur non connecté(e)";
        }else {
            
            echo 
            '
                <li> <a href="php/login.php">Re-Connection</a> </li>
                <li> <a href="php/start.php">Départ</a> </li>
                <li> <a href="php/raceSelector.php">Selecteur de Course</a> </li>
                <li> <a href="php/finish.php">Arrivée</a> </li>
                <li> <a href="php/admin.php">Administration</a></li>
                <li> <a href="php/results.php">Résultats</a></li>    
            ';
            $infos = "Utilisateur connecté(e) en tant que " . $_SESSION['username'];
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
if (isset($infos)) { // ECHO $infos
    echo "<h5>";
    echo "Infos:";
    var_dump ($infos);
    echo "<h5/>";
}

echo "<br/>";
echo "path: '" . basename(__FILE__) ."'";
echo "<br/>";

echo "Session: <br/>";
var_dump($_SESSION);

echo "<br/>";
echo $_SERVER['DOCUMENT_ROOT'];
echo "<br/>";

echo "Ip: " . $_SERVER['REMOTE_ADDR'];
echo "<br/>";

$bdd = null;

?>