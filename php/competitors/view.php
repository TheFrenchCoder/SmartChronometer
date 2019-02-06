<?php
// On démarre la session si besoin dans le futur
session_start();
//echo include_once "..../include/bddConnectByRoot.php";
try {
    $bdd = new PDO('mysql:host=localhost;dbname=dbchrono;charset=utf8', 'root', 'espace21');
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
<?php

$qC = $bdd ->query('SELECT * FROM `competitors` WHERE `number` = ' . $_GET['number']);   
$count = $qC ->rowCount();

foreach ($qC as $dataC) {

    //Extraction et affectation des variables

    // Stocke $data[firstname] dans une variable temporaire
    $Tfirstname = $dataC['firstname']; 
    // Stocke toutes la lettres sauf la 1ere dans une variable temporaire
    $Trest = substr($Tfirstname, 1); 
    //LowerCase de $Trest en $rest
    $rest = strtolower($Trest); 
    //UpCase de $Tfirstname en $firstname
    $firstname = strtoupper($Tfirstname); 
    //UpCase de $data[name] en $name
    $name = strtoupper($dataC['name']); 
    // Stocke $data[club_abrev] dans une variable temporaire
    $Tclub_abrev = $dataC['club_abrev']; 
    //UpCase de $Tclub_abrev en $club_abrev
    $club_abrev = strtoupper($Tclub_abrev);
    //Stockage des variables pour déterminer le statut du competiteur
    $IsHere = $dataC['IsHere'];
    //Stockage des variables pour déterminer le sexe du competiteur
    $sex_number = $dataC['sex'];

    //Source URL de #zrtAlien
    $urlzrtAlien = "https://www.google.com/imgres?imgurl=https%3A%2F%2Fstatic-cdn.jtvnw.net%2Femoticons%2Fv1%2F199659%2F3.0&imgrefurl=https%3A%2F%2Fwww.twitchmetrics.net%2Fe%2F199659-zrtAlien&docid=U3u7mFrcv-0M0M&tbnid=LATuqz98P9PDAM%3A&vet=10ahUKEwjQyp_a8rzcAhUDyoUKHa-gDxgQMwg0KAAwAA..i&w=112&h=112&bih=917&biw=1680&q=zrtalien&ved=0ahUKEwjQyp_a8rzcAhUDyoUKHa-gDxgQMwg0KAAwAA&iact=mrc&uact=8";

    if ($IsHere == true) {
        if ($sex_number == 0){
            $statut = "Présente";
        }elseif ($IsHere == false) {
            $statut = "Présente";
        }else {
            $statut = "Là mais alien <a href='" . $urlzrtAlien . "'>zrtAlien</a> ou pas ^^";
            
        }

    }elseif ($IsHere == false){
        if ($sex_number == 0){
            $statut = "Absente";
        }elseif ($IsHere == false) {
            $statut = "Absent";
        }else {
            $statut = "Abs (comme pour les imprimantes 9D) mais alien #zrtAlien";
        }
        $statut = "En course";
    }else {
        $errors['StatutUndefined'] = "Le statut du competiteur n°" . $_GET['number'] . " est inconnu {voir <a href='http://192.168.0.2/phpmyadmin/'>BDD</a>}";
    }

    if ($dataC['sex'] == 0){ // = Femme
        $sex = "Femme";        
    }elseif ($dataC['sex'] == 1) { // = Homme
        $sex = "Homme";
    }else{ // $errors['SexUndefined']
        $errors['SexUndefined'] = "Le sexe du competiteur n°" . $_GET['number'] . " est inconnu {voir <a href='http://192.168.0.2/phpmyadmin/'>BDD</a>}";
    }

    if ($count > 1) { //$errors['MoreThanOne']
        $errors['MoreThanOne'] = "Il y a plusieurs competiteur assigne au dossard n° " . $_GET['number'] . " 
        {voir <a href='http://localhost/phpmyadmin/'>BDD</a>}
        ";}
    if ($count < 0) { //$errors['UnderOne']
        $errors['UnderOne'] = "Il n'y a pas de competiteur assigne au dossard n° " . $_GET['number'];}

    if (!isset($errors)){ // All display
        $infos['OnlyOne'] = "Il n'y a bien qu'un seul competiteur assigne au dossard n° " . $_GET['number'];


        echo "<a href='../admin.php'>Acceuil</a>";
        echo "<h1>Profil dossard n°" . $_GET['number'] . "</h1>";
        echo "<h2>Infos:<h2/>";
        echo "
                <h3>
                    Nom: " . $name . 
                    "<br/>
                    Prénom: " . $firstname .
                    "<br/>
                    Club: " . $club_abrev .
                    "<br/>
                    Catégorie: " . $dataC['categorie_name'] . "-".$dataC['categorie_number'] .
                    "<br/>
                    Sexe: " . $sex .
                    "<br/>
                    Statut: " . $statut .
                "<h3/>
            ";
        echo "<h2>1ere course:<h2/>";
        echo "Statut: ";
        echo "Temps: nul";
        echo "<h2>2eme course:<h2/>";
        echo "<h2>Resultats:<h2/>";
    }else {
        echo"Erreur dans la base de donnée! Contacter un administrateur voir les logs.";
    }
}

?>
<br/>
<h1>Debuger</h1> 
<?php
echo "<h3>Chemin: '" . basename(__FILE__) ."'</h3>";

echo "<h3>Var_dump (null):</h3>";// var_dump($data);

echo "<h3>Il y a " . $count . " competiteur avec le dossard " . $_GET['number'] . "</h3>";

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