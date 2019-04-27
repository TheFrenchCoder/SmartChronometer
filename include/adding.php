<?php

if (isset($_GET['submit']) and $_GET['submit'] == 1) {

    //Extraction et affectation des variables
    // Stocke $data[firstname] dans une variable temporaire
    $Tfirstname = $_GET['firstname']; 
    // Stocke toutes la lettres sauf la 1ere dans une variable temporaire
    $Trest = substr($Tfirstname, 1); 
    //LowerCase de $Trest en $rest
    $rest = strtolower($Trest); 
    //UpCase de $Tfirstname en $firstname
    $firstname = strtoupper($Tfirstname); 
    //UpCase de $data[name] en $name
    $name = strtoupper($_GET['name']); 
    // Stocke $data[club_abrev] dans une variable temporaire
    $Tclub_abrev = $_GET['club']; 
    //UpCase de $Tclub_abrev en $club_abrev
    $club = strtoupper($Tclub_abrev);

    $number = $_GET['number'];
    $sex = $_GET['sex'];
    $categorie_number = $_GET['category'];

    var_dump($name);
    echo "<br/><br/>";
    var_dump($firstname);
    echo "<br/><br/>";

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
    }else {
        $warning['[❌] CompetitorAlreadyExist...'] = "N'execute pas \$qInsertCompetitor ! [\$countSameIdentity = $countSameIdentity != 0 AND \$countSameNumber = $countSameNumber != 0]";
    }
}

?>