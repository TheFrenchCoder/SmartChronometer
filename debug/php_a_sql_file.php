<?php 

try {
$bdd = new PDO('mysql:host=localhost;dbname=dbchrono;charset=utf8', 'root', 'espace21');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} 

catch(Exception $e) {
die('Erreur : '.$e->getMessage());

}   

    function executeSqlFile($sqlFileToExecute){
        $stm ="ee";
    }

    $sql = file_get_contents("le fichier sql");
    $sql_array = explode (";",$sql);
    foreach ($sql_array as $val) {
    mysql_query($val);
    /*Si cest un espace, il suffit de mettre
    explode("; ",$sql)
    Pour une nouvelle ligne, ce serait
    explode(";\n",$sql)
    (\r\n ou \r, faut voir)*/
    }

    function executeSqlFile2(){
    $req =file_get_contents("bdd.sql");
    Sql($req); // tu execute la requête avec le fichier sql entier
    }

function executeQueryFile($filesql) {
    $query = file_get_contents($filesql);
    $array = explode(";\n", $query);
    $b = true;
    for ($i=0; $i < count($array) ; $i++) {
        $str = $array[$i];
        if ($str != '') {
             $str .= ';';
             $b &= mysql_query($str);  
        }  
    }
     
    return $b;
}