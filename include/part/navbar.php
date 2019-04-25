<?php
include_once $_SERVER['DOCUMENT_ROOT']."/include/json.php";
?>

<html>
<a href="/index.php">Acceuil</a>
<a href="/php/users/disconnect.php">Déconnexion</a>
<?php
if($appEnvironment == "development"){
    echo"<a href='/debug/index.php'>Debug</a>";
}
?>
<html/>

<?php
//TODO: Add other primary location of the website
//*echo"<a href='DOCUMENT_ROOT/index.php>Acceuil</a>";
?>