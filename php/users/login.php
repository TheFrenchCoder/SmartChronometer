<?php
// On démarre la session si besoin dans le futur
session_start();
if(isset($_POST['connexion'])) {
    if(empty($_POST['username'])) {
        $warning["Username"] = "Le champ \"Nom d'utilisateur\" est vide.";
    } else {
        // on vérifie maintenant si le champ "Mot de passe" n'est pas vide"
        if(empty($_POST['password'])) {
            $warning["Password"] = "Le champ \"Mot de passe\" est vide.";
        } else {
            $username = htmlentities($_POST['username'], ENT_QUOTES, "ISO-8859-1"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $password = htmlentities($_POST['password'], ENT_QUOTES, "ISO-8859-1");

            try {
                $bdd = new PDO('mysql:host=localhost;dbname=dbchrono;charset=utf8', 'root', 'espace21');
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } 
                catch(Exception $e) {
                die('Erreur : '.$e->getMessage());
                }

            //on vérifie que la connexion s'effectue correctement:
            if(!$bdd){
                $warning["Bdd"] = "Erreur de connexion à la base de données.";
            } else {
                // on fait maintenant la requête dans la base de données pour rechercher si ces données existe et correspondent:
                //si vous avez enregistré le mot de passe en md5() il vous suffira de faire la vérification en mettant mdp = '".md5($MotDePasse)."' au lieu de mdp = '".$MotDePasse."'
                $qSelect = "SELECT * FROM users WHERE username='" . $username . "' AND password='" . $password . "'";
                $qSelect = $bdd->query($qSelect);

                $count = $qSelect ->rowCount();

                if($count == 0) {
                    $warning["notMatching"] = "Le pseudo ou le mot de passe est incorrect, le compte n'a pas été trouvé.";
                } else {
                    // on ouvre la session avec $_SESSION:
                    $_SESSION['username'] = $username; // la session peut être appelée différemment et son contenu aussi peut être autre chose que le pseudo
                    $infos["Match"] = 
                    "Vous êtes à présent connecté ! <br />
                    Nom d'utilisateur: " . $username ."<br />
                    Mot de passe: " . sha1($password) . " (Tu croyais quoi là?)";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
     <title>Authentification</title>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="css/XXX.css"/>
</head>

<body>

<div align="center">
    <h3><a href="/index.php">Acceuil</a></h3>
    <h3>Connexion</h3>
    <br /><br />
    <form method="POST" action="">
        <table>
            <tr>
                <td>
                    <label for="username">Nom d'utilisateur : </label>
                </td>
                <td>
                    <input type="text" name="username" id="username" />
                </td>
            </tr>

            <tr>
                <td>
                    <label for="password">Mot de passe : </label>
                </td>
                <td>
                    <input type="password" name="password" id="password" />
                </td>
            </tr>
        </table>
    <br />
    <input type="submit" name='connexion' value="Connexion" />

    </form>

<?php
    if (isset($infos)) { // ECHO $infos

    echo "<h5>";
    echo "Infos: <br/>";

    foreach($infos as $key => $value){
        $type = GETtype($value);
        echo "'$key' => ($type) '$value'<br/>\n";
    }
    echo "<h5/>";  
    }
?>

</div>

</body>
</html>

<?php
echo "path: '" . basename(__FILE__) ."'";
echo "<br/>";
echo "Session: <br/>";
var_dump($_SESSION);

if (isset($infos)) { // ECHO $infos

    echo "<h5>";
    echo "Infos: <br/>";

    foreach($infos as $key => $value){
        $type = GETtype($value);
        echo "'$key' => ($type) '$value'<br/>\n";
    }
    echo "<h5/>";  
}

if (isset($warning)) { // ECHO $warning

    echo "<h5>";
    echo "Warnings: <br/>";

    foreach($warning as $key => $value){
        $type = GETtype($value);
        echo "'$key' => ($type) '$value'<br/>\n";
    }
    echo "<h5/>";  

}

?>