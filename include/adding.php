<?php

if (isset($_GET['submit']) and $_GET['submit'] == 1) {

    //Extraction et affectation des variables
    $Tfirstname = $_GET['firstname']; 
    $firstname = strtoupper(substr($Tfirstname, 0, 1)) . strtolower(substr($Tfirstname, 1));

    $Tname = $_GET['name']; 
    $name = strtoupper(substr($Tname, 0, 1)) . strtolower(substr($Tname, 1));

    $Tclub_abrev = $_GET['club']; 
    //UpCase de $Tclub_abrev en $club_abrev
    $club = strtoupper($Tclub_abrev);

    $number = $_GET['number'];

    $sex = $_GET['sex'];

    $categorie_number = $_GET['category'];

    //*Check dans la BDD si le compétieur n'existe pas dejà:
        try {//Compte l'entrée correspondante au numéro donnée dans $number == $_GET['number']
            $qWithSameNumber = $bdd->prepare("SELECT * FROM competitors WHERE number = :number");
            $qWithSameNumber->execute(['number' => $number]); 
            $countSameNumber = $qWithSameNumber ->rowCount();
        } catch (PDOException $e) {
            $warning['[❌] errorSelectCompetitorsWithSameNumber'] = $e->GETMessage();
        }

        try {//Compte l'entrée correspondante au numéro donnée dans $number == $_GET['number']
            $qWithSameIdentity = $bdd->prepare("SELECT * FROM competitors WHERE name = :name AND firstname = :firstname");
            $qWithSameIdentity->execute(['name' => $name, 'firstname' => $firstname]);
            $countSameIdentity = $qWithSameIdentity ->rowCount();
        } catch (PDOException $e) {
            $warning['[❌] errorSelectCompetitorsWithSameIdentity'] = $e->GETMessage();
        }


    if ($countSameIdentity == 0 and $countSameNumber == 0) {

        $arrCategories = array(
            0 => "Test",
			1 => "Poussin",
			2 => "Benjamin",
			3 => "Minime",
			4 => "Cadet",
			5 => "Junior",
			6 => "Senior",
            7 => "Vétérant");
            
        $categorie_name = $arrCategories[$categorie_number];

        //*Ajout du compétiteur 
        $dataInsertCompetitor = [
            'number' => $number,
            'name' => $name,
            'firstname' => $firstname,
            'categorie_name' => $categorie_name,
            'categorie_number' => $categorie_number,
            'sex' => $sex,
            'club' => $club,
            'IsOnRun' => 0,
            'IsOnStart' => 0,
            'IsFinish' => 0,
            'IsHere' => 0
        ];

        try {
            $sqlInsertCompetitor = "INSERT INTO competitors 
            (`number`,
            `name`,
            `firstname`,
            `categorie_name`,
            `categorie_number`,
            `sex`,
            `club_abrev`,
            `IsOnRun`,
            `IsOnStart`,
            `IsFinish`,
            `Ishere`
            ) 
            VALUES 
            (:number, :name, :firstname, :categorie_name, :categorie_number, :sex, :club, :IsOnRun, :IsOnStart, :IsFinish, :IsHere)";

            $qInsertCompetitor= $bdd->prepare($sqlInsertCompetitor);
            $qInsertCompetitor->execute($dataInsertCompetitor);
            $infos['[✔] successInsertCompetitor'] = "Le compétiteur '$name $firstname' dossard n° '$number' à bien été ajouté à la BDD!";
        } catch (PDOException $e) {
            $warning['[❌] errorInsertCompetitor'] = $e->GETMessage();
        }
    }elseif ($countSameIdentity == 1) {
        $warning['[❌] Competitor\'sIdentityAlreadyExist'] = "Il existe déjà un compétiteur avec le même nom";
    }elseif($countSameNumber == 1){
        $warning['[❌] Competitor\'sNumberAlreadyExist'] = "Il existe déjà un compétiteur avec le même nom";
    }else {
        # code...
    }
}

?>