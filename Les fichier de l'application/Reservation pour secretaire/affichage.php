
<?php
// Effectuer ici la requête qui insère le message
try
{
   $bdd = new PDO('mysql:host =127.0.0.1;dbname=transport;charset = utf8',"root", "");

}
catch(Exception $e)
{
    die('Ereur:'.$e ->getMessage());
}
//insertion des requetes a l'aide d'une requete preparée
if(isset($_POST['ajouter']))
    {
       
        $requete = $bdd->prepare('INSERT INTO reservation (Id_client,date_reservation,nombre_place) VALUES(?,?,?)');
        $requete ->execute(array($_POST['id_client'], $_POST["date_reservation"],$_POST["nbre_place"]));
        
    }
    elseif(isset($_POST['annuler']))
    {
        $requete = $bdd->prepare('DELETE FROM reservation WHERE Id_client = ? AND date_reservation = ? AND nombre_place = ?');
        $requete ->execute(array($_POST['id_client_annul'],$_POST['date_reservation_annul'],$_POST['nbre_place_annul']));
     }   
// Puis rediriger vers minichat.php comme ceci :
header('Location: reservation.php');
?>