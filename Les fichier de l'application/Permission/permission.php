<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css"/>
		<title>Permission</title>	
	</head>
	<?php   
			$Date_permission="Date de Permission";
			$Idpersonnel="Identifiant du personnel";
			$motif="Motif";

	?>
	<body>
	<?php include("../Accueil/header.php"); ?>
		<div class="bloc"><br/><br/>
			<h1>PERMISSIONS</h1></br>
				<div>
					<h4>RECHERCHER UNE PERMISSION DANS L'HISTORIQUE</h4>
					<form action="permission.php" method="POST">
							<label for="Type">Type de Recherche:</label>
							<select name="Type" id="type">
								<option>Date de Permission</option>
								<option>Identifiant du personnel</option>
								<option>Identifiant de la permission</option>
								<option>Motif</option>
							</select>
							</br></br><br/>
							<label>Recherche:</label><input type="search" name="recherche">
							<input type="submit" value="RECHERCHER"/>
						</br></br><br/>
					</form>
				</div>
				<div>
					<h4>SUPPRIMER UNE PERMISSION</h4>
					<form action="permission.php" method="POST">
							<label for="Types">Type de Recherche:</label>
							<select name="Types" id="type">
								<option>Date de Permission</option>
								<option>Identifiant du personnel</option>
								<option>Identifiant de la permission</option>
								<option>Motif</option>
							</select>
							</br></br><br/>
							<label>Recherche:</label><input type="search" name="supprimer">
							<input type="submit" value="SUPPRIMER">
						</br></br><br/>
					</form>
				</div>
				<div class="formulaire">
						<h3>NOUVELLE PERMISSION</h3>
						<form action="permission.php" method="POST">
							<p><label>Date:<input type="date" name="date" required="obligatoire" size=50></label></p>
							<p><label>Motif:<input type="text" name="motif" required="obligatoire" size=49></label></p>
							<p><label>Identifiant du Personnel:<input type="number" name="idpersonnel" required="obligatoire" size=30></label></p>
							<p><input type="submit" name="ajouter" value="AJOUTER"></p>
						</form>
				</div>
				</br></br><br/>
				<div class="tableau">
					<?php
					$bdd=new PDO("mysql:host=localhost;dbname=transport;charset = utf8","root","");
					if(isset($_POST['Type']) AND isset($_POST['recherche']))
					{
						if($_POST['Type']==$Date_permission)
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM permission where date_permission=?");
							$requete->execute(array($_POST['recherche']));

						}
						else if ($_POST['Type']==$Idpersonnel) 
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM permission where Id_personnel=?");
							$requete->execute(array($_POST['recherche']));

						}
						else if($_POST['Type']==$motif)
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM permission where motif=?");
							$requete->execute(array($_POST['recherche']));
						}
						else
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM permission where Id_permission=?");
							$requete->execute(array($_POST['recherche']));
						}
					}
					else if(isset($_POST['Types']) AND isset($_POST['supprimer']))
					{
						if($_POST['Types']==$Date_permission)
						{
							$requetes=$bdd->prepare("DELETE FROM permission where date_permission=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM permission");

						}
						else if ($_POST['Types']==$Idpersonnel) 
						{
							$requetes=$bdd->prepare("DELETE FROM permission where Id_personnel=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM permission");

						}
						else if($_POST['Types']==$motif)
						{
							$requetes=$bdd->prepare("DELETE FROM permission where motif=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM permission");
						}
						else
						{
							$requetes=$bdd->prepare("DELETE FROM permission where Id_permission=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM permission");
						}
					}
					else if (isset($_POST['ajouter']) AND isset($_POST['date']) AND isset($_POST['motif']) AND isset($_POST['idpersonnel'])) 
					{
							$requetes=$bdd->prepare('INSERT INTO permission(date_permission,motif,Id_personnel) VALUES(?,?,?)');
							$requetes->execute(array($_POST['date'],$_POST['motif'],$_POST['idpersonnel']));
							$requete=$bdd->query("SELECT DISTINCT* FROM permission");
					}
					else
					{
						$requete=$bdd->query("SELECT DISTINCT* FROM permission");
					}
				?>
					<table border="1">
						<caption><a href="permission.php">Historique des Permissions</a></caption>
						<tr>
							<th>Identifiant de la Permission</th>
							<th>Date de Permission</th>
							<th>Motif</th>
							<th>Identifiant du Personnel</th>
						</tr>
						<?php
							while($resultat=$requete->fetch())
							{
								?>
									<tr>
										<td><?php echo $resultat['Id_permission'];?></td>
										<td><?php echo $resultat['date_permission'];?></td>
										<td><?php echo $resultat['motif'];?></td>
										<td><?php echo $resultat['Id_personnel'];?></td>
									</tr>
								<?php
							}
						?>
					</table>
				</div><br/><br/>
		</div>
		<?php include("../Accueil/footer.php"); ?>
	</body>

</html>