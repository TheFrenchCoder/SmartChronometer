<?php
// On démarre la session si besoin dans le futur
session_start();
//echo include_once "./include/bddConnectByRoot.php";
try {
    $bdd = new PDO('mysql:host=localhost;dbname=dbchrono;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
     <title>Profil</title>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="css/Cview.css"/>
</head>

<body>

<li> <a href="php/competitors/viewSelector.php">Voir profil</a></li>
<li> <a href="php/competitors/edit.php">Editer profil</a></li>
<li> <a href="php/competitors/remove.php">Effacer profil</a></li>

<br/>
<?php
//DEBUG
include_once $_SERVER['DOCUMENT_ROOT']."/include/debug.php";

//FOOTER
include_once $_SERVER['DOCUMENT_ROOT']."/include/part/footer.php";
?>

</body>
</html>