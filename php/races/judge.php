<?php 

//* On démarre la session si besoin dans le futur
session_start();
//* Connnection à la base de donnée
include_once $_SERVER["DOCUMENT_ROOT"]."/include/bdd/bddConnectByRoot.php";
//* TRAITEMENT DES DONNES
include_once $_SERVER["DOCUMENT_ROOT"]."/include/judging.php";
//* NAV BAR
include_once $_SERVER["DOCUMENT_ROOT"]."/include/part/navbar.php";

include_once $_SERVER["DOCUMENT_ROOT"]."/include/json.php";

//Check autorisation a être sur cette page:
if (!in_array($_SESSION['user_role'], $Json_roleAllowToJudge)) {
    echo "Vous n'avez pas accès à cette partie de l'application Web, veuillez retournez a l'acceuil";
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Juges</title>
    <meta charset="utf-8">
    <!-- TODO: Replace "start.css" to "judge.css" -->
    <link rel="stylesheet" type="text/css" href="/css/start.css" />
</head>

<body>

<?php
include_once("parts/judge_title.php");
include_once("parts/judge_tableTojudge.php");
include_once("parts/judge_tableHasBeenjudge.php");
?>

</body>
</html>

<?php
//DEBUG
include_once $_SERVER['DOCUMENT_ROOT']."/include/debug.php";

//FOOTER
include_once $_SERVER['DOCUMENT_ROOT']."/include/part/footer.php";

var_dump($countHasBeenJudge);

?>