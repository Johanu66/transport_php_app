<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css"/>
		<title>PRESENCE</title>	
	</head>
	<?php   
			$Date_presence="Date de Presence";
			$Idpersonnel="Identifiant du personnel";
			$presence="Presence";

	?>
	<body>
	<?php include("../Accueil/header.php"); ?>
		<div class="bloc"><br/><br/>
			<h1>PRESENCE</h1></br>
				<div>
					<h4>RECHERCHER UNE PRESENCE DANS L'HISTORIQUE</h4>
					<form action="presence.php" method="POST">
							<label for="Type">Type de Recherche:</label>
							<select name="Type" id="type">
								<option>Date de Presence</option>
								<option>Identifiant du personnel</option>
								<option>Presence</option>
							</select>
							</br></br><br/>
							<label>Recherche:</label><input type="search" name="recherche">
							<input type="submit" value="RECHERCHER"/>
						</br></br><br/>
					</form>
				</div>
				<div>
					<h4>SUPPRIMER UNE PRESENCE</h4>
					<form action="presence.php" method="POST">
							<label for="Types">Type de Recherche:</label>
							<select name="Types" id="type">
								<option>Date de Presence</option>
								<option>Identifiant du personnel</option>
								<option>Presence</option>
							</select>
							</br></br><br/>
							<label>Recherche:</label><input type="search" name="supprimer">
							<input type="submit" value="SUPPRIMER">
						</br></br><br/>
					</form>
				</div>
				<div class="formulaire">
						<h3>NOUVELLE PRESENCE</h3>
						<form action="presence.php" method="POST">
							<p><label>Date:<input type="date" name="date" required="obligatoire" size=51></label></p>
							<p><label>Identifiant du Personnel:<input type="number" name="idpersonnel" required="obligatoire" size=30></label></p>
							<p><input type="radio" name="presence" value='P' required="obligatoire"><label>Présent</label><input type="radio" name="presence" value='A' required="obligatoire" size=49><label>Absent</label></p>
							<p><input type="submit" name="ajouter" value="AJOUTER"></p>
						</form>
				</div>
				</br></br><br/>
				<div class="tableau">
					<?php
					$bdd=new PDO("mysql:host=localhost;dbname=transport;charset = utf8","root","");
					if(isset($_POST['Type']) AND isset($_POST['recherche']))
					{
						if($_POST['Type']==$Date_presence)
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM presence where date_presence=?");
							$requete->execute(array($_POST['recherche']));

						}
						else if ($_POST['Type']==$Idpersonnel) 
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM presence where Id_personnel=?");
							$requete->execute(array($_POST['recherche']));

						}
						else if($_POST['Type']==$presence)
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM presence where presence=?");
							$requete->execute(array($_POST['recherche']));
						}
					}
					else if(isset($_POST['Types']) AND isset($_POST['supprimer']))
					{
						if($_POST['Types']==$Date_presence)
						{
							$requetes=$bdd->prepare("DELETE FROM presence where date_presence=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM presence");

						}
						else if ($_POST['Types']==$Idpersonnel) 
						{
							$requetes=$bdd->prepare("DELETE FROM presence where Id_personnel=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM presence");

						}
						else if($_POST['Types']==$presence)
						{
							$requetes=$bdd->prepare("DELETE FROM presence where presence=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM presence");
						}
					}
					else if (isset($_POST['ajouter']) AND isset($_POST['date']) AND isset($_POST['presence']) AND isset($_POST['idpersonnel'])) 
					{
							$requetes=$bdd->prepare('INSERT INTO presence(date_presence,presence,Id_personnel) VALUES(?,?,?)');
							$requetes->execute(array($_POST['date'],$_POST['presence'],$_POST['idpersonnel']));
							$requete=$bdd->query("SELECT DISTINCT* FROM presence");
					}
					else
					{
						$requete=$bdd->query("SELECT DISTINCT* FROM presence");
					}
				?>
					<table border="1">
						<caption><a href="presence.php">Historique des Presence</a></caption>
						<tr>
							<th>Date de presence</th>
							<th>Presence</th>
							<th>Identifiant du Personnel</th>
						</tr>
						<?php
							while($resultat=$requete->fetch())
							{
								?>
									<tr>
										<td><?php echo $resultat['date_presence'];?></td>
										<td><?php echo $resultat['presence'];?></td>
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