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
echo include_once "./log/functionLog.php"; 
/*
if (PHP_OS == "Linux"){
    echo include_once "/var/www/html/Chrono/log/functionLog.php";
}elseif (PHP_OS ==  "WINNT"){
    echo include_once "./log/functionLog.php"; 
}*/

ecrire_log("info", "Raphael", "Pc_Mouse","Il vient de se connecter en tant que 'azer;azer'", "il est le 1er user");
//ecrire_log(null, null, null, null);


echo "<br/> Ok! ";

?>