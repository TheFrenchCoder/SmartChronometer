<?php

//* FINISH => number=$dossard & start=1
//* INRACE => number=$dossard & missing=1

//* 


if (isset($_GET['number'])) {
    //* Si le $number du competiteur est renseigner
    
    echo "finish = " . $_GET['finish'];

    //*
    $number = isset($_GET['number']) ? $_GET['number'] : 'empty';
    $finish = isset($_GET['finish']) ? $_GET['finish'] : 'empty';
    $inRace = isset($_GET['inRace']) ? $_GET['inRace'] : 'empty';
    $currentTime = date ('H:i:s',time());
    //todo: THE GOAL => $currentTime = date ('H:i:s:U',time());

    $infos["[✔] numberOfSelectedCompetitor"] = "Le n° de dossard du compétiteur sélectionné '$number' existe!";

    if ($number > 0) {
        //* Si le $number du competiteur est conforme à [$number > 0]

        $infos["[✔] correctNumberOfSelectedCompetitor"] = "Le n° de dossard du compétiteur sélectionné '$number' est conforme! [\$number > 0]";

        if ($finish == 1) {
            //* Si l'arrêt du chrono pour le competiteur n° $number est donné

            $infos['[✔] sendingRequestFinishCompetitor'] = "La requête de départ du n° '$number' a été recu par le serveur!";

            try {//INSERT INTO race1 (number, StartTime) VALUES (?,?)
                $sqlFinishRace = "UPDATE race1 SET FinishTime = '$currentTime' WHERE number = $number";
                $qFinishRace= $bdd->prepare($sqlFinishRace);
                $qFinishRace->execute([$currentTime, $number]);
                $infos['[✔] successRequestFinishRace'] = "Le compétiteur n° '$number' a fini a: $currentTime";
            } catch (PDOException $e) {
                $warning['errorRequestFinishRace1'] = $e->GETMessage();
            }

            try {
                //*
                $sqlStartCompetitors = "UPDATE competitors SET IsOnStart = '0', IsOnRun = '0', IsFinish = '1', IsHere = '1' WHERE number = $number";
                $qStartCompetitors= $bdd->prepare($sqlStartCompetitors);
                $qStartCompetitors->execute([$number]);
                $infos['[✔] successRequestFinishCompetitor'] = "Le compétiteur n° '$number' a fini selon la table 'competitors'";
            } catch (PDOException $e) {
                $warning['errorRequestStartCompetitor'] = $e->GETMessage();
            }

            if (!isset($e)) {
                $infos['[✔] successRequestFinishGlobal'] = "L'arrêt du chrono pour le competiteur n° $number a été donné! Et a fini sa course en !";
            }
            
        }elseif ($missing == 1) {
            //* Si le compétiteur n° $umber est absent

            $infos['[✔] sendingRequestMissingCompetitor'] = "La requête d'abscence du n° '$number' a été recu par le serveur!";

            try {
                $sqlMissingCompetitors = "UPDATE competitors SET IsHere = 0 WHERE number = $number";
                $qMissingCompetitors= $bdd->prepare($sqlMissingCompetitors);
                $qMissingCompetitors->execute([$number]);
                $infos['[✔] successRequestMissingCompetitor'] = "Le compétiteur au dossard n° '$number' est désormais absent!";
            } catch (PDOException $e) {$warning['errorRequestMissingCompetitor'] = $e->GETMessage();}

        }

    } else {
            //* XXX
            $warning["[✖] incorrectNumberOfSelectedCompetitor"] = "Le n° de dossard du compétiteur sélectionné '$number' est non conforme! [\$number > 0]";

    }
}
        #Refresh la page
        //echo "<meta http-equiv=\"refresh\" content=\"1;url=./start.php\"/>";
