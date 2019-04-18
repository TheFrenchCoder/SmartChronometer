<?php

//* START => number=$dossard & start=1
//* ABS => number=$dossard & missing=1
//* HERE == 0 et qu'il est present => number=$dossard & present=1

//* 

if (isset($_GET['number'])) {
    //* Si le $number du competiteur est renseigner
    
    //*
    $number = isset($_GET['number']) ? $_GET['number'] : 'empty';
    $start = isset($_GET['start']) ? $_GET['start'] : 'empty';
    $missing = isset($_GET['missing']) ? $_GET['missing'] : 'empty';
    $present = isset($_GET['present']) ? $_GET['present'] : 'empty';

    $currentTime = microtime(true);
    $defaultTime = date(microtime(true));
    //THE GOAL => $currentTime = date ('H:i:s:U',microtime(true));

    /*
    $U = date("U");
    $U = substr($U, 0, 6);
    echo $U;
    */


    $infos["[✔] numberOfSelectedCompetitor"] = "Le n° de dossard du compétiteur sélectionné '$number' existe!";

    if ($number > 0) {
        //* Si le $number du competiteur est conforme à [$number > 0]

        $infos["[✔] correctNumberOfSelectedCompetitor"] = "Le n° de dossard du compétiteur sélectionné '$number' est conforme! [\$number > 0]";

        if ($start == 1) {
            //* Si le départ du compétiteur n° $number est donné

            $infos['[✔] sendingRequestStartCompetitor'] = "La requête de départ du n° '$number' a été recu par le serveur!";

            try {//INSERT INTO race1 (number, StartTime) VALUES (?,?)
                $sqlStartRace = "INSERT INTO race1 (number, start_time, finish_time, penalty, result_time) VALUES (?,?,?,?,?)";
                $qStartRace = $bdd->prepare($sqlStartRace);
                $qStartRace->execute([$number, $currentTime, $currentTime, '0', $currentTime]);
                //*
                /*$qStartRace = $bdd->prepare($sql["StarRace1"]);
                $qStartRace->execute($dStartRace);*/
            } catch (PDOException $e) {
                $warning['errorRequestStartRace1'] = $e->GETMessage();
            }

            try {
                //*
                $sqlStartCompetitors = "UPDATE competitors SET IsOnStart = '0', IsOnRun = '1' WHERE number = $number";
                $qStartCompetitors = $bdd->prepare($sqlStartCompetitors);
                $qStartCompetitors->execute([$number]);
                $infos['[✔] successRequestStartCompetitor'] = "Le compétiteur n° '$number' est en course selon la table 'competitors'";
            } catch (PDOException $e) {
                $warning['errorRequestStartCompetitor'] = $e->GETMessage();
            }

            if (!isset($e)) {
                $infos['[✔] successRequestStartGlobal'] = "Le départ du dossard n° '$number' a été donné! Et est dorénavant en course!";
            }
        } elseif ($missing == 1) {
            //* Si le compétiteur n° $umber est absent

            $infos['[✔] sendingRequestMissingCompetitor'] = "La requête d'abscence du n° '$number' a été recu par le serveur!";

            try {
                $sqlMissingCompetitors = "UPDATE competitors SET IsHere = 0 WHERE number = $number";
                $qMissingCompetitors = $bdd->prepare($sqlMissingCompetitors);
                $qMissingCompetitors->execute([$number]);
                $infos['[✔] successRequestMissingCompetitor'] = "Le compétiteur au dossard n° '$number' est désormais absent!";
            } catch (PDOException $e) {
                $warning['errorRequestMissingCompetitor'] = $e->GETMessage();
            }
        } elseif (isset($present)) {
            if ($present == 1) {
                //* Si le compétiteur n° $number est présent
                //* - SI il est absent => OK SINON ERROR 
                //* - SI il est pas en course => OK SINON ERROR 

                $infos['[✔] sendingRequestPresentCompetitor'] = "La requête de présence du n° '$number' a été recu par le serveur!";

                try {
                    $sqlPresentCompetitors = "UPDATE competitors SET IsOnStart = '1', IsOnRun = '0', IsFinish = '0', IsHere = '1' WHERE number = $number";
                    $qPresentCompetitors = $bdd->prepare($sqlPresentCompetitors);
                    $qPresentCompetitors->execute();
                    $infos['[✔] successRequestPresentCompetitor'] = "Le compétiteur au dossard n° '$number' est désormais présent!";
                } catch (PDOException $e) {
                    $warning['errorRequestPresentCompetitor'] = $e->GETMessage();
                }
            } elseif ($present == 2) {
                $infos['[✔] sendingRequestAtStartCompetitor'] = "La requête d'annulation du n° '$number' a été recu par le serveur!";

                try {//* Mets au départ et présent le compétiteurs correspondant au numéro donnée dans $number == $_GET['number']
                    $sqlPresentCompetitors = "UPDATE competitors SET IsOnStart = '1', IsOnRun = '0', IsFinish = '0', IsHere = '1' WHERE number = $number";
                    $qPresentCompetitors = $bdd->prepare($sqlPresentCompetitors);
                    $qPresentCompetitors->execute();
                    $infos['[✔] successRequestPresentCompetitor'] = "Le compétiteur au dossard n° '$number' est désormais au départ!";
                } catch (PDOException $e) {
                    $warning['errorRequestPresentCompetitor'] = $e->GETMessage();
                }

                try {//* Supprime l'entrée correspondante au numéro donnée dans $number == $_GET['number']
                    $sqlPresentRace = "DELETE FROM race1 WHERE number = $number";
                    $qPresentRace = $bdd->prepare($sqlPresentRace);
                    $qPresentRace->execute();
                    $infos['[✔] successRequestPresentCompetitor'] = "Le compétiteur au dossard n° '$number' est désormais au départ!";
                } catch (PDOException $e) {
                    $warning['errorRequestPresentCompetitor'] = $e->GETMessage();
                }
            } else {
                $warning['errorOnVariablePRESENT'] = "La variable 'present' n\'est pas conforme! [0 >= \$number <= 1]";
            }
        } else {
            //* XXX
            
			// code...

        }

        //Refresh la page
        //?echo "<meta http-equiv=\"refresh\" content=\"1;url=./start.php\"/>";

    } else {
        $warning["[✖] incorrectNumberOfSelectedCompetitor"] = "Le n° de dossard du compétiteur sélectionné '$number' est non conforme! [\$number > 0]";
    }
}
