<?php session_start();
require_once("./classes/Commande.php");
@$nom = $_POST['nom'];
//@$id = $_POST['id'];
@$email = $_POST['email'];
@$adress = $_POST['adress'];
//@$s=$_SESSION['panier'];
echo "i'm here";
if( !empty($nom) && !empty($email)&& !empty($adress) ) 
{
	$cat = new Commande();
	$cat->_nom = $nom;
	$cat->_email = $email;
	$cat->_adress = $adress;
	
	if( empty($id) ) 	// Ajout
	{
	$id = $cat->ajouter();
		
	}else				// Modification
	{
		$cat->_id = $id;
		$cat->modifier();
	}

	header("Location: paiement.php");
} 
else 
	exit('Tous les champs sont obligatoires !!');
?>
