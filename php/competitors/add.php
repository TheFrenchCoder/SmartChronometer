<?php 

// On démarre la session si besoin dans le futur
session_start();
include_once $_SERVER["DOCUMENT_ROOT"]."/include/bdd/bddConnectByRoot.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/include/part/navbar.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/include/adding.php";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
     <title>+ compétiteurs</title>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="/css/add.css" />
</head>

<body>

<h1>Ajout d'un compétiteur:</h1>

<form action="">

<table>

	<tr>
		<td>
			<label for="_number">Dossard n°: </label>
		</td>
		<td>
			<input id="_number" type="text" name="number"><br><br/>
		</td>	
	</tr>
	<tr>
		<td>
			<label for="_Name">Nom: </label>
		</td>
		<td>
			<input id="_Name" type="text" name="name"><br/><br/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="_firstName">Prénom: </label>
		</td>
		<td>
			<input id="_firstName" type="text" name="firstname"><br><br/>
		</td>	
	</tr>
	<tr>
		<td>
			<label for="_categorieNumber">Catégorie: </label><br/>
		</td>
		<div class="displayCategories inBlock">
			<?php

		$arrCategories = array(
			1 => "Poussin",
			2 => "Benjamin",
			3 => "Minime",
			4 => "Cadet",
			5 => "Junior",
			6 => "Senior",
			7 => "Vétérant");
			foreach ($arrCategories as $value => $key ) {
					echo "<td class='space'> <input type='radio' name='category' value='$value'> $key</td>";
			}
		?>
		</div>
	</tr>
	<tr>
		<td>
			<label>Club: </label><br/>
		</td>
		<div class="displayClubs inBlock">
			<?php
			$AllowClubs =array("nckc", "ckcb", "bno", "cks","others");
			$clubs = array("nckc", "ckcb", "bno", "cks","others", "toto");
			foreach ($clubs as $club ) {
				
				if (in_array($club, $AllowClubs)) {
					$clubMaj = strtoupper($club); 
					echo "<td class='space'> <input type='radio' name='club' value='$club'> $clubMaj </td>";
					
				} elseif ($club == "others") {
					echo "<td class='space'> <input type='radio' name='club' value='others'> Autres </td>";
					
				} else{
					$warning["[~] incorrectClub"] = "Le club '$club' contenue dans le tableau \$clubs est non conforme!";
				}
			}
		?>
		</div>
	</tr>
	<tr>
		<td>
			<label for="_sex">Sexe: </label><br/>
		</td>
		<td>
			<div class="diplaySex inBlock"></div>
			<input id="_sex" type="radio" name="sex" value="0"> Femme
		</td>
		<td>
			<input id="_sex" type="radio" name="sex" value="1"> Homme<br/><br/>
		</td>
	</tr>
	<tr>
		<td>
			<label class="button" for="_submit">Valider</label><br/><br/>
		</td>
		<td>
			<input id="_submit" type="submit" name="submit" value="1">	
		</td>
	</tr>
	<tr>
		<td>
			<label class="button" for="_reset">Par défaut</label><br/>	
		</td>
		<td>
			<input id="_reset" type="reset">	
		</td>
	</tr>
</table>

<table>
	<tr>

	<?php
	if (isset($warning)) { 
		echo "<td><h2>Warnings:</h2></td>";
		foreach($warning as $key => $value){
			echo "<tr>
			<td class='titleOfWarning'><h4>$key</h4></td>\n
			<td class='contentOfWarning'><h4>$value</h4></td>\n
			</tr>";
		}
	}?>

	</tr>
</table>

</form>

<?php



?>
</body>
</html>

<?php

//DEBUG
include_once $_SERVER['DOCUMENT_ROOT']."/include/debug.php";

//FOOTER
include_once $_SERVER['DOCUMENT_ROOT']."/include/part/footer.php";
?>
