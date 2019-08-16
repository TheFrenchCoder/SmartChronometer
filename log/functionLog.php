<?php

$filename = "log.txt";
$path = $filename;
$file = fopen($path, "a"); // for reading
//fseek($file,SEEK_END); // poser le point de lecture à la fin du fichier
//fputs($file,$log); // ecrire dans ce texte

if (isset($username)) {
    echo "<br/>";
    echo "Ip: " . $_SERVER['REMOTE_ADDR'];
    echo "<br /> $username existe ! <br />";

    if (strstr($_SERVER['REMOTE_ADDR'], '.') !== false) {
        //Cas d'une connexion en externe au serveur hôte
        echo "Con. en ext.";
        ecrire_log(
            "info",
            null,
            $_SERVER['REMOTE_ADDR'],
            "Login as '" . $username . "'",
            null);
    }elseif (strstr($_SERVER['REMOTE_ADDR'], ':') !== false) {
        echo "Con. en int.";
        ecrire_log(
            "info",
            null,
            $_SERVER['REMOTE_ADDR'],
            "Login as '" . $username . "'" . $username . "'",
            null);
    }else {
        echo "<!>";
        ecrire_log(
            "error",
            null,
            $_SERVER['REMOTE_ADDR'],
            "Login as '" . $username . "'",
            null);
    }
}

if (file_exists($filename)) {
    chmod($filename, 0777);
    echo "The file $filename exists";
}

// Lit une page web dans un tableau.
$lines = file($path);

// Affiche toutes les lignes du tableau comme code HTML, avec les numéros de ligne
foreach ($lines as $line_num => $line) {
    echo "<b>Line #{$line_num}</b>> " . htmlspecialchars($line) . " <br />\n";
}

fclose($file); //fermer le fichier


function sire_log($type, $user, $domain, $action, $details){

    /* ---- Remplacement du $type si il est null ---- */

        if (strcasecmp($type,"info") == 0) {$type = "INFO";}
        elseif (strcasecmp($type,"error") == 0){$type = "ERROR";}
        else {$type = "Default";}

    //-----\\ END  //-----\\

    /* ---- Remplacement du $user si il est null ---- */


        if ($user == null) {$user = "";}

    //-----\\ END  //-----\\

    /* ---- Remplacement du $domain si il est null ---- */

        if ($domain == null) {$domain = "";}
        if (strstr($_SERVER['REMOTE_ADDR'], ':') !== false) {$domain = "LocalHost";}

    //-----\\ END  //-----\\

    /* ---- Remplacement du $action si il est null ---- */

        if ($action == null) {$action = "";}

    //-----\\ END  //-----\\

    /* ---- Remplacement du $details si il est null ---- */

        if ($details == null) {$details = "";}

    //-----\\ END  //-----\\

    /* ---- Remplacement du $date('F') se sont les mois qui sont la en anglais 
            par un char traduit en Fr ---- */

        // Jan : January
        if (strcasecmp(date("F"),"February") == 0) {$mouth =  " Févr.";}
        elseif (strcasecmp(date("F"),"March") == 0) {$mouth = "Mars";}
        elseif (strcasecmp(date("F"),"April") == 0) {$mouth = "Avr.";}
        elseif (strcasecmp(date("F"),"May") == 0) {$mouth = "Mai";}
        elseif (strcasecmp(date("F"),"June") == 0) {$mouth = "Juin";}
        elseif (strcasecmp(date("F"),"July") == 0) {$mouth = "Juill.";}
        elseif (strcasecmp(date("F"),"August") == 0) {$mouth = "Août";}
        elseif (strcasecmp(date("F"),"September") == 0) {$mouth = "Sept.";}
        // Oct : October
        // Nov : November
        elseif (strcasecmp(date("F"),"December") == 0) {$mouth = "Déc.";}

    //-----\\ END  //-----\\

    /* ---- Remplacement du $date('D') se sont les jours qui sont la en anglais 
            par un char traduit en Fr ---- */

        if (date("l") == "Monday") {$dayLetters = "Lundi";}
        elseif (date("l") == "Tuesday") {$dayLetters = "Mardi";}
        elseif (date("l") == "Wednesday") {$dayLetters = "Mercr.";}
        elseif (date("l") == "Thursday") {$dayLetters = "Jeudi";}
        elseif (date("l") == "Friday") {$dayLetters = "Vendr.";}
        elseif (date("l") == "Saturday") {$dayLetters = "Sam.";}
        elseif (date("l") == "Sunday") {$dayLetters = "Dim.";}

    //-----\\ END  //-----\\

    /* ---- Remplacement du $date('d') qui est le n° du jour dans le mois ---- */

        if (strcasecmp(date("j"),"1") == 0) {$dayNumber = "1er";
        }else {$dayNumber = date("j");}

    //-----\\ END  //-----\\

    /* ---- Initialisation de $time ---- */

        $time = date("H") . ":" . date("i") . ":" . date("s");

    //-----\\ END  //-----\\

    /* ---- Initialisation de $date ---- */

        $date = $dayLetters . ", " . $dayNumber . " " . $mouth;

    //-----\\ END  //-----\\

    /* ---- Initialisation de $path ---- */

        if (PHP_OS == "Linux"){
                $path = "";
        }elseif (PHP_OS ==  "WINNT"){
            //$path = "../log/" . $user . ".txt";
            $path = $_SERVER["DOCUMENT_ROOT"]."/log/log.txt";
        }

    //-----\\ END  //-----\\

    /* ---- Initialisation de $log ---- */

        $log= "[" . $date . " à " . $time . "] [" .$type . "] [" . $user . "@" . $domain . "] " . $action . " ( " . $details . " )" . "\r\n";

    //-----\\ END  //-----\\

    /* ---- Initialisation final + écriture ---- */

        $file = fopen($path,'a+') or die("Unable to open file!"); // ouvrir le fichier ou le créer
        rewind($file); // poser le point de lecture au début du fichier
        fputs($file,$log); // ecrire dans ce texte
        fclose($file); //fermer le fichier

    //-----\\ END  //-----\\


}

function get_log($type, $user, $domain, $action, $details){
    return;
    // TODO: Faire un get de $log comme un log de ecrire_log()
}



?>