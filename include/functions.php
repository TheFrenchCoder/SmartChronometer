<?php
//date_default_timezone_set('Indian/Reunion');
function bddDebug()
{
    echo 
    "
    <div align=\"center\">
		if (isset($errors)) { debug($errors); }
    </div>
    ";
}

# Fonction de debugage du parametre
function debug($variable){
    echo '<pre>' . print_r($variable, true) . '</pre>';
}

?>