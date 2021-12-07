<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css"/>
		<title>Sanction</title>	
	</head>
	<?php   
			$Date_sanction="Date de Sanction";
			$Idpersonnel="Identifiant du personnel";
			$motif="Motif";

	?>
	<body>
	<?php include("../Accueil/header.php"); ?>
		<div class="bloc"><br/><br/>
			<h1>SANCTION</h1></br>
				<div>
					<h4>RECHERCHER UNE SANCTION DANS L'HISTORIQUE</h4>
					<form action="Sanction.php" method="POST">
							<label for="Type">Type de Recherche:</label>
							<select name="Type" id="type">
								<option>Date de Sanction</option>
								<option>Identifiant du personnel</option>
								<option>Type de sanction</option>
								<option>Motif</option>
							</select>
							</br></br><br/>
							<label>Recherche:</label><input type="search" name="recherche">
							<input type="submit" value="rechercher">
						</br></br><br/>
					</form>
				</div>
				<div>
					<h4>SUPPRIMER UNE SANCTION</h4>
					<form action="Sanction.php" method="POST">
							<label for="Types">Type de Recherche:</label>
							<select name="Types" id="type">
								<option>Date de Sanction</option>
								<option>Identifiant du personnel</option>
								<option>Type de sanction</option>
								<option>Motif</option>
							</select>
							</br></br><br/>
							<label>Recherche:</label><input type="search" name="supprimer">
							<input type="submit" value="SUPPRIMER">
						</br></br><br/>
					</form>
				</div>
				<div class="formulaire">
						<h3>NOUVELLE SANCTION</h3>
						<form action="" method="POST">
							<p><label>Date:<input type="date" name="date" required="obligatoire" size=50></label></p>
							<p><label>Motif:<input type="text" name="motif" required="obligatoire" size=49></label></p>
							<p><label>Type de sanction:<input type="text" name="type" required="obligatoire" size=36></label></p>
							<p><label>Identifiant du personnel:<input type="number" name="idpersonnel" required="obligatoire" size=29></label></p>
							<p><input type="submit" name="ajouter" value="Ajouter"></p>
						</form>
				</div>
				</br></br><br/>
				<div class="tableau">
					<?php
					$bdd=new PDO("mysql:host=localhost;dbname=transport;charset = utf8","root","");
					if(isset($_POST['Type']) AND isset($_POST['recherche']))
					{
						if($_POST['Type']==$Date_sanction)
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM sanction where date_sanction=?");
							$requete->execute(array($_POST['recherche']));

						}
						else if ($_POST['Type']==$Idpersonnel) 
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM sanction where Id_personnel=?");
							$requete->execute(array($_POST['recherche']));

						}
						else if($_POST['Type']==$motif)
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM sanction where motif=?");
							$requete->execute(array($_POST['recherche']));
						}
						else
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM sanction where type=?");
							$requete->execute(array($_POST['recherche']));
						}
					}
					else if(isset($_POST['Types']) AND isset($_POST['supprimer']))
					{
						if($_POST['Types']==$Date_sanction)
						{
							$requetes=$bdd->prepare("DELETE FROM sanction where date_sanction=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM sanction");

						}
						else if ($_POST['Types']==$Idpersonnel) 
						{
							$requetes=$bdd->prepare("DELETE FROM sanction where Id_personnel=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM sanction");

						}
						else if($_POST['Types']==$motif)
						{
							$requetes=$bdd->prepare("DELETE FROM sanction where motif=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM sanction");
						}
						else
						{
							$requetes=$bdd->prepare("DELETE FROM sanction where type=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM sanction");
						}
					}
					else if (isset($_POST['ajouter']) AND isset($_POST['date']) AND isset($_POST['motif']) AND isset($_POST['idpersonnel']) AND isset($_POST['type']))
					{
							$requetes=$bdd->prepare('INSERT INTO sanction(type,date_sanction,motif,Id_personnel) VALUES(?,?,?,?)');
							$requetes->execute(array($_POST['type'],$_POST['date'],$_POST['motif'],$_POST['idpersonnel']));
							$requete=$bdd->query("SELECT DISTINCT* FROM sanction");
					}
					else
					{
						$requete=$bdd->query("SELECT DISTINCT* FROM sanction");
					}
				?>
					<table border="l">
						<caption><a href="sanction.php">Historique des Sanctions</a></caption>
						<tr>
							<th>Type de Sanction</th>
							<th>Date de Sanction</th>
							<th>Motif de Sanction</th>
							<th>Identifiant du personnel</th>
						</tr>
						<?php
							while($resultat=$requete->fetch())
							{
								?>
									<tr>
										<td><?php echo $resultat['type'];?></td>
										<td><?php echo $resultat['date_sanction'];?></td>
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