Permet d'afficher les competiteurs selon la version finale

<?php 

echo "<br/><br/><br/>";

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
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="css/XXX.css"/>
</head>

<body>

<?php //queries SQL

$arrCategories = array(
    1 => "Poussin",
    2 => "Benjamin",
    3 => "Minime",
    4 => "Cadet",
    5 => "Junior",
    6 => "Senior",
    7 => "Vétérant");

    // Permet
    foreach ($arrCategories as $key => $value){

        echo "
        
        <table>
            </TR>
                <TH>Dossard</TH>
                <TH>Nom Prénom</TH>
                <TH>Club</TH>
                <TH>Temps brut</TH>
                <TH>Pénalitées</TH>
                <TH>Temps Final</TH>
            </TR>
        ";
        
        echo "Cat. n°$key/ $value<br/>";

        $sqlHasFinish = 
        ('SELECT 
            race1.start_time, 
            race1.finish_time, 
            race1.penalty, 
            race1.result_time, 
            competitors.number, 
            competitors.name, 
            competitors.firstname, 
            competitors.club_abrev 
        FROM 
            race1 
        INNER JOIN competitors 
            ON race1.number = competitors.number 
        WHERE 
            competitors.ishere = 1 
            AND competitors.isfinish = 1 
            AND competitors.categorie_number = ? 
        ORDER BY 
            competitors.sex, 
            competitors.categorie_number, 
            race1.result_time ASC
        ');
        $qHasFinish = $bdd->prepare($sqlHasFinish);
        $qHasFinish->execute(array($key));

        $DatasFinish = $qHasFinish->fetchAll();

        
        foreach($DatasFinish as $DataFinish) {

            // * Setting variables
            $start_time = $DataFinish['start_time'];
            $finish_time = $DataFinish['finish_time'];
            $penalty = $DataFinish['penalty'];
            $result_time = $DataFinish['result_time'];
            $number = $DataFinish['number'];


            // * Affectation des variables
            // Stocke $data[firstname] dans une variable temporaire
            $TfirstnameHasFinish = $DataFinish['firstname'];
            // Stocke toutes la lettres sauf la 1ere dans une variable temporaire
            $TrestHasFinish = substr($TfirstnameHasFinish, 1);
            //LowerCase de $Trest en $rest
            $restHasFinish = strtolower($TrestHasFinish);
            //UpCase de $Tfirstname en $firstname
            $firstname = strtoupper($TfirstnameHasFinish);
            //UpCase de $data[name] en $name
            $name = $DataFinish['name'];
            // Stocke $data[club_abrev] dans une variable temporaire
            $Tclub_abrevHasFinish = $DataFinish['club_abrev'];
            //UpCase de $Tclub_abrev en $club_abrev
            $club_abrev = strtoupper($Tclub_abrevHasFinish);


            echo $name ." ". $firstname ." de ". $club_abrev;
            echo '<br />';
        }
        echo "<br/><br/>";
    }
    unset($value);
    unset($key);

    echo "<br/><br/><br/><br/><br/>";

    $qHasFinish = $bdd->query(
    'SELECT name, firstname FROM competitors 
    WHERE IsOnStart = 0 
    AND IsOnRun = 0 
    AND IsFinish = 1 
    AND IsHere = 1');


// $pdo est un objet PDO
try{
    $qHasFinish->execute();
    $HasFinishDatas = $qHasFinish->fetchAll();
}
catch(Exception $e)
{
    exit('<b>Catched exception at line '. $e->getLine() .' (code : '. $e->getCode() .') :</b> '. $e->getMessage());
}
foreach($HasFinishDatas as $HasFinishData) {
    echo '<pre>';
    var_dump($HasFinishData);
    echo '</pre>';
    echo '<br />';
}

////

        //SetUp les vriables
        /*
        $sqlGettingFinishData = 
          ('SELECT race1.start_time, 
          race1.finish_time, 
          race1.penalty, 
          race1.result_time, 
          competitors.number, 
          competitors.name, 
          competitors.firstname, 
          competitors.club_abrev 
     FROM race1 
          INNER JOIN competitors 
                    ON race1.number = competitors.number 
     WHERE  competitors.ishere = 1 
     AND competitors.isfinish = 1
     ORDER BY competitors.sex, 
               competitors.categorie_number,
               race1.result_time ASC    ');

    $qFinishData = $bdd->query($sqlGettingFinishData);

    $FinishData = $qFinishData->fetch();
    $name = $FinishData['name'];
    $number = $FinishData['number'];
    $club = $FinishData['club_abrev'];

        echo "$name, n°$number du $club <br/>";
    //
    */
        ?>
</body>
</html>