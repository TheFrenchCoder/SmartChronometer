<?php

include_once $_SERVER["DOCUMENT_ROOT"]."/include/part/navbar.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/include/json.php";

session_start();    
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
     <title>Chrono> Déconnexion</title>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="css/Disconnect.css"/>
</head>

<body>

<div style ='text-align: center;'>
    <p>Vous avez bien été déconnecté(e) <br/> </p>
    <a href="/index.php">Retourner à la page d'acceuil</a>    
</div>

</body>
</html>

<?php

//DEBUG
include_once $_SERVER['DOCUMENT_ROOT']."/include/debug.php";

//FOOTER
include_once $_SERVER['DOCUMENT_ROOT']."/include/part/footer.php";

?>
