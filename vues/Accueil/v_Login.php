<link href="css/cssFormulaire.css" rel="stylesheet" type="text/css"/>

<form id="login" action="index.php" method="POST">
    <p><span>Username : </span><input id="username" name="username" type="text" size="20" required></p>
    <p><span>Password : </span><input id="password" name="password" type="password" size="20" required></p>
    <input type="submit" value="Se connecter" />
</form>
<form action="index.php?" method="get">
    <input style="display: none;" type="text" name="uc" value="enregistrer"/>
    <input type="submit" value="S'enregistrer" />
</form>