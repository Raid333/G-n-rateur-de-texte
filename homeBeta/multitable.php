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

        //Connexion à la base de donnée
        $db = @mysql_connect($sqlhost, $sqllogin, $sqlpassword);
        mysql_select_db("serrurier",$db);

        $sql = 'show tables from serrurier';
        $requete = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
        $donnees = mysql_fetch_assoc($requete);

        ?>
        <center>
            <u>Quelles tables voulez-vous spinner ? </u><br><br>

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
                    Nombre de lignes par annonce: entre <input type='text' name='min' size='3'/> et <input type='text' name='max' size='3'/>
                    <br/>Nombre d'annonces d&eacute;sir&eacute;es: <input type='text' name='nbannonces'/>
                    <br><br><input type="submit" value="Envoyer">
                </form>
            
        </center>

        <?php mysql_close(); ?>
    </body>
</html>
<!--Imaginé et développé par Raid333-->

