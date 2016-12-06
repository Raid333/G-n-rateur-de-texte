<?php
session_start();
?>
<html>
<form method="POST" action="formulaire.php">
Login: <input type="text" name="login" value="" /> <br/>
Mot de passe: <input type="password" name="mdp" value="" /> <br/>
<input type='submit' value='Envoyer' />
</form>
</html>