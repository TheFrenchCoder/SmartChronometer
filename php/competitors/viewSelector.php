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
<h1>Debuger</h1> 
<?php
echo "<h3>Chemin: '" . basename(__FILE__) ."'</h3>";

if (isset($infos)) {
    echo "<h5>";
    echo "Infos:";
    var_dump ($infos);
    echo "<h5/>";
}
if (isset($errors)) {
    echo "<h5>";
    echo "Erruers:";
    var_dump ($errors);
    echo "<h5/>";
}

echo "path: '" . basename(__FILE__) ."'";
echo "<br/>";
echo "Session: <br/>";
var_dump($_SESSION);
$bdd = null;
?>

</body>
</html>