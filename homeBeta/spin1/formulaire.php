<?php
session_start();
$_SESSION ['login'] = $_POST["login"]; //annonces
$_SESSION['mdp'] = $_POST["mdp"];

if ($_SESSION['login'] == "home" && $_SESSION['mdp'] == "media"){

    $sqlhost = "127.0.0.1";
    $sqllogin = "root";
    $sqlpassword = "";

    $db = mysql_connect($sqlhost, $sqllogin, $sqlpassword);
    mysql_select_db("serrurier",$db);

    $sql = "SELECT count(id) from spin1;";
    $result = mysql_query($sql) or die (mysql_error());
    $number = mysql_fetch_array($result);
    $commande = "CREATE TABLE $nameTable ('id' INT not null AUTO_INCREMENT,
    'value' varchar(255) NOT NULL,
    PRIMARY KEY ('id'))";

    //affichage
    echo "<html>";
    echo "<center>
<h2>Upload de nouvelles lignes</h2>
Copiez collez vos pragraphes dans la boite ci-dessous:<br/>";
    echo "<form method='post' action='add.php'>";
    echo "<textarea name='lines' value='' cols='80' rows='20' /></textarea><br/>";
    echo "<input type='submit' value='Envoyer' /> <br><br>";
    echo "Choisir le thème du texte :";
    echo "<SELECT name='selectTable' size='1'>";
    echo "<OPTION>spin1";
    echo "<OPTION>spin2";
    echo "<OPTION>spin3";
    echo "<OPTION>etc..";
    echo "</SELECT>";
    echo "</form>";
    echo "<br/>";
    echo "<form action='formulaire.php' />";
    echo "Ajouter une table :";
    echo "<input name='nameTable' type='text'/>;
    echo "<hr width='100%'/>";
    echo "<br/>";
    echo "<h2>Spinner des lignes en base</h2>";
    echo "<form method='post' action='spin.php'>";
    echo "Nombre de lignes par annonce: entre <input type='text' name='min' size='3'/> et <input type='text' name='max' size='3'/>";
    echo "<br/>Nombre d'annonces d&eacute;sir&eacute;es: <input type='text' name='nbannonces'/>";
    echo "<input type='hidden' name='pass' value='rococo1298734563587racaca' />";
    echo "<br> Nombre de Caractère par phrase : <input type='number' name='caractere' /> <br>";
    echo "<br/><input type='submit' value='Obtenir des annonces spinn&eacute;es' />";
    echo "<br/>Nombre de lignes en base: $number[0]";
    echo "</form>";
    echo "<form action='formulaire.php' method='post' />";
    echo "Choisir le thème du texte : <SELECT name='selectTable' size='1'>
            <OPTION>Information sur l'entreprise
            <OPTION>serrurerie
            <OPTION>Climatiseur
            <OPTION>etc..
        </SELECT>";
    echo "<input type='submit' value='Actualiser' />";
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
mysql_close();
?>
