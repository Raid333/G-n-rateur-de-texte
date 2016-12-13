<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>spinning multitable</title>
    </head>
    <body>
        <?php

        $sqlhost = "127.0.0.1";
        $sqllogin = "root";
        $sqlpassword = "";

        $min = $_POST["min"];
        $max = $_POST["max"];
        $nbannonces = $_POST["nbannonces"];
        $str1 = $_POST['str1'];
        $str2 = $_POST['str2'];


        //Connexion à la base de donnée
        $db = @mysql_connect($sqlhost, $sqllogin, $sqlpassword);
        mysql_select_db("serrurier",$db);

        $table="";
        $tata = array();
        foreach($_POST['mode'] as $table)
        {

            $tata[] = $table;

        }
        $compte = count($tata);

        if (!empty($tata)  && $min > 0 && $max > 1) {
            //	spinning
            echo  "<input type='button' onclick='window.location.reload(false)' value='Rafraichir'/> <br><br>";
            for($y=0;$y<count($tata); $y++){

                echo "<br><br><strong>texte venant de la table : </strong>" . $tata[$y] . "<br>";

                $sqq = "SELECT MAX(id) FROM $tata[$y]";
                $requete = mysql_query($sqq) or die ('ERREUR SQL ! ' . mysql_error());
                $id_t_min = mysql_fetch_array($requete);

                $sqq = "SELECT MIN(id) FROM $tata[$y]";
                $requete = mysql_query($sqq) or die ('ERREUR SQL ! ' . mysql_error());
                $id_t_max = mysql_fetch_array($requete);

                $id_min = $id_t_min[0];
                $id_max = $id_t_max[0];

                $verif='';
                for ($i=0; $i<$nbannonces; $i++){
                    $nb_lignes = rand($min, $max);
                    for ($j=0; $j<$nb_lignes; $j++){
                        $id_annonce = rand($id_min, $id_max);
                        $id_string = strval($id_annonce);
                        //Vérification si la ligne est déjà sortie
                        if(empty(strstr($verif,$id_string))){
                            $sql = "SELECT value from $tata[$y] where id=$id_annonce;";
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
                    //        echo "<br/><br/>";

                }
            }
        } else {
            echo "Veuillez remplir les champs";
        }
        ?>


    </body>
</html>
<!--Imaginé et développé par Raid333-->


