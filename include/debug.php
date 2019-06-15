<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/include/json.php";

if ($appEnvironment == "development") {
    echo "<h1>Debuger</h1>";

    //* echo $infos
    if (isset($infos) && gettype($infos) == "array") {
        echo "<h2>Infos:<h2/>";
        foreach($infos as $key => $value){

            echo "<h4>$key => $value</h4>\n";

        }
    }

    //* echo $warning
    if (isset($warning)) { 

        echo "<h2>Warnings:<h2/>";
        foreach($warning as $key => $value){

            echo "<h4>$key => $value</h4>\n";

        }
    }

    //*Debug général
    echo "<br/>";
    echo "path: '" . basename(__FILE__) ."'";
    echo "<br/>";
    if (!isset($_SESSION['role'])) { 
        $role = "Ø";
    }else {
        $role = $_SESSION['role'];
    }

    if (!isset($_SESSION['username'])) {
        $username = "unknow";
    }else {
        $username = $_SESSION['username'];
    }
    echo "Session: connecté en tant que [" . $role . "]" . $username;
    echo "<br/>";
    echo "<pre> " . var_dump($_SESSION) . " <pre/>";
}
?>