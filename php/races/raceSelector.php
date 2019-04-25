<?php
// On démarre la session si besoin dans le futur
session_start();

//*include_once
include_once $_SERVER["DOCUMENT_ROOT"]."/include/part/navbar.php";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
     <title>Selecteur de course</title>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="css/XXX.css"/>
</head>

<body>
    <div class="content">
        <form action="" method="get"    >

            <label for="raceSelector">Choisis une course:</label>
            <input list="races" id="raceSelector" name="race" />

            <datalist id="races">
                <option value="Course_1">
                <option value="Course_2">
            </datalist>
            
            <input type="submit" value="Selectionner!">
        </form>
    </div>
</body>
</html>

<?php
//DEBUG
include_once $_SERVER['DOCUMENT_ROOT']."/include/debug.php";

//FOOTER
include_once $_SERVER['DOCUMENT_ROOT']."/include/part/footer.php";
?>