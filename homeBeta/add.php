<?php
$table = $_POST['selectTable'];
// Connexion à la base de donnée 
$bd = @mysql_connect("127.0.0.1", "root", "");
mysql_select_db("serrurier", $bd);



//Déclaration fonction
function paragrapheToLines($paragraphe){
    return preg_split("/[\.!?]+/", $paragraphe);
}



$lines_textarea = $_POST["lines"];
$paragraphes = preg_split("/[\n\r]+/",$lines_textarea);


//Boucle pour découper les paragraphes 
if (!empty($lines_textarea)) {
    for ($i=0; $i<count($paragraphes); $i++){
        $lines = paragrapheToLines($paragraphes[$i]);
        for ($j=0; $j<count($lines); $j++){
            $line = $lines[$j];
            preg_replace("/^ /", "", $line);


            $line = addslashes($line);
            $line = ucfirst($line);
            $espace = mb_substr_count($line, " ");
            if (strlen($line)>2){
                $requete = "INSERT INTO $table VALUES (NULL, '".$line."','".$espace."');";
                $req = mysql_query($requete) or die ('Erreur SQL !' .mysql_error());
            }
        }
    }
    echo "Vous avez bien ajouté ". count($lines). " lignes sur la table : " . $table . "<br>";
    echo "<a href='formulaire.php'>RETOUR</a>";
    //Si le champ est vide cela renvoit un message comme quoi le champ est vide
} else {
    echo "Champ de texte vide !";
    echo "<br> <a href='formulaire.php'>RETOUR</a>";
}





mysql_close();
?>