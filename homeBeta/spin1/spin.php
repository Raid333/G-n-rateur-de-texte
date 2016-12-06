<?php
$hidden = $_POST["pass"];
$min = $_POST["min"];
$max = $_POST["max"];
$typeTable = $_POST['table'];
$caractere = $_POST['caractere'];
$nbannonces = $_POST["nbannonces"];
if ((strcmp($hidden,"rococo1298734563587racaca")==0) && $min > 0 && $max > 1){
	$sqlhost = "127.0.0.1";
	$sqllogin = "root";
	$sqlpassword = "";

	$db = mysql_connect($sqlhost, $sqllogin, $sqlpassword);
	mysql_select_db("serrurier",$db);

	$sql = "SELECT id from spin1;";
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	
	$id_min = 1000;
	$id_max = 0;
	while ($data = mysql_fetch_assoc($req)){
		$id = $data["id"];
		if ($id <$id_min){
		  $id_min = $id;
		}
		if ($id >$id_max){
		  $id_max = $id;
		}
	}

	//spinning
	for ($i=0; $i<$nbannonces; $i++){
	  $nb_lignes = rand($min, $max);
	  for ($j=0; $j<$nb_lignes; $j++){
          $id_annonce = rand($id_min, $id_max);
	  $sql = "SELECT value from spin1 where id=$id_annonce;";
	  $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	  $data = mysql_fetch_assoc($req);
	  
	  $line = $data["value"];
	  echo $line." ";
          }
	  echo "<br/><br/>";
	}

	mysql_close();
	echo "<br/>Voila c'est gagn&eacute; !";
}
else
  echo "Mauvais choix de pokemon";
