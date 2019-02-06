<?php 
$currentTime = date ('H:i:s',time());
echo microtime(true);
echo "<br/>";
echo gettype(microtime(true));
echo "<br/>";

$milliseconds = round(microtime(true) * 1000);

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

try {
$bdd = new PDO('mysql:host=localhost;dbname=dbchrono;charset=utf8', 'root', 'espace21');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} 

catch(Exception $e) {
die('Erreur : '.$e->getMessage());

}


$time1 = time();
$time2 =  time() + (7 * 60);;
$diff = $time2 - $time1;
$penalty = 10;
$resultTime = $diff + $penalty;

echo "Unix: " . $time1;
echo "<br/>";
echo "Time: " . date("H:i:s", $time1);  
echo "<br/>";
echo gettype($time1);
echo "<br/>";
echo "<br/>";

echo "Unix: " . $time2;
echo "<br/>";
echo "Time: " . date("H:i:s", $time2);  
echo "<br/>";
echo gettype($time2);
echo "<br/>";
echo "<br/>";

echo "Unix: " . $penalty;
echo "<br/>";
echo "Time: " . date("H:i:s", $penalty);  
echo "<br/>";
echo gettype($penalty);
echo "<br/>";
echo "<br/>";

echo "Unix: " . $diff;
echo "<br/>";
echo "Time: " . date("H:i:s", $diff);  
echo "<br/>";
echo gettype($diff);
echo "<br/>";
echo "<br/>";

echo date("H:i:s", $resultTime);