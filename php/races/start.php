<?php 


////////////////////////////////////////////////////////////////////////////////////////
// OPTIONAL: Passer en AJAX pour ne plus avoir besssoin de relancer la page via '<meta/>' //
////////////////////////////////////////////////////////////////////////////////////////


// On démarre la session si besoin dans le futur
session_start();
include_once $_SERVER["DOCUMENT_ROOT"]."/include/bdd/bddConnectByRoot.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/include/launching.php";
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
     <title>Start</title>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="/css/start.css" />
</head>

<body>

<h1>Starter</h1>

<?php //queries SQL
    $qPresent = $bdd->query('SELECT *
    FROM   competitors
    WHERE  isonstart = 1
       AND isonrun = 0
       AND isfinish = 0
       AND ishere = 1 ');

    $qMissing = $bdd->query('SELECT *
    FROM competitors 
    WHERE IsHere = 0');
    $countMissing = $qMissing ->rowCount();

    $qInRace = $bdd->query('SELECT *
    FROM competitors
    WHERE isonstart = 0
      AND isonrun = 1
      AND isfinish = 0
      AND ishere = 1');
    $countInRace = $qInRace ->rowCount();
?>
<div class="table_Present"> 
    <h2>Présents:</h2>
    <table>

    <div class="TR_present">
        <?php echo "</TR>";
        echo "<TH>Dossard</TH>"; 
        echo "<TH>Nom Prénom</TH>"; 
        echo "<TH>Club</TH>";
        echo "<TH>Absent(e)</TH>";
        echo "<TH>Start</TH>"; 
        echo "</TR>";
        ?>
    </div>

    <?php
    foreach ($qPresent as $dataPresent) { ?>

    <div class="initData_present">
        <?php
        //Extraction et affectation des variables
        // Stocke $data[firstname] dans une variable temporaire
        $Tfirstname = $dataPresent['firstname']; 
        // Stocke toutes la lettres sauf la 1ere dans une variable temporaire
        $Trest = substr($Tfirstname, 1); 
        //LowerCase de $Trest en $rest
        $rest = strtolower($Trest); 
        //UpCase de $Tfirstname en $firstname
        $firstname = strtoupper($Tfirstname); 
        //UpCase de $data[name] en $name
        $name = strtoupper($dataPresent['name']); 
        // Stocke $data[club_abrev] dans une variable temporaire
        $Tclub_abrev = $dataPresent['club_abrev']; 
        //UpCase de $Tclub_abrev en $club_abrev
        $club_abrev = strtoupper($Tclub_abrev);
        ?>
    </div>

    <div class="Dossard_present">
        <?php  
        //Dossard = $data[number]
        echo "</TR> <form method=\"GET\" action=\"\">";
        echo "
            <TD>
            <input type=\"checkbox\" name=\"number\" class=\"dossard-button\" id=\"checkbox\" value=\"$dataPresent[number]\" checked>
            <label for=\"checkbox\">$dataPresent[number]</label>
            </TD>  
            ";
        ?>
    </div>
        
    <div class="Nom_Prenom_present">
        <?php
        //"Nom Prénom"=  $name $firstname[0]$rest
        echo "<TD> $name $firstname[0]$rest </TD>";
        ?>
    </div>

    <div class="Club_present">
        <?php
        //Club = $club_abrev
        echo "<TD> $club_abrev </TD>";
        ?>
    </div>

    <div class="Checkbox_ABS">
        <?php
        //Checkbox pour savoir si le concurrent est ABS ou pas.
            echo 
            "
            <TD>
            <input id=\"abs$dataPresent[number]\" type=\"submit\" name=\"missing\" value=\"1\">
            <label for=\"abs$dataPresent[number]\">Absent</label>
            </TD>
            ";
            /*
            echo 
            "
            <TD>
            <input type=\"checkbox\" name=\"InRace\" value=\"1\">
            <button type=\"reset\"> Reset
            </TD>
            ";
            */
        ?>
    </div>
        
    <div class="Submit_present">
        <?php
        //Start = <input type="Submit">
        echo "
            <TD>
            <input id=\"start$dataPresent[number]\"  type=\"submit\" name=\"start\" value=\"1\">
            <label for=\"start$dataPresent[number]\">Go!</label>
            </form>
            </TD>
             ";
        ?>
    </div>

    <?php
    echo "</TR>";  
    } ?>
    <table/>
</div>

<div class="table_Missing">
    <?php
        if ($countMissing == 0){
            echo "";
        }else {
            echo "<h2>Absent(e/s):</h2>";
        ?>            
            <table>
                <div class="TR_Missing">
                    </TR>
                        <TH>Dossard</TH>
                        <TH>Nom Prénom</TH>
                        <TH>Club</TH>
                        <TH>Présence</TH>
                    </TR>
                </div>            

    <?php
        }
    
        foreach ($qMissing as $dataMissing) {
    ?>

    <div class="InitData_Missing">
        <?php
        //Extraction et affectation des variables
        // Stocke $data[firstname] dans une variable temporaire
        $TfirstnameMissing = $dataMissing['firstname'];
        // Stocke toutes la lettres sauf la 1ere dans une variable temporaire
        $TrestMissing = substr($TfirstnameMissing, 1);
        //LowerCase de $Trest en $rest
        $restMissing = strtolower($TrestMissing);
        //UpCase de $Tfirstname en $firstname
        $firstnameMissing = strtoupper($TfirstnameMissing);
        //UpCase de $data[name] en $name
        $nameMissing = strtoupper($dataMissing['name']);
        // Stocke $data[club_abrev] dans une variable temporaire
        $Tclub_abrevMissing = $dataMissing['club_abrev'];
        //UpCase de $Tclub_abrev en $club_abrev
        $club_abrevMissing = strtoupper($Tclub_abrevMissing);
        ?>
    </div>

    <div class="Dossard_Missing">
        <?php
        //Dossard = $data[number]
        echo "</TR> <form method=\"GET\" action=\"\">";
        echo "
            <TD>
            <input type=\"checkbox\" name=\"number\" class=\"dossard-button\" id=\"checkbox\" value=\"$dataMissing[number]\" checked>
            <label for=\"checkbox\">$dataMissing[number]</label>
            </TD>  
            ";
        ?>
    </div>        
    
    <div class="Nom_Prenom_Missing">
        <?php
        //"Nom Prénom"=  $name $firstname[0]$rest
        echo "<TD> $nameMissing $firstnameMissing[0]$restMissing </TD>";
        ?>
    </div>

    <div class="Club_Missing">
        <?php
        //Club = $club_abrev
        echo "<TD> $club_abrevMissing </TD>";
        ?>
    </div>
        
    <div class="Submit_Missing">
        <?php
        //Start = <input type="Submit">
        echo "
            <TD>
            <input id=\"present$dataMissing[number]\" type=\"submit\" name=\"present\" value=\"1\">
            <label for=\"present$dataMissing[number]\">Oui</label>
            </form>
            </TD>
            ";
        ?>
    </div>
        
    <?php
    echo "</TR>";  
    } ?>
    <table/>
</div>

<div class="table_InRace">
    <?php
        if ($countInRace == 0){
            echo "";
        }else {
            echo "<h2>En course:</h2>";
        ?>            
            <table>
                <div class="TR_InRace">
                    </TR>
                        <TH>Dossard</TH>
                        <TH>Nom Prénom</TH>
                        <TH>Club</TH>
                        <TH>Annuler Start</TH>
                    </TR>
                </div>            

    <?php
        }
    
        foreach ($qInRace as $dataInRace) {
    ?>

    <div class="InitData_InRace">
        <?php
        //Extraction et affectation des variables
        // Stocke $data[firstname] dans une variable temporaire
        $TfirstnameInRace = $dataInRace['firstname'];
        // Stocke toutes la lettres sauf la 1ere dans une variable temporaire
        $TrestInRace = substr($TfirstnameInRace, 1);
        //LowerCase de $Trest en $rest
        $restInRace = strtolower($TrestInRace);
        //UpCase de $Tfirstname en $firstname
        $firstnameInRace = strtoupper($TfirstnameInRace);
        //UpCase de $data[name] en $name
        $nameInRace = strtoupper($dataInRace['name']);
        // Stocke $data[club_abrev] dans une variable temporaire
        $Tclub_abrevInRace = $dataInRace['club_abrev'];
        //UpCase de $Tclub_abrev en $club_abrev
        $club_abrevInRace = strtoupper($Tclub_abrevInRace);
        ?>
    </div>

    <div class="Dossard_InRace">
        <?php
        //Dossard = $data[number]
        echo "</TR> <form method=\"GET\" action=\"\">";
        echo "
            <TD>
            <input type=\"checkbox\" name=\"number\" class=\"dossard-button\" id=\"checkbox\" value=\"$dataInRace[number]\" checked>
            <label for=\"checkbox\">$dataInRace[number]</label>
            </TD>  
            ";
        ?>
    </div>        
    
    <div class="Nom_Prenom_InRace">
        <?php
        //"Nom Prénom"=  $name $firstname[0]$rest
        echo "<TD> $nameInRace $firstnameInRace[0]$restInRace </TD>";
        ?>
    </div>

    <div class="Club_InRace">
        <?php
        //Club = $club_abrev
        echo "<TD> $club_abrevInRace </TD>";
        ?>
    </div>
        
    <div class="Submit_InRace">
        <?php
        //Start = <input type="Submit">
        echo "
            <TD>
            <input id=\"present$dataInRace[number]\" type=\"submit\" name=\"present\" value=\"2\">
            <label for=\"present$dataInRace[number]\">Oui</label>
            </form>
            </TD>
            ";
        ?>
    </div>
        
    <?php
    echo "</TR>";  
    } ?>
    <table/>
</div>


</body>
</html>

<?php

//TRAITEMENT DES DONNES:
include_once $_SERVER["DOCUMENT_ROOT"]."/include/launching.php";

//DEBUG
include_once $_SERVER['DOCUMENT_ROOT']."/include/debug.php";


$bdd = null;
?>