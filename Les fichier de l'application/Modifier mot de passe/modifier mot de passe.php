<!DOCTYPE html>
<html>
    <head>
		 <meta charset="utf-8" />
		 <link rel="stylesheet" href="modifier mot de passe.css" />
		<title>CONNECTION</title>
	</head>
	<body>
		<?php include("../Accueil/header.php"); ?>
		<section><br/><br/>
			<?php if(isset($_POST['valider']) AND isset($_POST['motdepasse_actuel']) AND isset($_POST['motdepasse_nouveau']) AND isset($_POST['motdepasse_nouveau1']) AND !empty($_POST['valider']) AND !empty($_POST['motdepasse_actuel']) AND !empty($_POST['motdepasse_nouveau']) AND !empty($_POST['motdepasse_nouveau1'])){
				$bdd = new PDO('mysql:host=127.0.0.1;dbname=transport;charset = utf8','root','');
				$requete = $bdd->query("SELECT * FROM secretaire");
				$requete1 = $bdd->query("SELECT * FROM directeur");
				$resultat = $requete->fetch();
				$resultat1 = $requete1->fetch();
			if($_POST['motdepasse_actuel'] == $resultat['mot_passe'] AND $_POST['motdepasse_nouveau']==$_POST['motdepasse_nouveau1']){
					$requet = $bdd->prepare("UPDATE secretaire SET mot_passe = ? ");
					$requet->execute(array($_POST['motdepasse_nouveau'])); ?>
					<h3>Mot de passe modifier avec succès</h3><?php
				}
				else if($_POST['motdepasse_actuel'] == $resultat1['mot_passe'] AND $_POST['motdepasse_nouveau']==$_POST['motdepasse_nouveau1']){
					$requet = $bdd->prepare("UPDATE directeur SET mot_passe = ? ");
					$requet->execute(array($_POST['motdepasse_nouveau']));?>
					<h3>Mot de passe modifier avec succès</h3><?php
				}
			}
		?>
			<form method='POST' action=''>
				<?php if(isset($_POST['valider']) AND $_POST['motdepasse_actuel'] != $resultat['mot_passe'] AND $_POST['motdepasse_actuel'] != $resultat1['mot_passe']){ ?>
					<h4>Mot de passe incorrect</h4>
				<?php } ?>
				<label>Actuel mot de passe</label>
				<p><input type="password" name="motdepasse_actuel" size="50" required="obligatoire"/></p>
				<label>Nouveau mot de passe</label>
				<p><input type="password" name="motdepasse_nouveau" size="50" required="obligatoire"/></p>
				<?php if(isset($_POST['valider']) AND $_POST['motdepasse_nouveau']!=$_POST['motdepasse_nouveau1']){ ?>
					<h4>Nouveau mot de passe non identique</h4>
				<?php } ?>
				<label>Confirmer nouveau mot de passe</label>
				<p><input type="password" name="motdepasse_nouveau1" size="50" required="obligatoire"/></p>
				<p><input type="submit" name="valider" value="Valider" />
			</form><br/><br/>
		</section>
		<?php include("../Accueil/footer.php"); ?>
	</body>
</html>