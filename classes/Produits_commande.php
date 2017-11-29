<?php
require_once("Mysql.php");
class Produits extends Mysql
{
	// Les attributs priv�s
	private $_id_prod;
	private $_id_cmd;
    private $_qte;
    private $_prix;


	// M�thode magique pour les setters & getters
	public function __get($attribut) {
		if (property_exists($this, $attribut)) 
                return ( $this->$attribut ); 
        else
			exit("Erreur dans la calsse " . __CLASS__ . " : l'attribut $property n'existe pas!");     
    }

    public function __set($attribut, $value) {
        if (property_exists($this, $attribut)) {
            $this->$attribut = (mysqli_real_escape_string($this->get_cnx(), $value)) ;
        }
        else
        	exit("Erreur dans la calsse " . __CLASS__ . " : l'attribut $property n'existe pas!");
    }

	public function details($id)
	{
		$q = "SELECT * FROM produit_commande WHERE id ='$id'";
		$res = $this->requete($q);
		$row = mysqli_fetch_array( $res); 
		$cat = new Produits();
		
		$cat->_id 			= $row['id_prod'];
        $cat->_libelle 		= $row['id_cmd'];
        $cat->_prix         = $row['qte'];
		$cat->_image 		= $row['prix'];
	
        
		return $cat;
	}


	public function liste()
	{
		$q = "SELECT * FROM produit_commande ORDER BY id_cmd";
		$list_cat = array(); // Tableau VIDE
		$res = $this->requete($q);
		while($row = mysqli_fetch_array( $res)){
			$cat = new Produits_commande();

		$cat->_id 			= $row['id_prod'];
        $cat->_libelle 		= $row['id_cmd'];
        $cat->_prix         = $row['qte'];
		$cat->_image 		= $row['prix'];
           
		
			$list_cat[]=$cat;
		}
		
		return $list_cat;
	}



	public function liste_par_cmd($id)
	{
		$q = "SELECT * FROM produit_commande WHERE id_cmd=$id ORDER BY libelle";
		$list_cat = array(); // Tableau VIDE
		$res = $this->requete($q);
		while($row = mysqli_fetch_array( $res)){
			$cat = new Produits_commande();

		$cat->_id 			= $row['id_prod'];
        $cat->_libelle 		= $row['id_cmd'];
        $cat->_prix         = $row['qte'];
		$cat->_image 		= $row['prix'];
           
		
			$list_cat[]=$cat;
		}
		
		return $list_cat;
	}
	

	public function ajouter()
	{
	    $q = "INSERT INTO produit_commande(id_prod, id_cmd, qte, prix, ) VALUES 
	  		('$this->id_prod', '$this->id_cmd','$this->qte', '$this->prix' )";
		$res = $this->requete($q);
		return mysqli_insert_id($this->get_cnx());
	}
	
	public function modifier(){
		$q = "UPDATE produit_commande SET
			  libelle 	= '$this->_libelle',
			  description = '$this->_description',
                prix= '$this->_prix',
                 image = IF('$this->_image' = '', image, '$this->_image') 
			  WHERE id = '$this->_id' ";
	  
		$res = $this->requete($q);
		return $res;
	}

	public function supprimer($id){
		$q = "DELETE FROM produit_commande WHERE id = '$id'";
		$res = $this->requete($q);
		return $res;
	}	 
}
?>