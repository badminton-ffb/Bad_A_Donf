<?php
	
	class Categorie
	{
		private $categorie_id;
		private $nom_categorie;
		private $age_debut;
		private $age_fin;
		private $db;


		public function __construct ($categorie_id, $nom_categorie, $age_debut, $age_fin)
		{
			$this->categorie_id = $categorie_id;
			$this->nom_categorie = $nom_categorie;
			$this->age_debut = $age_debut;
			$this->age_fin = $age_fin;
			$this->db = connectionDB();
		}

		public function insertCategorie()
		{
			$query = $this->db->prepare("INSERT INTO Categorie (categorie_id, nom_categorie, age_debut, age_fin) VALUES     (:categorie_id, :nom_categorie, :age_debut, :age_fin);");
			$res = $query->execute(array(
				'categorie_id' => $this->categorie_id,
				'nom_categorie' => $this->nom_categorie,
				'age_debut' => $this->age_debut,
				'age_fin' => $this->age_fin
				));
			return $res;
		}

		public function delCategorie()
		{
			$query = $this->db->prepare("DELETE FROM Categorie WHERE categorie_id = :categorie_id");
			$res = $query->execute(array(
				'categorie_id' => $this->categorie_id
				));
			return $res;
		}
		
		public function searchCategorie()
		{
			$query = $this->db->prepare('SELECT * FROM Categorie WHERE categorie_id LIKE :categorie_id 
													  OR nom_categorie LIKE :nom_categorie
													  OR age_debut LIKE :age_debut
													  OR age_fin LIKE :age_fin
													  ORDER BY categorie_id ; ');
			$query->execute(array(
				'categorie_id' => $this->categorie_id,
				'nom_categorie' => $this->nom_categorie,
				'age_debut' => $this->age_debut,
				'age_fin' => $this->age_fin
				));
			$res = $query->fetchAll();
			return $res;
		}

		public function updateCategorie()
		{
			$query = $this->db->prepare('UPDATE Categorie SET nom_categorie = :nom_categorie, age_debut = :age_debut, age_fin = :age_fin
													WHERE categorie_id = :categorie_id ;');
			$res = $query->execute(array(
				'categorie_id' => $this->categorie_id,
				'nom_categorie' => $this->nom_categorie,
				'age_debut' => $this->age_debut,
				'age_fin' => $this->age_fin
				));
			return $res;
		}

		public function selectNomCategorie()
		{
			$query = $this->db->prepare('SELECT nom_categorie FROM Categorie WHERE categorie_id = :categorie_id');
			$query->execute(array(
				'categorie_id' => $this->categorie_id,
				));
			$res = $query->fetch();
			return $res;
		}

		public function selectAllCategorie()
		{
			$query = $this->db->prepare('SELECT categorie_id, nom_categorie FROM Categorie');
			$query->execute();
			$res = $query->fetchAll();
			return $res;
		}
	}