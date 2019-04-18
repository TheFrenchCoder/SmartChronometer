<?php
//* Getting content of the json config file and save value.
$str = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/src/_config.json');
$json = json_decode($str, true); // decode the JSON into an associative array
$environment = $json['environment'];
?>

<html>
<a href="/index.php">Acceuil</a>
<a href="/php/disconnect.php.php">Déconnexion</a>
<?php
if($environment == "production"){
    echo"<a href='/debug/index.php'>Debug</a>";
}
?>
<html/>

<?php
//TODO: Add other primary location of the website
//*echo"<a href='DOCUMENT_ROOT/index.php>Acceuil</a>";
?>