<?php

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

//* VAR DUMP VARIABLE
echo "competitor_number " .$competitor_number. "<br/>";
echo "penalty_amount " .$penalty_amount. "<br/>";
echo "reverse " .$reverse. "<br/>";
echo "penalty_id " .$penalty_id. "<br/>";
echo "surrend " .$surrend. "<br/>";
echo "gate_number " .$gate_number. "<br/>";
echo "user_id " .$user_id. "<br/>";

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

                try {//INSERT INTO race1 (number, StartTime) VALUES (?,?)
                    $sqlJudgeCompetitor = "INSERT INTO penalty (gate_number, competitor_number, penalty_amount, user_id) VALUES (?,?,?,?)";
                    $qJudgeCompetitor = $bdd->prepare($sqlJudgeCompetitor);
                    $qJudgeCompetitor->execute([$gate_number, $competitor_number, $penalty_amount, $user_id]);
                } catch (PDOException $e) {
                    $warning['errorRequestJudgeCompetitor'] = $e->GETMessage();
                }

                //* Calcul de penalty dans tbl 'race1'
                //* 1) Selection des penalité pour le competiteur x
                try {
                    $sqlSelectPenalty = "SELECT race1.number, penalty.penalty_amount FROM race1, penalty WHERE race1.number = penalty.competitor_number && race1.number = $competitor_number";
                    $qSelectPenalty = $bdd->prepare($sqlSelectPenalty);
                    $qSelectPenalty->execute();
                } catch (PDOException $e) {
                    $warning['errorRequestSelectPenalty'] = $e->GETMessage();
                }
                
                $penalty_total = NULL;
            
                foreach ($qSelectPenalty as $dataSelectPenalty) {
                    $penalty_total += $dataSelectPenalty['penalty_amount'];
                }

                    echo "<br/><br/> Penalité total: $penalty_total <br/><br/>";

            }elseif ($surrend == 1) {
                
                $infos['[✔] sendingRequestSurrendCompetitor'] = "La requête d'abandon du n° '$competitor_number' a été recu par le serveur!";

            }else {
                # code...
            }
        } elseif ($reverse == 1) {
                    //* S

                    $infos['[✔] sendingRequestReversePenaltyCompetitor'] = "La requête de suppression de pénalitées du n° '$competitor_number' a été recu par le serveur!";

                    try {//INSERT INTO race1 (number, StartTime) VALUES (?,?)
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