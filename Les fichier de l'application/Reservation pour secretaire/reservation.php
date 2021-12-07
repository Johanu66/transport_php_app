
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<title>reservations</title>
<link rel="stylesheet" href="reservation.css">
</head>
<body>
<?php include("../Accueil/header.php"); ?>
<section><br/>
<!--<p class="defile"><marquee bgcolor = "BLUE" behavior="alternate" direction="right">RESERVATION</marquee>
<marquee bgcolor ="blue">votre securité est notre priorité</marquee></p> -->
<div><h1>TABLE DE RESERVATION</h1></div>
<!-- formulaire d'ajout, d'anullation d'une resevation-->

<h3>Veillez entrez les informatins ci-dessous afin de confirmer les reservations des clients</h3>

<div class="formulaire">
	<fieldset>
    <legend>Enregistrement</legend>
	<form method='POST' action=''>
		<p><label>Type de Recherche:</label>
		<select name='type'>
			<option>Identifiant de la reservation</option>
			<option>Identifiant du client</option>
			<option>Date de reservation</option>
			<option>Nombre de place</option>
		</select></p>
		<p><label>Rechercher:</label><input type='search' name='recherche' size=28></p>
		<p><input type='submit' value='RECHERCHER' name='rechercher'></p>
	</form>
     <!-- Ajouter-->
    <form method="POST" action="affichage.php">
    
    <p><label for="id_client"> l'id du client</label>
    <input type="number" name="id_client" required="required" size=27><br></p>
   <p> <label for="date_reservation">Date de reservation</label>
    <input type="Date" name="date_reservation" required="required"><br></p>
     <p><label for="nbre_place"> Nombre de place</label>
    <input type="number" name="nbre_place" size=22><br></p>
    <input type="submit" value="AJOUTER" name="ajouter"><br>
    </form>
   <!-- Annuler-->
    <form method="POST" action="affichage.php">
    
    <p><label for="id_client_annul"> l'id du client</label>
    <input type="number" name="id_client_annul" required="required" size=27><br></p>
    <p><label for="date_reservation_annul">Date de reservation</label>
    <input type="date" name="date_reservation_annul"  required="required"><br></p>
    <p><label for="nbre_place"> Nombre de place</label>
    <input type="number" name="nbre_place_annul" size=22><br></p>
    <input type="submit" value="ANNULER" name="annuler"><br>
    </fieldset>
    </form>
</div>
<aside>
<!--creation d'une diaprorama (le tout s'applique en css) -->
<div class="diaprorama">
   
</div>
<p class="sous-diaprorama">Nous disposons des meilleurs bus de voyage de qualité  adaptée à votre goût
      afin de s'assurer de votre confort et de votre sécurité.
    </p>
</aside>
<?php
//connexion a la base de donnée
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
//gestion des erreures
try
{
   $bdd = new PDO('mysql:host =127.0.0.1;dbname=transport;charset = utf8',"root", "",$pdo_options);

}
catch(Exception $e)
{
    die('Ereur:'.$e ->getMessage());
}

?> 
<!-- creation d'une table pour inserrer les donner selectionner pour une bonne affichage-->
<br>L'HISTORIQUE DES RESERVATIONS<br>
<table id="table" border="2">
    <br>
    <tr>
	<td>Identifiant de la réservation</td>
	
    <td>Identifiant du client</td>
    
    <td>Date de réservation</td>
    
    <td>Nombre de place réserver</td>
    
</tr>
 <?php
 //Pour faire recherche
if(isset($_POST['rechercher'])){
	if($_POST['type']=="Identifiant du client"){
		$requete = $bdd->prepare("SELECT * FROM reservation WHERE Id_client=?");
		$requete->execute(array($_POST['recherche']));
	}
	else if($_POST['type']=="Date de reservation"){
		$requete = $bdd->prepare("SELECT * FROM reservation WHERE date_reservation=?");
		$requete->execute(array($_POST['recherche']));
	}
	else if($_POST['type']=="Nombre de place"){
		$requete = $bdd->prepare("SELECT * FROM reservation WHERE nombre_place=?");
		$requete->execute(array($_POST['recherche']));
	}
	else{
		$requete = $bdd->prepare("SELECT * FROM reservation WHERE Id_reservation=?");
		$requete->execute(array($_POST['recherche']));
	}
}
 //recuperation des données
else{
	$requete = $bdd->query("SELECT * FROM reservation");
}


 //affichage de la table reservation
while($resultat = $requete->fetch())
{
?>

<tr>
<!-- 
tout les messages sont affichés.
-->
<td><?php echo $resultat['Id_reservation']; ?></td>
<td><?php echo $resultat['Id_client']; ?></td>
<td><?php echo $resultat['date_reservation']; ?></td>
<td><?php echo $resultat['nombre_place'] ; ?></td>
</tr>
<tr>
    
</tr>

<?php
}
$requete->closeCursor();
?> 
</table> 
<br><br><br><br>
<marquee bgcolor ="yellowgreen" behavior="scroll" direction="right">Votre sécurité est notre priorité </marquee>
</section>
<?php include("../Accueil/footer.php"); ?>
</body>
</html>

