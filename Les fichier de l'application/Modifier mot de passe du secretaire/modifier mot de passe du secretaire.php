<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="modifier mot de passe du secretaire.css" />
</head>
<body>
	<?php include("../Accueil/header.php"); ?>
	<section><br/>
	<?php
		$bdd=new PDO("mysql:host=localhost;dbname=transport;charset = utf8","root","");
		if(isset($_POST['modifier']) AND $_POST['mot_paase1']==$_POST['mot_paase2']){
			$requete = $bdd->prepare("UPDATE secretaire SET mot_passe=?");
			$requete->execute(array($_POST['mot_paase1']));?>
			<h4>Mot de passe modifier avec succès</h4>
	<?php
		}
	?>
	<form method='POST' action=''>
		<?php if(isset($_POST['modifier']) AND $_POST['mot_paase1']!=$_POST['mot_paase2']){?>
		<h3>Mot de passe non indentique</h3> <?php } ?>
		<p><label>Nouveau mot de passe du secrétaire</label></p>
		<p><input type='password' name='mot_paase1' size=50 required='obligatoire'></p>
		<p><label>Confirmer le nouveau mot de passe du secrétaire</label></p>
		<p><input type='password' name='mot_paase2' size=50 required='obligatoire'></p>
		<p><input type='submit' name='modifier' value='MODIFIER'></p><br/>
	</form>
	</section>
	<?php include("../Accueil/footer.php"); ?>
</body>
</html>