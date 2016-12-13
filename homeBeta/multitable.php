<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>MULTITABLE</title>
    </head>
    <body>
        <?php
        $sqlhost = "127.0.0.1";
        $sqllogin = "root";
        $sqlpassword = "";

        $login = $_POST['login'];
        $mdp = $_POST['mdp'];
        
        if ($login == "home" && $mdp = "media") {
        //Connexion à la base de donnée
        $db = @mysql_connect($sqlhost, $sqllogin, $sqlpassword);
        mysql_select_db("serrurier",$db);
        

        $sql = 'show tables from serrurier';
        $requete = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
        $donnees = mysql_fetch_assoc($requete);

        ?>
        <center>
            <u>Quelle(s) table(s) voulez-vous spinner ? </u><br><br>

            <table>
                <form method="post" action="spinmultiple.php">
                   <tr>
                   <td>
                    <?php
                    while ($donnees = mysql_fetch_assoc($requete))
                    {
                        echo '<input type="checkbox" name="mode[]" value="'.$donnees['Tables_in_serrurier'].'"/>' . $donnees["Tables_in_serrurier"].'<br>';


                    }?>
                    </td>
                    </tr>
                    </table>
                    <br>
                    Nombre de lignes par annonce: entre <input type='number' name='min' size='3'/> et <input type='number' name='max' size='3'/>
                    <br/>Nombre d'annonces d&eacute;sir&eacute;es: <input type='number' name='nbannonces'/>
                    <br> Remplacer le mot : <input type='text' name='str1' /> par le mot : <input type='text' name='str2' />
                    <br><br><input type="submit" value="Envoyer">
                </form>
            
        </center>

        <?php mysql_close(); 
        } else {
            echo "Erreur de login ou mot de passe !";
            echo "<br><a href='connexion2.php'>Se connecter</a>";
            
        }
        ?>
    </body>
</html>
<!--Imaginé et développé par Raid333-->

