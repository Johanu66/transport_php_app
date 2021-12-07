<!DOCTYPE html>
<html>
	<head>
		<title>Faster Travel inscription</title>
		<meta charset="utf-8">
		<link rel="stylesheet"  href="formulaire.css"/>
	</head>
	<body>
	<?php include("../Accueil/header.php");
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	try
	{
		$bdd = new PDO("mysql:host =127.0.0.1;dbname=transport;charset = utf8","root", "",$pdo_options);
	}
	catch(Exception $e)
	{
		die('Ereur:'.$e ->getMessage());
	}
	$requete = $bdd->prepare("SELECT SUM(nombre_reservation) FROM client INNER JOIN reservation ON client.Id_client=reservation.Id_client WHERE Id_bus=?");
	$requete->execute(array($_GET['id']));
	$resultat = $requete->fetch();
	?><section><br/><br><?php
		if($resultat['SUM(nombre_reservation)']>=70){ ?>
			<h1>Désolé, ce bus est déjà remplir.<br/>Veuillez attendre le prochain voyage.<br/>Merci pour votre fidélité.</h1>
		<?php }
		else{
			if(!isset($_POST['send']))
				{ 
		?>
					<br/>
						<form  method="POST"  action="">
							<h3>VEUILLEZ RENSEIGNER LES CHAMPS CI-DESSOUS</h3>

							<p><label>NOM:</label><br><input type="text"  name="nom" required="obligatoire" size=50></p>
							
							<p><label>PRENOMS:</label><br><input type="text"  name="prenom" required="obligatoire" size=50></p>
							
							<p><label>CONTACT:</label><br><input type="number"  name="contact" required="obligatoire" size=50></p>
							
							<p><label>NUMERO D'IDENTITE:</label><br><input type="number"  name="num_identite" required="obligatoire"  size=50></p>
							
							<p><label>NOMBRE DE PLACE:</label><br><input type="number"  name="nombre_reservation" required="obligatoire"  size=50></p>
							
							<div><h1>61149072/64963250</h1><p>VEUILLEZ ENVOYER VOTRE ARGENT SUR L'UN DES NUMEROS<br/>
							SUIVANTS ET ENTREZ L'ID DE LA TRANSACTION DANS LE CHAMPS SUIVANT.<br/>
							VOTRE RESERVATION NE SERA VALIDÉE QUE SI L'ID ENTRÉ CORRESPOND<br/>
							À L'ID DE L'UN DES MESSAGES DE PAYEMENT QUE NOUS AVONS REÇU</p></div>
							
							<p><label>ID DE LA TRANSACTION:</label><br><input type="number"  name="num_paye" required="obligatoire" size=50></p>

							<p><input class="input" type="submit"  name="send" value="Envoyer"  /></p>
						</form><br/>
		<?php 
				}
			if(isset($_POST['send']) AND ($_POST['nombre_reservation']+$resultat['SUM(nombre_reservation)'])>70){ ?>
				<h1>Désolé nous n'avons plus assez de place.<br/>Nous n'avons que <?php echo 70-$resultat['SUM(nombre_reservation)'] ?> places disponibles.</h1>
		<?php	}
			else{
				if(isset($_POST['send']) AND isset($_POST['nom']) AND isset($_POST['prenom'])  AND isset($_POST['contact']) AND isset($_POST['num_identite'])  AND isset($_POST['nombre_reservation']) AND  isset($_POST['num_paye']))
					{
						$requete = $bdd->prepare("INSERT INTO client(nom,prenom,contact,ville_actuelle,num_identite,num_paye,ville_destination,nombre_reservation,Id_bus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
						$requete->execute(array($_POST['nom'],$_POST['prenom'],$_POST['contact'],$_GET['vd'],$_POST['num_identite'],$_POST['num_paye'],$_GET['va'],$_POST['nombre_reservation'],$_GET['id']));
						header("Location:../Message de confirmation/Message de confirmation.php");
					}
			}
		}
		?><br/><br/>
		</section>
		<?php include("../Accueil/footer.php");?>
	</body>
</html>