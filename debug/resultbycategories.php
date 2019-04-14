Permet d'afficher les competiteurs en fonction de leur categories
<?php 

echo "<br/>";

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
        echo "Cat. n°$key/ $value<br/>";

        $sqlGettingTest = 
        ('SELECT 
        name, 
        firstname, 
        club_abrev 
        FROM competitors
        WHERE competitors.categorie_number =?
        ');
        $stmGettingTest = $bdd->prepare($sqlGettingTest);
        $stmGettingTest->execute(array($key));

        $GettingTestDatas = $stmGettingTest->fetchAll();
        foreach($GettingTestDatas as $GettingTestData) {
            $name = $GettingTestData['name'];
            $firstname = $GettingTestData['firstname'];
            $club_abrev = $GettingTestData['club_abrev'];
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