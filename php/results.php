<?php 


/////////////////////////////////////////////////////////////////////////////////
// TODO: Faire un classement en fonction de la categorie, et de l'embarcation. //
/////////////////////////////////////////////////////////////////////////////////


// On démarre la session si besoin dans le futur
session_start();
echo include_once "../include/bddConnectByRoot.php";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
     <title>Résultats</title>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="../css/start.css" />
</head>

<body>

<h1>Résultats:</h1>

<?php //queries SQL
    $qHasFinish = $bdd->query(
    'SELECT * FROM competitors 
    WHERE IsOnStart = 0 
    AND IsOnRun = 0 
    AND IsFinish = 1 
    AND IsHere = 1');
    $countFinish = $qHasFinish ->rowCount();

?>
<div class="table_HasFinish"> 

    <table>

    <div class="TR_HasFinish">
        <?php echo "</TR>";
        echo "<TH>Dossard</TH>"; 
        echo "<TH>Nom Prénom</TH>"; 
        echo "<TH>Club</TH>";
        echo "<TH>Temps initial";
        echo "<TH>Temps d'arrivée";
        echo "<TH>Pénalitées</TH>"; 
        echo "<TH>Temps final</TH>"; 
        echo "</TR>";
        ?>
    </div>

    <?php
        foreach ($qHasFinish as $dataHasFinish) {

        //SetUp les vriables
        $sqlGettingFinishData = (
        'SELECT race1.startTime, race1.finishTime, race1.penalty, race1.resultTime, competitors.number, competitors.name, competitors.firstname, competitors.club_abrev 
        FROM race1 
        INNER JOIN competitors 
        ON race1.number = competitors.number 
        WHERE competitors.IsHere = 1 AND competitors.IsFinish = 1');


        $qFinishData = $bdd->query($sqlGettingFinishData);

        $FinishData = $qFinishData->fetch();
        $startTime = $FinishData['startTime'];
        $finishTime = $FinishData['finishTime'];
        $penalty = $FinishData['penalty'];
        $resultTime = $FinishData['resultTime'];

    
    ?>
    <div class="initData_HasFinish">
          <?php
          //Extraction et affectation des variables
          // Stocke $data[firstname] dans une variable temporaire
          $Tfirstname = $dataHasFinish['firstname']; 
          // Stocke toutes la lettres sauf la 1ere dans une variable temporaire
          $Trest = substr($Tfirstname, 1); 
          //LowerCase de $Trest en $rest
          $rest = strtolower($Trest); 
          //UpCase de $Tfirstname en $firstname
          $firstname = strtoupper($Tfirstname); 
          //UpCase de $data[name] en $name
          $name = strtoupper($dataHasFinish['name']); 
          // Stocke $data[club_abrev] dans une variable temporaire
          $Tclub_abrev = $dataHasFinish['club_abrev']; 
          //UpCase de $Tclub_abrev en $club_abrev
          $club_abrev = strtoupper($Tclub_abrev);
          ?>
    </div>

     <div class="Dossard_HasFinish">
          <?php  
          //Dossard = $data[number]
          echo "</TR> <form method=\"GET\" action=\"\">";
          echo "
               <TD>
               <p>$dataHasFinish[number]</p>
               </TD>  
               ";
          ?>
     </div>
        
     <div class="Nom_Prenom_HasFinish">
          <?php
          //"Nom Prénom"=  $name $firstname[0]$rest
          echo "<TD><p>$name $firstname[0]$rest</p></TD>";
          ?>
     </div>

     <div class="Club_HasFinish">
          <?php
          //Club = $club_abrev
          echo "<TD><p>$club_abrev</p></TD>";
          ?>
     </div>

     <div class="StartTime_HasFinish">
          <?php
          //Checkbox pour savoir si le concurrent est ABS ou pas.
          echo 
          "
          <TD> "
        . date('H:i:s.U', $startTime) .
          "</TD>
          ";
        ?>
     </div>

     <div class="StartTime_HasFinish">
          <?php
          //Checkbox pour savoir si le concurrent est ABS ou pas.
          echo 
          "
          <TD> "
         .date('H:i:s.U', $finishTime).
          "</TD>
          ";
        ?>
     </div>
        
     <div class="Penalty_HasFinish">
          <?php
          //Start = <input type="Submit">
          echo "
               <TD>
               <p>$penalty</p>
               </TD>
               ";
          ?>
     </div>

     <div class="FinalTime_HasFinish">
     <?php
     echo "
          <TD>"
          .date("H:i:s.U", $resultTime).
          "</TD>
          ";
     ?>
     </div>

    <?php
    echo "</TR>";  
    } ?>
    <table/>
</div>

<p class="tips">.</p>

</body>
</html>

<h1>Debuger</h1> 
<?php

echo "<h3>Chemin: '" . basename(__FILE__) ."'</h3>";

echo "<br/>";
echo "path: '" . basename(__FILE__) ."'";
echo "<br/>";
if (!isset($_SESSION['role'])) { 
    $role = "Ø";
}else {
    $role = $_SESSION['role'];
}
echo "Session: connecté en tant que [" . $role . "]" . $_SESSION["username"];
echo "<br/>";
echo "<pre> " . var_dump($_SESSION) . " <pre/>";
$bdd = null;
?>