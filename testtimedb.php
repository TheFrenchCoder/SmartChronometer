<?php 

try {
$bdd = new PDO('mysql:host=localhost;dbname=dbchrono;charset=utf8', 'root', 'espace21');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} 

catch(Exception $e) {
die('Erreur : '.$e->getMessage());

}

//SetUp les vriables
$sqlGettingAllData = "SELECT startTime, finishTime, penalty FROM race1 WHERE number = 1";
$qAllData = $bdd->prepare($sqlGettingAllData);
$qAllData->execute();

$AllData = $qAllData->fetch();
$startTime = $AllData['startTime'];
$finishTime = $AllData['finishTime'];
$penalty = $AllData['penalty'];

$diff = $finishTime - $startTime;
$resultTime = $diff + $penalty;

echo "Start time";
echo "<br/>";
echo "Unix: " . $startTime;
echo "<br/>";
echo "Time: " . date("H:i:s.U", $startTime);  
echo "<br/>";
echo gettype($startTime);
echo "<br/>";
echo "<br/>";

echo "Finish time";
echo "<br/>";
echo "Unix: " . $finishTime;
echo "<br/>";
echo "Time: " . date("H:i:s.U", $finishTime);  
echo "<br/>";
echo gettype($finishTime);
echo "<br/>";
echo "<br/>";

echo "Diff time";
echo "<br/>";
echo "Double: " . $diff;
echo "<br/>";
echo "Time: " . date("H:i:s.U", $diff);  
echo "<br/>";
echo gettype($diff);
echo "<br/>";
echo "<br/>";

echo "Penalty";
echo "<br/>";
echo "Unix: " . $penalty;
echo "<br/>";
echo "Time: " . date("H:i:s.U", $penalty);  
echo "<br/>";
echo gettype($penalty);
echo "<br/>";
echo "<br/>";

echo "result time";
echo "<br/>";
echo date("H:i:s.U", $resultTime);