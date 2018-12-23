<?php
if(isset($_GET[start]) && isset($_GET[number]) && isset($_GET(missing))) {
    $infos["miss"] = "Dossard n°" . $_GET[number] . " est absent"
}else{
    $corrections["send"] = "Le départ n°" . $_GET[number] . " a été donné";
}
?>