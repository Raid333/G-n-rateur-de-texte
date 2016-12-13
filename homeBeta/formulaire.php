<?php
ini_set("display_errors",1);error_reporting(0);

$login = $_POST['login'];
$mdp = $_POST['mdp'];

if ($login == "home" && $mdp == "media"){

    $sqlhost = "127.0.0.1";
    $sqllogin = "root";
    $sqlpassword = "";

    //Connexion à la base de donnée
    $db = @mysql_connect($sqlhost, $sqllogin, $sqlpassword);
    mysql_select_db("serrurier",$db);
    $requete = "SELECT TABLES FROM serrurier";

    $reponse = 'show tables from serrurier';
    $req = mysql_query($reponse) or die('Erreur SQL !<br>'.$reponse.'<br>'.mysql_error());
    $rep = 'show tables from serrurier';
    $requ = mysql_query($reponse) or die('Erreur SQL !<br>'.$rep.'<br>'.mysql_error());


    //affichage
    echo "<meta charset=\"UTF-8\">";
    echo "<html>";
    echo "<center>
<h2>Upload de nouvelles lignes</h2>
Copiez collez vos pragraphes dans la boite ci-dessous:<br/>";
    echo "<form method='post' action='add.php'>";
    echo "<textarea name='lines' value='' cols='80' rows='20' /></textarea><br/>";
    echo "<input type='submit' value='Envoyer'/> <br><br>";
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
    echo "<input type='hidden' name='login' value='home' />";
    echo "<input type='hidden' name='mdp' value='media' />";
    echo "<input type='submit' />";
    echo "</form>";
    echo "<hr width='100%'/>";
    echo "<br/>";
    echo "<h2>Spinner des lignes en base</h2>";
    echo "<form method='post' action='spin.php'>";
    echo "Nombre de lignes par annonce: entre <input type='number' name='min' size='3'/> et <input type='number' name='max' size='1'/>";
    echo "<br/>Nombre d'annonces d&eacute;sir&eacute;es: <input type='number' name='nbannonces'/>";
    echo "<br>Selection mot clé :  <input type='text' name='keyword' />";
    echo "<br> Remplacer le mot : <input type='text' name='str1' /> par le mot : <input type='text' name='str2' />";
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
    echo "<br><a href='connexion.php'>Se connecter</a>";
}
$nameTable = $_POST['nameTable'];
$newTable = str_replace(" ","_", $nameTable);
$commande = "CREATE TABLE IF NOT EXISTS `$newTable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  `nbespace` int(11) NOT NULL,
  PRIMARY KEY (`id`)
)";
$req = mysql_query($commande);
mysql_close();
?>
