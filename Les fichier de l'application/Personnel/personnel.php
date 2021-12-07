<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css"/>
		<title>Permission</title>	
	</head>
	<?php   
			$nom="NOM";
			$Id_personnel="Identifiant du personnel";
			$prenom="PRENOM";
			$contact="Contact";

	?>
	<body>
		<?php include("../Accueil/header.php");?>
		<div class="bloc"><br/>
			<h1>PERSONNEL</h1></br>
				<div>
					<h4>RECHERCHER UN AGENT</h4>
					<form action="personnel.php" method="POST">
							<label for="Type">Type de Recherche:</label>
							<select name="Type" id="type">
								<option>Identifiant du personnel</option>
								<option>NOM</option>
								<option>PRENOM</option>
								<option>Contact</option>
							</select>
							</br></br><br/>
							<label>Recherche:</label><input type="search" name="recherche">
							<input type="submit" value="rechercher">
						</br></br><br/>
					</form>
				</div>
				<div>
					<h4>SUPPRIMER UN AGENT</h4>
					<form action="personnel.php" method="POST">
							<label for="Types">Type de Recherche:</label>
							<select name="Types" id="type">
								<option>Identifiant du personnel</option>
								<option>Contact</option>
							</select>
							</select>
							</br></br><br/>
							<label>Recherche:</label><input type="search" name="supprimer">
							<input type="submit" value="SUPPRIMER">
						</br></br><br/>
					</form>
				</div>
				<div class="formulaire">
						<h3>NOUVEAU AGENT</h3>
						<form action="personnel.php" method="POST">
							<p><label>Nom:<input type="text" name="nom" required="obligatoire" size=50></label></p>
							<p><label>Prenom:<input type="text" name="prenom" required="obligatoire" size=47></label></p>
							<p><label>Contact:<input type="number" name="contact" required="obligatoire" size=46></label></p>
							<p><label>Fonction:<input type="text" name="fonction" required="obligatoire" size=46></label></p>
							<p><label>Salaire:<input type="number" name="salaire" required="obligatoire" size=46></label></p>
							<p><label>Identifiant du directeur:<input type="text" name="Id_directeur" required="obligatoire" size=29></label></p>
							<p><label>Identifiant du secretaire:<input type="text" name="Id_secretaire" required="obligatoire" size=28></label></p>
							<p><input type="submit" value="Ajouter" class="ajouter"></p>
						</form>
				</div>
				</br></br><br/>
				<div class="tableau">
					<?php
					$bdd=new PDO("mysql:host=localhost;dbname=transport;charset = utf8","root","");
					if(isset($_POST['Type']) AND isset($_POST['recherche']))
					{
						if($_POST['Type']==$nom)
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM personnel where nom=?");
							$requete->execute(array($_POST['recherche']));

						}
						elseif ($_POST['Type']==$Id_personnel) 
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM personnel where Id_personnel=?");
							$requete->execute(array($_POST['recherche']));

						}
						elseif ($_POST['Type']==$prenom) 
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM personnel where prenom=?");
							$requete->execute(array($_POST['recherche']));

						}
						else
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM personnel where contact=?");
							$requete->execute(array($_POST['recherche']));
						}
					}
					elseif(isset($_POST['Types']) AND isset($_POST['supprimer']))
					{
						if($_POST['Types']==$contact)
						{
							$requetes=$bdd->prepare("DELETE FROM personnel where contact=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM personnel");

						}
						elseif ($_POST['Types']==$Id_personnel)
						{
							$requetes=$bdd->prepare("DELETE FROM personnel where Id_personnel=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM personnel");

						}
					}
					elseif (isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['contact']) AND isset($_POST['salaire']) AND isset($_POST['fonction']) AND isset($_POST['Id_directeur']) AND isset($_POST['Id_secretaire'])) 
					{
							$requetes=$bdd->prepare('INSERT INTO personnel(nom,prenom,contact,fonction,salaire,Id_directeur,Id_secretaire) VALUES(?,?,?,?,?,?,?)');
							$requetes->execute(array($_POST['nom'],$_POST['prenom'],$_POST['contact'],$_POST['fonction'],$_POST['salaire'],$_POST['Id_directeur'],$_POST['Id_secretaire']));
							$requete=$bdd->query("SELECT DISTINCT* FROM personnel");
					}
					else
					{
						$requete=$bdd->query("SELECT DISTINCT* FROM personnel");
					}
				?>
					<table border="1">
						<caption><a href="personnel.php">LISTE DU PERSONNEL</a></caption>
						<tr>
							<th>Id_Personnel</th>
							<th>NOM</th>
							<th>PRENOM</th>
							<th>CONTACT</th>
							<th>FONCTION</th>
							<th>SALAIRE</th>
							<th>Identifiant du Directeur</th>
							<th>Identifiant du Sécrétaire</th>
						</tr>
						<?php
							while($resultat=$requete->fetch())
							{
								?>
									<tr>
										<td><?php echo $resultat['Id_personnel'];?></td>
										<td><?php echo $resultat['nom'];?></td>
										<td><?php echo $resultat['prenom'];?></td>
										<td><?php echo $resultat['contact'];?></td>
										<td><?php echo $resultat['fonction'];?></td>
										<td><?php echo $resultat['salaire'];?></td>
										<td><?php echo $resultat['Id_directeur'];?></td>
										<td><?php echo $resultat['Id_secretaire'];?></td>
									</tr>
								<?php
							}
						?>
					</table>
				</div>


		</div>
		<?php include("../Accueil/footer.php");?>

	</body>

</html>