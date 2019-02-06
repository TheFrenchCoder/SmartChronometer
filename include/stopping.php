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
    $currentTime = microtime(true);
    //todo: THE GOAL => $currentTime = date ('H:i:s:U',microtime(true));

    $infos["[✔] numberOfSelectedCompetitor"] = "Le n° de dossard du compétiteur sélectionné '$number' existe!";

        if ($number > 0) {
            //* Si le $number du competiteur est conforme à [$number > 0]

            $infos["[✔] correctNumberOfSelectedCompetitor"] = "Le n° de dossard du compétiteur sélectionné '$number' est conforme! [\$number > 0]";

            if ($finish == 1) {
                //* Si l'arrêt du chrono pour le competiteur n° $number est donné

                $infos['[✔] sendingRequestFinishCompetitor'] = "La requête de départ du n° '$number' a été recu par le serveur!";

                try {   //Set le temps d'arrivée du competiteur
                    $sqlFinishRace = "UPDATE race1 SET FinishTime = '$currentTime' WHERE number = $number";
                    $qFinishRace= $bdd->prepare($sqlFinishRace);
                    $qFinishRace->execute([$currentTime, $number]);
                    $infos['[✔] successRequestFinishRaceUpdateFinalTime'] = "Le compétiteur n° '$number' a fini a: $currentTime";
                } catch (PDOException $e) {
                    $warning['[❌] errorRequestFinishRaceUpdateFinalTime'] = $e->GETMessage();
                }

                try {
                    //SetUp les vriables
                    $sqlGettingDataForResultTime = "SELECT startTime, finishTime, penalty FROM race1 WHERE number = ?";
                    $qResultTime = $bdd->prepare($sqlGettingDataForResultTime);
                    $qResultTime->execute(array($number));

                    $dataResultTime = $qResultTime->fetch();

                            $startTime = $dataResultTime['startTime']; 
                            $finishTime =  $dataResultTime['finishTime'];
                            $penalty =  $dataResultTime['penalty'];

                            $difference = $finishTime - $startTime;
                            $resultTime = $difference + $penalty;

                            //Update la DB
                            $sqlSetResultTime = "UPDATE race1 SET resultTime = ? WHERE number = ?";
                            $qSetResultTime= $bdd->prepare($sqlSetResultTime);
                            $qSetResultTime->execute(array($resultTime, $number));

                } catch (PDOException $e) {
                    $warning['[✔] errorRequestUpdateResultTime'] = $e->GETMessage();
                }

                
                

                try {
                    //* OK
                    $sqlStartCompetitors = "UPDATE competitors SET IsOnStart = '0', IsOnRun = '0', IsFinish = '1', IsHere = '1' WHERE number = $number";
                    $qStartCompetitors= $bdd->prepare($sqlStartCompetitors);
                    $qStartCompetitors->execute([$number]);
                    $infos['[✔] successRequestFinishCompetitor'] = "Le compétiteur n° '$number' a fini selon la table 'competitors'";
                } catch (PDOException $e) {
                    $warning['errorRequestStartCompetitor'] = $e->GETMessage();
                }

                if (!isset($e)) {
                    $infos['[✔] successRequestFinishGlobal'] = "L'arrêt du chrono pour le competiteur n° $number a été donné! Et a fini sa course en $resultTime!";
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
                //* Si le paramètre $_GET['number'] n'existe pas
                $warning["[✖] incorrectNumberOfSelectedCompetitor"] = "Le n° de dossard du compétiteur sélectionné '$number' est non conforme! [\$number > 0]";

        }
}
        #Refresh la page
        //echo "<meta http-equiv=\"refresh\" content=\"1;url=./start.php\"/>";
