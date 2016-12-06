<?php
$table = $_POST['selectTable'];
// Connexion à la base de donnée 
$bd = mysql_connect("127.0.0.1", "root", "");
mysql_select_db("serrurier", $bd);

//$requete = "INSERT INTO $table VALUES (NULL, '".$texte."');";
//$sql = mysql_query($requete) or die('Erreur SQL !'.mysql_error());

//Déclaration fonction
function paragrapheToLines($paragraphe){
    return preg_split("/[\.!?]+/", $paragraphe);
}

$nbCarac = 20;
$lines_textarea = $_POST["lines"];
$paragraphes = preg_split("/[\n\r]+/",$lines_textarea);

if (!empty($lines_textarea)) {
    //Boucle pour découper les paragraphes 
    for ($i=0; $i<count($paragraphes); $i++){
        $lines = paragrapheToLines($paragraphes[$i]);
        for ($j=0; $j<count($lines); $j++){
            $line = $lines[$j];
            preg_replace("/^ /", "", $line);

            //$line = str_replace("'", "\'", $line);
            //echo $line;
            $line = addslashes($line);

            if (strlen($line)>2){
                $requete = "INSERT INTO $table VALUES (NULL, '".$line."');";
                $req = mysql_query($requete) or die ('Erreur SQL !' .mysql_error());
            }
        }
    }
} else {
    echo "Champ de texte vide !";
}




echo "Voila c'est gagn&eacute; !";
mysql_close();
?>