<!DOCTYPE html>
 <html>
 <head>
 	<title>Ma page</title>
 	<meta charset="utf-8" />
	<link rel='stylesheet' href='Client.css' />
 </head>
 <body>
	<section>
	<?php include("../Accueil/header.php"); ?>
			<div><h1>CLIENT</h1></div>
				<h4>RECHERCHER UN CLIENT DANS L'HISTORIQUE</h4>
					<form action="" method="POST">
							<label for="Type">Type de Recherche:</label>
							<select name="Type" id="type">
								<option>Identifiant du Client</option>
								<option>Nom</option>
								<option>Prenom</option>
								<option>Contact</option>
								<option>Ville actuelle</option>
								<option>Ville destination</option>
								<option>Numero d'identité</option>
								<option>Numero de payement</option>
								<option>Nombre de reservation</option>
								<option>Identifiant du bus</option>
							</select>
							</br></br><br/>
							<label>Recherche:</label><input type="search" name="recherche">
							<input type="submit" value="rechercher">
						</br></br><br/>
					</form>
				<h4>SUPPRIMER UN CLIENT</h4>
					<form action="" method="POST">
							<label for="Types">Type de Recherche:</label>
							<select name="Types" id="type">
								<option>Identifiant du Client</option>
								<option>Nom</option>
								<option>Prenom</option>
								<option>Contact</option>
								<option>Ville actuelle</option>
								<option>Ville destination</option>
								<option>Numero d'identité</option>
								<option>Numero de payement</option>
								<option>Nombre de reservation</option>
								<option>Identifiant du bus</option>
							</select>
							</br></br><br/>
							<label>Recherche:</label><input type="search" name="supprimer">
							<input type="submit" value="SUPPRIMER">
						</br></br><br/>
					</form>
				<div class="formulaire">
						<h3>NOUVEAU CLIENT</h3>
						<form action="" method="POST">
								<p><label>Nom:</label><input type='text' name='nom' required="obligatoire" size=50></p>
								<p><label>Prenom:</label><input type='text' name='prenom' required="obligatoire" size=47></p>
								<p><label>Contact:</label><input type='number' name='contact' required="obligatoire" size=46></p>
								<p><label>Ville actuelle: </label><input type='text' name='ville_actuelle' required="obligatoire" size=39></p>
								<p><label>Ville destination:</label><input type='text' name='ville_destination' required="obligatoire" size=36></p>
								<p><label>Numero d'identité:</label><input type='number' name='num_identite' required="obligatoire" size=35></p>
								<p><label>Numero de payement:</label><input type='number' name='num_paye' required="obligatoire" size=32></p>
								<p><label>Nombre de reservation:</label><input type='number' name='nombre_reservation' required="obligatoire" size=31></p>
								<p><label>Identifiant du bus:</label><input type='number' name='Id_bus' required="obligatoire" size=36></p>
								<p><input type="submit" name="ajouter" value="Ajouter"></p>
						</form>
				</div>
			<form method='POST' action=''>
				<input type='submit' name='netoyer' value='Netoyer tous les clients inutils' class='input'>
			</form>
			<?php 
					$bdd=new PDO("mysql:host=localhost;dbname=transport;charset = utf8","root","");
					if(isset($_POST['Type']) AND isset($_POST['recherche']))
					{
						if($_POST['Type']=="Identifiant du Client")
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM client where Id_client=?");
							$requete->execute(array($_POST['recherche']));

						}
						else if ($_POST['Type']=="Nom") 
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM client where nom=?");
							$requete->execute(array($_POST['recherche']));

						}
						else if($_POST['Type']=="Prenom")
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM client where prenom=?");
							$requete->execute(array($_POST['recherche']));
						}
						else if ($_POST['Type']=="Contact") 
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM client where contact=?");
							$requete->execute(array($_POST['recherche']));

						}
						else if($_POST['Type']=="Ville actuelle")
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM client where ville_actuelle=?");
							$requete->execute(array($_POST['recherche']));
						}
						else if ($_POST['Type']=="Ville destination") 
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM client where ville_destination=?");
							$requete->execute(array($_POST['recherche']));

						}
						else if($_POST['Type']=="Numero d'identité")
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM sanction where num_identite=?");
							$requete->execute(array($_POST['recherche']));
						}
						else if ($_POST['Type']=="Numero de payement") 
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM client where num_paye=?");
							$requete->execute(array($_POST['recherche']));

						}
						else if($_POST['Type']=="Nombre de reservation")
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM client where nombre_reservation=?");
							$requete->execute(array($_POST['recherche']));
						}
						else if($_POST['Type']=="Identifiant du bus")
						{
							$requete=$bdd->prepare("SELECT DISTINCT* FROM client where Id_bus=?");
							$requete->execute(array($_POST['recherche']));
						}
					}
					else if(isset($_POST['Types']) AND isset($_POST['supprimer'])){
						if($_POST['Types']=="Identifiant du Client")
						{
							$requetes=$bdd->prepare("DELETE FROM client where Id_client=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM client");

						}
						else if ($_POST['Types']=="Nom") 
						{
							$requetes=$bdd->prepare("DELETE FROM client where nom=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM client");

						}
						else if($_POST['Types']=="Prenom")
						{
							$requetes=$bdd->prepare("DELETE FROM client where prenom=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM client");
						}
						else if ($_POST['Types']=="Contact") 
						{
							$requetes=$bdd->prepare("DELETE FROM client where contact=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM client");

						}
						else if($_POST['Types']=="Ville actuelle")
						{
							$requetes=$bdd->prepare("DELETE FROM client where ville_actuelle=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM client");
						}
						else if ($_POST['Types']=="Ville destination") 
						{
							$requetes=$bdd->prepare("DELETE FROM client where ville_destination=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM client");

						}
						else if($_POST['Types']=="Numero d'identité")
						{
							$requetes=$bdd->prepare("DELETE FROM client where num_identite=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM client");
						}
						else if ($_POST['Types']=="Numero de payement") 
						{
							$requetes=$bdd->prepare("DELETE FROM client where num_paye=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM client");

						}
						else if($_POST['Types']=="Nombre de reservation")
						{
							$requetes=$bdd->prepare("DELETE FROM client where nombre_reservation=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM client");
						}
						else if($_POST['Types']=="Identifiant du bus")
						{
							$requetes=$bdd->prepare("DELETE FROM client where Id_bus=?");
							$requetes->execute(array($_POST['supprimer']));
							$requete=$bdd->query("SELECT DISTINCT* FROM client");
						}
					}
					else if (isset($_POST['ajouter']) AND isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['contact']) AND isset($_POST['ville_actuelle']) AND isset($_POST['num_identite']) AND isset($_POST['num_paye']) AND isset($_POST['ville_destination']) AND isset($_POST['nombre_reservation']) AND isset($_POST['Id_bus']))
					{
							$requetes=$bdd->prepare('INSERT INTO client(nom,prenom,contact,ville_actuelle,num_identite,num_paye,ville_destination,nombre_reservation,Id_bus) VALUES(?,?,?,?,?,?,?,?,?)');
							$requetes->execute(array($_POST['nom'],$_POST['prenom'],$_POST['contact'],$_POST['ville_actuelle'],$_POST['num_identite'],$_POST['num_paye'],$_POST['ville_destination'],$_POST['nombre_reservation'],$_POST['Id_bus']));
							$requete=$bdd->query("SELECT DISTINCT* FROM client");
					}
					else if(isset($_POST['netoyer'])){
						$requetes = $bdd->exec("DELETE FROM client WHERE Id_client NOT IN (SELECT Id_client FROM reservation)");
						$requete = $bdd->query("SELECT * FROM client");
					}
					else{
						$requete = $bdd->query("SELECT * FROM client");
					}
			?>
	<div>
    <table  border="1">
    	<caption><h1>Historique des Clients</h1></caption>
    		<tr>
    		<th>Identifiant du Client</th>
    		<th>Nom</th>
    		<th>Prenom</th>
    		<th>Contact</th>
    		<th>Ville actuelle</th>
			<th>Ville destination</th>
    		<th>Numero d'identité</th>
    		<th>Numero de payement</th>
    		<th>Nombre de reservation</th>
    		<th>Identifiant du bus</th>
    		</tr>
    		<?php
    		while($resultat = $requete->fetch())
    		{
    		?>
    		<tr>
    			<td><?php echo $resultat['Id_client']; ?></td>
    			<td><?php echo $resultat['nom']; ?></td>
    			<td><?php echo $resultat['prenom']; ?></td>
    			<td><?php echo $resultat['contact']; ?></td>
    			<td><?php echo $resultat['ville_actuelle']; ?></td>
				<td><?php echo $resultat['ville_destination']; ?></td>
    			<td><?php echo $resultat['num_identite']; ?></td>
    			<td><?php echo $resultat['num_paye']; ?></td>
				<td><?php echo $resultat['nombre_reservation']; ?></td>
    			<td><?php echo $resultat['Id_bus']; ?></td>
    		</tr>
    		<?php
   			}
   			?>
    </table>
    </div><br/><br/>
	<?php include("../Accueil/footer.php"); ?>
	</section>
 </body>
 </html>