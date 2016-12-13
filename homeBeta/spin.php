<?php
$hidden = $_POST["pass"];
$min = $_POST["min"];
$max = $_POST["max"];
//ini_set("display_errors",0);error_reporting(0);
$keyword = $_POST['keyword'];


$table = $_POST['selectTable'];
$nbannonces = $_POST["nbannonces"];
if ((strcmp($hidden,"rococo1298734563587racaca")==0) && $min > 0 && $max > 1){
    $sqlhost = "127.0.0.1";
    $sqllogin = "root";
    $sqlpassword = "";
    $str1 = $_POST['str1'];
    $str2 = $_POST['str2'];
    //Connexion à la base de donnée
    $db = @mysql_connect($sqlhost, $sqllogin, $sqlpassword);
    mysql_select_db("serrurier",$db);

    $sqq = "SELECT MAX(id) FROM $table";
    $requete = mysql_query($sqq) or die ('ERREUR SQL ! ' . mysql_error());
    $id_t_min = mysql_fetch_array($requete);

    $sqq = "SELECT MIN(id) FROM $table";
    $requete = mysql_query($sqq) or die ('ERREUR SQL ! ' . mysql_error());
    $id_t_max = mysql_fetch_array($requete);

    $sql = "SELECT id from $table;";
    $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

    $id_min = $id_t_min[0];
    $id_max = $id_t_max[0];

    //Vérification mot clé saisi
    if (!empty($keyword)) {
        $motcle = "and value like '%$keyword%'";
    } else {
        $motcle = "";
    }


    // Bouton refesh
    echo  "<input type='button' onclick='window.location.reload(false)' value='Rafraichir'/><br><br>";


    //	spinning
    $verif='';
    for ($i=0; $i<$nbannonces; $i++){
        $nb_lignes = rand($min, $max);
        for ($j=0; $j<$nb_lignes; $j++){
            $id_annonce = rand($id_min, $id_max);
            $id_string = strval($id_annonce);
            //Vérification si la ligne est déjà sortie
            if(empty(strstr($verif,$id_string))){
                $sql = "SELECT value from $table where id=$id_annonce $motcle;";
                $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
                $data = mysql_fetch_assoc($req);
                $line = $data["value"];
                $verif = $verif.$id_string;
                $remplace =  str_ireplace($str1,$str2,$line);
                echo $remplace . ".";
            } else { 
                //Si l'id de la value est déjà sortie : 
                $j--;
            }
        }
        echo "<br/><br/>";

    }



    //    echo "<br/><br/>";






    mysql_close();
    echo "<br/><br><strong>Voici le texte venant de la table : </strong>" . $table . "<br>";
    //}
}else {
    echo "ERROR <br>";
    echo  "<a href='formulaire.php'/>RETOUR</a> <br><br>";





}
?>


<!--Imaginé et développé par Raid333-->