<?php

//* Connnection à la base de donnée
include_once $_SERVER["DOCUMENT_ROOT"]."/include/bdd/bddConnectByRoot.php";
//* Get Json of the app
include_once $_SERVER["DOCUMENT_ROOT"]."/include/json.php";

//* PENALTY => number=$dossard & penalty=$penalty_amount
//* REVERSE PENALTY => number=$dossard & reverse=1


//* SET VARIABLES
$competitor_number = isset($_GET['number']) ? $_GET['number'] : 'empty';
$penalty_amount = isset($_GET['penalty_amount']) ? $_GET['penalty_amount'] : 'empty';
$reverse = isset($_GET['reverse']) ? $_GET['reverse'] : 'empty';
$penalty_id = isset($_GET['penalty_id']) ? $_GET['penalty_id'] : 'empty';
$surrend = isset($_GET['surrend']) ? $_GET['surrend'] : 'empty';
$gate_number = isset($_GET['gate']) ? $_GET['gate'] : 'empty';
$user_id = 0;

if (isset($_GET['number'])) {
    //* Si le $number du competiteur est renseigner

    $infos["[✔] numberOfSelectedCompetitor"] = "Le n° de dossard du compétiteur sélectionné '$competitor_number' existe!";

    if ($competitor_number > 0) {
        //* Si le $number du competiteur est conforme à [$number > 0]

        $infos["[✔] correctNumberOfSelectedCompetitor"] = "Le n° de dossard du compétiteur sélectionné '$competitor_number' est conforme! [\$number > 0]";

        if ($reverse == "empty") {

            if ($surrend == "empty") {
                //* Si on applique une pénalité

                //* Ajout de la pénalité dans tbl 'penalty'
                $infos['[✔] sendingRequestPenaltyCompetitor'] = "La requête d'ajout de pénalitées du n° '$competitor_number' a été recu par le serveur!";

                try {
                    $sqlJudgeCompetitor = "INSERT INTO penalty (gate_number, competitor_number, penalty_amount, user_id) VALUES (?,?,?,?)";
                    $qJudgeCompetitor = $bdd->prepare($sqlJudgeCompetitor);
                    $qJudgeCompetitor->execute([$gate_number, $competitor_number, $penalty_amount, $user_id]);
                    $infos['[✔] InsertCompetitorPenalty'] = "Add ".$penalty_amount." to ".$competitor_number." on ".$gate_number." by ".$user_id ;
                } catch (PDOException $e) {
                    $warning['errorRequestJudgeCompetitor'] = $e->GETMessage();
                }

                SumPenalty($competitor_number);

            }elseif ($surrend == 1) {
                
                $infos['[✔] sendingRequestSurrendCompetitor'] = "La requête d'abandon du n° '$competitor_number' a été recu par le serveur!";
                SumPenalty($competitor_number);
            }else {
                # code...
            }
        } elseif ($reverse == 1) {
                    //* S

                    $infos['[✔] sendingRequestReversePenaltyCompetitor'] = "La requête de suppression de pénalitées du n° '$competitor_number' a été recu par le serveur!";

                    try {
                        $sqlReverseJudgingCompetitor = "DELETE FROM penalty WHERE id = $penalty_id";
                        $qReverseJudgingCompetitor = $bdd->prepare($sqlReverseJudgingCompetitor);
                        $qReverseJudgingCompetitor->execute();
                    } catch (PDOException $e) {
                        $warning['errorRequestReversePenaltyCompetitor'] = $e->GETMessage();
                    }

        }else {
            # code...
        }

        //Refresh la page
        //?echo "<meta http-equiv=\"refresh\" content=\"1;url=./start.php\"/>";

    } else {
    $warning["[✖] incorrectNumberOfSelectedCompetitor"] = "Le n° de dossard du compétiteur sélectionné '$competitor_number' est non conforme! [\$number > 0]";
}  

}

/**
 * Make the sum of all penalty of a specified competitor
 *
 * @param int competitor_id
 * 
 * @author LOUVIGNY Raphaël <https://github.com/TheFrenchCoder>
 * @return true when succes
 */ 
function SumPenalty(int $competitor_number)
{
    global $bdd, $json;
    $penalty_total = NULL;
    $CurrentRace = "race1";

    // Get penalties of the competitor
    try {
        $sqlSelectPenalty = "SELECT SUM(penalty_amount) AS penalty_amount FROM $CurrentRace, penalty WHERE ".$CurrentRace.".number = penalty.competitor_number && ".$CurrentRace.".number = :competitor_number";
        $qSelectPenalty = $bdd->prepare($sqlSelectPenalty);
        $qSelectPenalty->execute([$competitor_number]);
        $infos['[✔] selectPenalty'] = "Les pénalitées de $competitor_number ont toutes été récupérées";
    } catch (PDOException $e) {
        $warning['errorRequestSelectPenalty'] = $e->GETMessage();
    }

    // Calcula of the sum of penalties make directly in the sql request so:
    foreach ($qSelectPenalty as $a) {
        var_dump($a);
        $penalty_total = $a['penalty_amount'];
    }
    $infos['[✔] AdditionOfAllPenalty'] = "Les pénalitées de $competitor_number sont $penalty_total";

    // Set the new sum of penalties into the current race table
    try {
        $sqlUpdateSumPenalty = "UPDATE $CurrentRace SET penalty = $penalty_total";
        $qUpdateSumPenalty = $bdd->prepare($sqlUpdateSumPenalty);
        $qUpdateSumPenalty->execute();

        $infos['[✔] sendingRequestSurrendCompetitor'] = "Les pénalitées de $competitor_number ont toutes été actualisées pour les résultats";
    } catch (PDOException $e) {
        $warning['errorRequestUpdateSumPenalty '] = $e->GETMessage();
    }

    return true;
}