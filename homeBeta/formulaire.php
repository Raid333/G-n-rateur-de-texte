<?php

$login = "home"; //annonces
$mdp = "media";

if ($login == "home" && $mdp == "media"){

    $sqlhost = "127.0.0.1";
    $sqllogin = "root";
    $sqlpassword = "";

    $db = @mysql_connect($sqlhost, $sqllogin, $sqlpassword);
    mysql_select_db("serrurier",$db);
    $requete = "SELECT TABLES FROM serrurier";

    $reponse = 'show tables from serrurier';
    $req = mysql_query($reponse) or die('Erreur SQL !<br>'.$reponse.'<br>'.mysql_error());
    $rep = 'show tables from serrurier';
    $requ = mysql_query($reponse) or die('Erreur SQL !<br>'.$rep.'<br>'.mysql_error());
    //    $commande = "SHOW TABLES FROM serrurier";
    //    $rere = mysql_query($commande) or die (mysql_error());
    //    $tab = mysql_fetch_array($rere);
    //    $i = 1;

    //affichage
    echo "<html>";
    echo "<center>
<h2>Upload de nouvelles lignes</h2>
Copiez collez vos pragraphes dans la boite ci-dessous:<br/>";
    echo "<form method='post' action='add.php'>";
    echo "<textarea name='lines' value='' cols='80' rows='20' /></textarea><br/>";
    echo "<input type='submit' value='Envoyer' /> <br><br>";
    echo "Choisir le thème du texte :";
    echo "<select name='selectTable'>";
    while ($donnees = mysql_fetch_assoc($req))
    {
?>
<option> <?php echo $donnees['Tables_in_serrurier']; ?></option>
<?php
    }
    echo "</select>";
    echo "</form>";
    echo "<br/>";
    echo "<form action='formulaire.php' method='post'/>";
    echo "Ajouter une table :";
    echo "<input name='nameTable' type='text'/>";
    echo "<input type='submit' />";
    echo "</form>";
    echo "<hr width='100%'/>";
    echo "<br/>";
    echo "<h2>Spinner des lignes en base</h2>";
    echo "<form method='post' action='spin.php'>";
    echo "Nombre de lignes par annonce: entre <input type='text' name='min' size='3'/> et <input type='text' name='max' size='3'/>";
    echo "<br/>Nombre d'annonces d&eacute;sir&eacute;es: <input type='text' name='nbannonces'/>";
    echo "<input type='hidden' name='pass' value='rococo1298734563587racaca' />";
    echo "<br>Choisir le thème du texte :";
    echo "<br><select name='selectTable'>";
    while ($donnees = mysql_fetch_assoc($requ))
    {
?>
<option> <?php echo $donnees['Tables_in_serrurier']; ?></option>

<?php
    }
    echo "</SELECT>";
    echo "<br><input type='submit' value='Obtenir des annonces spinn&eacute;es' />";
    echo "</form>";
    echo "";
    echo "</center>";
    echo "";
    echo "</body>";
    echo "</html>";


}


else{
    echo "Erreur de login ou mot de pass";
}
$nameTable = $_POST['nameTable'];
$newTable = str_replace(" ","_", $nameTable);
$commande = "CREATE TABLE IF NOT EXISTS `$newTable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  `nbespace` int(11) NOT NULL,
  PRIMARY KEY (`id`)
)";
$req = mysql_query($commande) or die ('Erreur SQL ! ' . mysql_error());
mysql_close();
?>
