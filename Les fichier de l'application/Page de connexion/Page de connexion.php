<!DOCTYPE html>
<html>
    <head>
		 <meta charset="utf-8" />
		 <link rel="stylesheet" href="Page de connexion.css" />
		<title>CONNECTION</title>
	</head>
	<body>
		<?php include("../Accueil/header.php"); ?>
		<section>
			<form method='POST' action=''>
				<br/><br/><br/>
				<?php 
					$bdd = new PDO('mysql:host=127.0.0.1;dbname=transport;charset = utf8','root','');
					$requete = $bdd->query("SELECT * FROM secretaire");
					$requete1 = $bdd->query("SELECT * FROM directeur");
					if(isset($_POST['connecter']) AND isset($_POST['identifiant']) AND isset($_POST['motdepasse']) AND !empty($_POST['connecter']) AND !empty($_POST['identifiant']) AND !empty($_POST['motdepasse'])){
						$resultat = $requete->fetch();
						$resultat1 = $requete1->fetch();
						if($_POST['identifiant'] == $resultat['Id_secretaire'] AND $_POST['motdepasse'] == $resultat['mot_passe']){
							header('Location: ../Secretaire/secretaire.php');
						}
						else if($_POST['identifiant'] == $resultat1['Id_directeur'] AND $_POST['motdepasse'] == $resultat1['mot_passe']){
							header('Location: ../Directeur/directeur.php');
						}
						else{ ?>
							<h4>Identifiant ou Mot de passse incorrecte !!!</h4>
						<?php } 
					} ?>
				<label>Identifiant</label>
				<?php if(!empty($_POST['connecter']) AND isset($_POST['identifiant']) AND empty($_POST['identifiant'])){ ?> <h4>Veuillez renseiger un identifiant !!!!!</h4> <?php } ?>
				<p><input type='text' name='identifiant' size="50" maxlength="10"/></p>
				<label>Mot de passe</label>
				<?php if(!empty($_POST['connecter']) AND isset($_POST['motdepasse']) AND empty($_POST['motdepasse'])){ ?> <h4>Veuillez renseiger un mot de passe !!!!!</h4> <?php } ?>
				<p><input type='password' name='motdepasse' size="50" maxlength="20"/></p>
				<p><input type='submit' name='connecter' value='Se connecter' /><p>
				<p><h3>Au cas où vous oublierez votre mot de passe, veuillez contacter votre développeur.</h3><p/>
			</form><br/><br/>
		</section>
		<?php include("../Accueil/footer.php"); ?>
	</body>
</html>