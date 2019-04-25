<?php
// On démarre la session si besoin dans le futur
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
     <title>Logger</title>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="css/XXX.css"/>
</head>

<body>

<h1>Logger: Créer les logs</h1>

<form action="" method="post">



</form>

</body>
</html>

<?php
include_once $_SERVER['DOCUMENT_ROOT']."/log/functionLog.php"; 

ecrire_log("info", "Raphael", "Pc_Mouse","Il vient de se connecter en tant que 'azer;azer'", "il est le 1er user");
ecrire_log("type", "user", "domain/Ip adresse", "actions faites", "détails utiles sur cette action.");


echo "<br/> Ok! ";

?>