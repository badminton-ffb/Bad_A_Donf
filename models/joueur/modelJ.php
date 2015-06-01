<?php

	class Joueur
	{
		private $licence;
		private $nom_joueur;
		private $prenom_joueur;
		private $date_naissance;
		private $date_premiere_inscription;
		private $club_id;
		private $categorie_id;
		private $img_src;


		public function __construct ($licence, $nom_joueur, $prenom_joueur, $date_naissance, $date_premiere_inscription, $club_id, $categorie_id, $img_src)
		{
			$this->licence = $licence;
			$this->nom_joueur = $nom_joueur;
			$this->prenom_joueur = $prenom_joueur;
			$this->date_naissance = $date_naissance;
			$this->date_premiere_inscription = $date_premiere_inscription;
			$this->club_id = $club_id;
			$this->categorie_id = $categorie_id;
			$this->img_src = $img_src;
			$this->db = connectionDB();
		}

		public function insertJoueur()
		{
			$query = $this->db->prepare("INSERT INTO Joueur (licence, nom_joueur, prenom_joueur, date_naissance, date_premiere_inscription, club_id, categorie_id, img_src) VALUES (:licence, :nom_joueur, :prenom_joueur, :date_naissance, :date_premiere_inscription, :club_id, :categorie_id, :img_src);");
			$res = $query->execute(array(
				'licence' => $this->licence,
				'nom_joueur' => $this->nom_joueur,
				'prenom_joueur' => $this->prenom_joueur,
				'date_naissance' => $this->date_naissance,
				'date_premiere_inscription' => $this->date_premiere_inscription,
				'club_id' => $this->club_id,
				'categorie_id' => $this->categorie_id,
				'img_src'=> $this->img_src
				));
			return $res;
		}

		public function delJoueur()
		{
			$query = $this->db->prepare("DELETE FROM Joueur WHERE licence = :licence");
			$res = $query->execute(array(
				'licence' => $this->licence
				));
			return $res;
		}
		
		public function searchJoueur()
		{
			$query = $this->db->prepare('SELECT * FROM Joueur j, Club cl, Categorie ca WHERE j.categorie_id = ca.categorie_id
																			AND j.club_id = cl.club_id
																			AND (j.licence LIKE :licence 
																			OR j.nom_joueur LIKE :nom_joueur
																			OR j.prenom_joueur LIKE :prenom_joueur
																			OR cl.nom_club LIKE :club_id
																			OR ca.nom_categorie LIKE :categorie_id)
																			ORDER BY j.licence ASC;');
			$query->execute(array(
				'licence' => $this->licence,
				'nom_joueur' => $this->nom_joueur,
				'prenom_joueur' => $this->prenom_joueur,
				'club_id' => $this->club_id,
				'categorie_id' => $this->categorie_id
				));
			$res = $query->fetchAll();
			return $res;
		}

		public function updateJoueur()
		{
			$query = $this->db->prepare('UPDATE Joueur SET club_id = :club_id, categorie_id = :categorie_id, img_src = :img_src
													WHERE licence = :licence ;');
			$res = $query->execute(array(
				'licence' => $this->licence,
				'club_id' => $this->club_id,
				'categorie_id' => $this->categorie_id,
				'img_src'=> $this->img_src
				));
			return $res;
		}

		public function selectAllJoueur()
		{
			$query = $this->db->prepare('SELECT licence, nom_joueur, prenom_joueur FROM Joueur');
			$query->execute();
			$res = $query->fetchAll();
			return $res;
		}

		public function selectImgJoueur()
		{
			$query = $this->db->prepare('SELECT img_src FROM Joueur WHERE licence = :licence');
			$query->execute(array(
				'licence' => $this->licence,
				));
			$res = $query->fetchAll();
			return $res;
		}
	}