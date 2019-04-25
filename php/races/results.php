<?php 


/////////////////////////////////////////////////////////////////////////////////
// TODO: Faire un classement en fonction de la categorie, et de l'embarcation. //
/////////////////////////////////////////////////////////////////////////////////


// On démarre la session si besoin dans le futur
session_start();
include_once $_SERVER["DOCUMENT_ROOT"]."/include/bdd/bddConnectByRoot.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/include/part/navbar.php";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
     <title>Résultats</title>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="/css/start.css" />
</head>

<body>

<h1>Résultats:</h1>

<?php

$arrCategories = array(
	1 => "Poussin",
	2 => "Benjamin",
	3 => "Minime",
	4 => "Cadet",
	5 => "Junior",
	6 => "Senior",
     7 => "Vétérant");
     
     foreach ($arrCategories as $key => $value){

		echo "
		<div class=\"header\">

		</div>

		<table>
			</TR>
				<TH>Dossard</TH>
				<TH>Nom Prénom</TH>
				<TH>Club</TH>
				<TH>Temps initial</TH>
				<TH>Temps d'arrivée</TH>
				<TH>Pénalitées</TH>
				<TH>Temps final</TH>
				<TH>Place</TH>
			</TR>
		";
		
		echo "<br/><div align=\"center\">$value</div>";

		$sqlHasFinish = 
		('SELECT 
			race1.start_time, 
			race1.finish_time, 
			race1.penalty, 
			race1.result_time, 
			competitors.number, 
			competitors.name, 
			competitors.firstname, 
			competitors.club_abrev 
		FROM 
			race1 
		INNER JOIN competitors 
			ON race1.number = competitors.number 
		WHERE 
			competitors.ishere = 1 
			AND competitors.isfinish = 1 
			AND competitors.categorie_number = ? 
		ORDER BY 
			competitors.sex, 
			competitors.categorie_number, 
			race1.result_time ASC
		');
		$qHasFinish = $bdd->prepare($sqlHasFinish);
		$qHasFinish->execute(array($key));

		$DatasFinish = $qHasFinish->fetchAll();

		//* RANK SET:
		$rank = 0;
		
		foreach($DatasFinish as $DataFinish) {

			// * Setting variables
			$start_time = $DataFinish['start_time'];
			$finish_time = $DataFinish['finish_time'];
			$penalty = $DataFinish['penalty'];
			$result_time = $DataFinish['result_time'];
			$number = $DataFinish['number'];

			// * Affectation des variables
			// Stocke $data[firstname] dans une variable temporaire
			$TfirstnameHasFinish = $DataFinish['firstname'];
			// Stocke toutes la lettres sauf la 1ere dans une variable temporaire
			$TrestHasFinish = substr($TfirstnameHasFinish, 1);
			//LowerCase de $Trest en $rest
			$restHasFinish = strtolower($TrestHasFinish);
			//UpCase de $Tfirstname en $firstname
			$firstname = strtoupper($TfirstnameHasFinish);
			//UpCase de $data[name] en $name
			$name = $DataFinish['name'];
			// Stocke $data[club_abrev] dans une variable temporaire
			$Tclub_abrevHasFinish = $DataFinish['club_abrev'];
			//UpCase de $Tclub_abrev en $club_abrev
			$club_abrev = strtoupper($Tclub_abrevHasFinish);

			//* RANK :
			$rank += 1;
			
			//TODO: ADD ALL OF THE CODE HERE :] ?>

			
			<div class="Dossard_Result">
				</TR> <form method=\"GET\" action=\"\">
				<?php echo "<TD> <p>$number</p> </TD>"?>
			</div>
		
			<div class="Nom_Prenom_Result">
				<?php
				//Affiche le dossard du competiteur
				echo "<TD><p>$name $firstname[0]$restHasFinish</p></TD>";
				?>
			</div>

			<div class="Club_Result">
				<?php
				//Affiche le club du compétiteur
				echo "<TD><p>$club_abrev</p></TD>";
				?>
			</div>

			<div class="initialTime_Result">
				<?php
				//Affiche le temps de départ du compétiteur
				echo "<TD> ". date('H:i:s.U', $start_time). " </TD>";
			?>
			</div>

			<div class="finishTime_Result">
				<?php
				//Afficje le temps d'arrivée du compétiteur
				echo "<TD> " .date('H:i:s.U', $finish_time). " </TD>";
				?>
			</div>
			
			<div class="Penalty_Result">
				<?php
				//SAffiche les pénalitées du compétiteur
				echo "<TD> <p>$penalty</p> </TD>";
				?>
			</div>

			<div class="FinalTime_Result">
				<?php
				echo "<TD> " .date("H:i:s.U", $result_time). " </TD>";
				?>
			</div>

			<div class="Rank_Result">
				<?php
				if ($rank == 0) {
					echo "<TD> undefined </TD>";
					//! ERROR
				} elseif ($rank == 1) {
					echo "<TD> " .$rank. "er </TD>";
				}elseif ($rank >= 2) {
					echo "<TD> " .$rank. "ième </TD>";
				}
				
				?>
			</div>

			<?php
			echo "</TR>";  
		}
	   // * Séparation entre les tableaux des catégories et leur header contenant le nom de la catégorie 
	   //echo "<br/><br/>";
    }
    unset($value);
    unset($key); 

?>
</body>
</html>

<?php

//DEBUG
include_once $_SERVER['DOCUMENT_ROOT']."/include/debug.php";

//FOOTER
include_once $_SERVER['DOCUMENT_ROOT']."/include/part/footer.php";
?>
