<?php
$hidden = $_POST["pass"];
$min = $_POST["min"];
$max = $_POST["max"];
$table = $_POST['selectTable'];
$nbannonces = $_POST["nbannonces"];
if ((strcmp($hidden,"rococo1298734563587racaca")==0) && $min > 0 && $max > 1){
    $sqlhost = "127.0.0.1";
    $sqllogin = "root";
    $sqlpassword = "";

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

    $nb_lignes = rand($min, $max);

    //	while ($data = mysql_fetch_assoc($req)){
    //		$id = $data["id"];
    //		if ($id <$id_min){
    //		  $id_min = $id;
    //		}
    //		if ($id >$id_max){
    //		  $id_max = $id;
    //		}
    //	}
    //    $id_annonce = rand($id_min, $id_max);

    // Bouton refesh
    echo  "<input type='button' onclick='window.location.reload(false)' value='Rafraichir'/> <br><br>";


    //	spinning
    $verif='';
    for ($i=0; $i<$nbannonces; $i++){
        $nb_lignes = rand($min, $max);
        for ($j=0; $j<$nb_lignes; $j++){
            $id_annonce = rand($id_min, $id_max);
            $id_string = strval($id_annonce);
            //Vérification si la ligne est déjà sortie
            if(empty(strstr($verif,$id_string))){
                $sql = "SELECT value from $table where id=$id_annonce;";
                $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
                $data = mysql_fetch_assoc($req);
                $line = $data["value"];
                $verif = $verif.$id_string;
                echo $line.".";
            } else{ 
                $sql = "SELECT value from $table where id=$id_annonce;";
                $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
                $data = mysql_fetch_assoc($req);
                $line = $data["value"];
                $verif = $verif.$id_string;
            }
        }
        echo "<br/><br/>";
        //        echo $verif . " " . $id_annonce;
    }


    //        for ($i=0; $i<$nbannonces; $i++){
    //            $nb_lignes = rand($min, $max);
    //            for ($j=0; $j<$nb_lignes; $j++){
    //                $id_annonce = rand($id_min, $id_max);
    //                $sql = "SELECT value from $table where id=$id_annonce;";
    //                $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
    //                $data = (mysql_fetch_assoc($req));
    //                $line = $data["value"];


    //    for ($i=0; $i<$nbannonces;$i++) {
    //        $id_annonce = rand($id_min, $id_max);
    //        $requ = "SELECT value FROM $table WHERE id=$id_annonce;";
    //        $sqq = mysql_query($requ) or die (mysql_error());
    //        $tab = mysql_fetch_assoc($sqq);
    //
    //    }

    //    for ($i=0;$i<$nbannonces; $i++) {
    //        $requ = "SELECT value FROM $table WHERE id=$id_annonce;";
    //        $da= mysql_query($requ) or die (mysql_error());
    //        $data[$i] = mysql_fetch_assoc($da);
    //    }

    //    while ($data = mysql_fetch_assoc($req)) {
    //        $tableau[] = $data['content'];
    //    }

    //    for ($j=0;$j<$nbannonces; $j++) {
    //        
    //        echo $data[$j] . "<br>";
    //    }






    //}
    echo "<br/><br/>";






    mysql_close();
    echo "<br/><br><strong>Voici le texte venant de la table : </strong>" . $table . "<br>";
    //}
}else {
    echo "ERROR";





}


?>