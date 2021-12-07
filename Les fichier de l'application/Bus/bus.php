<!DOCTYPE html>
 <html>
 <head>
 	<title>Ma page</title>
 	<meta charset="utf-8" />
	<link rel='stylesheet' href='bus.css' />
 </head>
 <body>
	<?php include("../Accueil/header.php"); ?>
	<section><br/><br/><br/>
		<div>
		<table border='2'>
			<caption><h1>LA LISTE DES BUS</h1></caption>
			<tr>
				<th>Identifiant du bus</th>
				<th>Ville de départ</th>
				<th>Ville d'arrivée</th>
				<th>Heure de départ</th>
				<th>Heure d'arrivée</th>
				<th>Identifiant du chauffeur</th>
			</tr>
			<?php 
				$bdd = new PDO('mysql:host=127.0.0.1;dbname=transport;charset = utf8','root','');
				$requete = $bdd->query("SELECT * FROM bus");
    		while($resultat = $requete->fetch())
    		{
    		?>
    		<tr>
    			<td><?php echo $resultat['Id_bus']; ?></td>
    			<td><?php echo $resultat['ville_depart']; ?></td>
    			<td><?php echo $resultat['ville_arrivee']; ?></td>
    			<td><?php echo $resultat['heure_depart']; ?></td>
    			<td><?php echo $resultat['heure_arrivee']; ?></td>
    			<td><?php echo $resultat['Id_chauffeur']; ?></td>
    		</tr>
    		<?php
   			}
   			?>
		</table>
		</div><br/><br/><br/>
	</section>
	<?php include("../Accueil/footer.php"); ?>
 </body>
 </html>