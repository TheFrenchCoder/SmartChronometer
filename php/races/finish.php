<?php 


/////////////////////////////////////////////////////////////////////////////////////////
// OPTIONAL: Passer en AJAX pour ne plus avoir besssoin de relancer la page via '<meta/>'
/////////////////////////////////////////////////////////////////////////////////////////


//* On démarre la session si besoin dans le futur
session_start();
//* Connnection à la base de donnée
include_once $_SERVER["DOCUMENT_ROOT"]."/include/bdd/bddConnectByRoot.php";
//* TRAITEMENT DES DONNES
include_once $_SERVER["DOCUMENT_ROOT"]."/include/stopping.php";
//* NAV BAR
include_once $_SERVER["DOCUMENT_ROOT"]."/include/part/navbar.php";

?>

<!DOCTYPE html>
<html lang="fr">
<head>
     <title>Arrivée</title>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="/css/start.css" />
</head>

<body>

<h1>Finish</h1>

<?php //query SQL
    $qInRace = $bdd->query('SELECT * FROM competitors WHERE IsOnStart = 0 AND IsOnRun = 1 AND IsFinish = 0 AND IsHere = 1');
    $countInRace = $qInRace ->rowCount();
?>

<div class="table_InRace">
    <?php
        if ($countInRace == 0){
            echo "<h2>En course: 0</h2>";
        }else {
            echo "<h2>En course:</h2>";
        ?>            
            <table>
                <div class="TR_InRace">
                    </TR>
                        <TH>Dossard</TH>
                        <TH>Nom Prénom</TH>
                        <TH>Club</TH>
                        <TH>Arrivée</TH>
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
            <input id=\"present$dataInRace[number]\" type=\"submit\" name=\"finish\" value=\"1\">
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
//DEBUG
include_once $_SERVER['DOCUMENT_ROOT']."/include/debug.php";

//FOOTER
include_once $_SERVER['DOCUMENT_ROOT']."/include/part/footer.php";
?>