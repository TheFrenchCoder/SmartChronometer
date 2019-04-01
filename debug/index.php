<?php 
$dir = "./";


//  si le dossier pointe existe
if (is_dir($dir)) {

   // si il contient quelque chose
   if ($dh = opendir($dir)) {

       // boucler tant que quelque chose est trouve
       while (($file = readdir($dh)) !== false) {

            // affiche le nom et le type si ce n'est pas un element du systeme
            if( $file != '.' && $file != '..' && $file != 'index.php') {
                echo "<a href=\"$dir$file\">$file</a> <br/>";
            }
       }
       // on ferme la connection
       closedir($dh);
   }
}
?>