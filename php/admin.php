<?php
// On démarre la session si besoin dans le futur
session_start();
echo include_once "../include/bddConnectByRoot.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
     <title>Administration</title>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="../css/administation.css"/>
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>

<?php include("$_SERVER[DOCUMENT_ROOT]/include/navbar.php"); ?>

<h1>Administration</h1>

<?php $q = $bdd->query('SELECT * FROM `competitors`'); ?>
<p class="content">

<a href="add.php"/>
        <!-- <img src="../src/add.png" alt="ajouter" border="0"/> -->
        + Ajouter un nouveau competiteur

    </a>
    <br/><br/>

    <table>
    <?php echo "</TR>";
    echo "<TH>Dossard</TH>"; 
    echo "<TH>Nom Prénom</TH>"; 
    echo "<TH>Club</TH>";
    echo "<TH>Statut</TH>";
    echo "<TH>Edition</TH>";
    echo "<TH>Suppression</TH>";
    echo "</TR>";

    foreach ($q as $data) {

    //Extraction et affectation des variables

    // Stocke $data[firstname] dans une variable temporaire
    $Tfirstname = $data['firstname']; 
    // Stocke toutes la lettres sauf la 1ere dans une variable temporaire
    $Trest = substr($Tfirstname, 1); 
    //LowerCase de $Trest en $rest
    $rest = strtolower($Trest); 
    // UpCase de $Tfirstname en $firstname
    $firstname = strtoupper($Tfirstname); 
    // UpCase de $data[name] en $name
    $name = strtoupper($data['name']); 
    // Stocke $data[club_abrev] dans une variable temporaire
    $Tclub_abrev = $data['club_abrev']; 
    // UpCase de $Tclub_abrev en $club_abrev
    $club_abrev = strtoupper($Tclub_abrev);
    // Stocke $data[IsOnStart] dans $IsOnStart
    $IsOnStart = $data['IsOnStart'];
    // Stocke $data[IsOnRun] dans $IsOnRun
    $IsOnRun = $data['IsOnRun'];
    // Stocke $data[IsFinish] dans $IsFinish
    $IsFinish = $data['IsFinish'];

        //Dossard
    echo " <TD>$data[number]</TD> "; 

        //Nom Prénom
    echo "<TD> $name $firstname[0]$rest </TD>";

        //Club
    echo "<TD> $club_abrev </TD>";

        //Statut
    echo "
            <TD>
                <a href=\"competitors/view.php?number=$data[number]\"/>
                Voir...
                </a>
            </TD>
        ";
    /*if ($IsOnStart == 1) {
        echo "<TD> Au départ </TD>";
    } elseif ($IsOnRun == 1){
        echo "<TD> En course </TD>";
    } elseif ($IsFinish == 1) {
        echo "<TD> A fini </TD>";
    } else {
        echo "<TD> Default </TD>";
    }*/
    
        //Edition
    echo "
            <TD>
                <a href=\"competitors/edit.php?number=$data[number]\">
                Modifier
                </a>
            </TD>
        ";

        //Supprimer
    echo "
    <TD>
    <a href=\"competitors/remove.php?number=$data[number]\">
     - Effacer
    </a>
    </TD>
    ";

    echo "</TR>";  
    } ?>
    <table/>
</p>

</body>
</html>

<h1>Debuger</h1> 
<?php
echo "path: '" . basename(__FILE__) ."'";
echo "<br/>";
echo "Session: <br/>";
var_dump($_SESSION);
$bdd = null;
?>