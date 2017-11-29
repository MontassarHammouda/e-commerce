<?php
require_once("Mysql.php");
class Produit extends Mysql
{
	// Les attributs privés
	private $_id;
	private $_libelle;
	private $_description;
	private $_prix;
	private $_image;
	private $_idcategorie;

	// Méthode magique pour les setters & getters
	public function __get($attribut) {
		if (property_exists($this, $attribut)) 
                return ( $this->$attribut ); 
        else
			exit("Erreur dans la calsse " . __CLASS__ . " : l'attribut $attribut n'existe pas!");     
    }

    public function __set($attribut, $value) {
        if (property_exists($this, $attribut)) {
            $this->$attribut = (mysqli_real_escape_string($this->get_cnx(), $value)) ;
        }
        else
        	exit("Erreur dans la calsse " . __CLASS__ . " : l'attribut $attribut n'existe pas!");
    }

	public function details($id)
	{
		$q = "SELECT * FROM produit WHERE id ='$id'";
		$res = $this->requete($q);
		$row = mysqli_fetch_array( $res); 
		$pat = new Produit();
		
		$pat->_id 			= $row['id'];
		$pat->_libelle 		= $row['libelle'];
		$pat->_image 		= $row['image'];
		$pat->_description	= $row['description'];
		$pat->_prix		 = $row['prix'];
		$pat->_idcategorie = $row['idcategorie'];
	
		return $pat;
	}


	public function liste()
	{
		$q = "SELECT * FROM produit ORDER BY libelle";
		$list_pat = array(); // Tableau VIDE
		$res = $this->requete($q);
		while($row = mysqli_fetch_array( $res)){
			$pat = new Produit();
		
		$pat->_id 			= $row['id'];
		$pat->_libelle 		= $row['libelle'];
		$pat->_image 		= $row['image'];
		$pat->_description	= $row['description'];
		$pat->_prix		 = $row['prix'];
		$pat->_idcategorie = $row['idcategorie'];
	
		
		
			$list_pat[]=$pat;
		}
		
		return $list_pat;
	}
	



	public function liste_par_categorie($id_categorie)
	{
		$q = "SELECT * FROM produit WHERE id_categorie=$id_categorie ORDER BY libelle";
		$list_pat = array(); // Tableau VIDE
		$res = $this->requete($q);
		while($row = mysqli_fetch_array( $res)){
			$pat = new Produit();
		
		$pat->_id 			= $row['id'];
		$pat->_libelle 		= $row['libelle'];
		$pat->_image 		= $row['image'];
		$pat->_description	= $row['description'];
		$pat->_prix		 = $row['prix'];
		$pat->_idcategorie = $row['id_categorie'];
	
		
		
			$list_pat[]=$pat;
		}
		
		return $list_pat;
	}
	public function ajouter()
	{
	    $q = "INSERT INTO produit(id, libelle,description,prix,image,id_categorie) VALUES 
	  		(  null				, '$this->_libelle'	, '$this->_description'	,'$this->_prix','$this->_image'	,$this->_idcategorie
			      
			)";
		$res = $this->requete($q);
		return mysqli_insert_id($this->get_cnx());
	}
	
	public function modifier(){
		$q = "UPDATE produit SET
			  libelle 	= '$this->_libelle',
			  image = IF('$this->_image' = '', image, '$this->_image') ,
			  description = '$this->_description',
			  prix ='$this->_prix',
			  id_categorie='$this->_idcategorie'

			  WHERE id = '$this->_id' ";
	  
		$res = $this->requete($q);
		return $res;
	}

	public function supprimer($id){	
		$q = "DELETE FROM produit WHERE id = '$id'";
		$res = $this->requete($q);
		return $res;
	}	 
}
?>