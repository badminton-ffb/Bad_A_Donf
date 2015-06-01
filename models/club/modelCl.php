<?php

	class Club
	{
		private $club_id;
		private $nom_club;
		private $ville_id;


		public function __construct ($club_id, $nom_club, $ville_id)
		{
			$this->club_id = $club_id;
			$this->nom_club = $nom_club;
			$this->ville_id = $ville_id;
			$this->db = connectionDB();
		}

		public function insertClub()
		{
			$query = $this->db->prepare("INSERT INTO Club (club_id, nom_club, ville_id) VALUES     (:club_id, :nom_club, :ville_id);");
			$res = $query->execute(array(
				'club_id' => $this->club_id,
				'nom_club' => $this->nom_club,
				'ville_id' => $this->ville_id
				));
			return $res;
		}

		public function delClub()
		{
			$query = $this->db->prepare("DELETE FROM Club WHERE club_id = :club_id");
			$res = $query->execute(array(
				'club_id' => $this->club_id
				));
			return $res;
		}
		
		public function searchClub()
		{
			$query = $this->db->prepare('SELECT * FROM Club c, Ville v WHERE c.ville_id = v.ville_id
													  AND(c.club_id LIKE :club_id
													  OR c.nom_club LIKE :nom_club
													  OR v.nom_ville LIKE :ville_id)
													  ORDER BY c.club_id ; ');
			$query->execute(array(
				'club_id' => $this->club_id,
				'nom_club' => $this->nom_club,
				'ville_id' => $this->ville_id,
				));
			$res = $query->fetchAll();
			return $res;
		}
		
		public function updateClub()
		{
			$query = $this->db->prepare('UPDATE Club SET nom_club = :nom_club, ville_id = :ville_id
													WHERE club_id = :club_id ;');
			$res = $query->execute(array(
				'club_id' => $this->club_id,
				'nom_club' => $this->nom_club,
				'ville_id' => $this->ville_id,
				));
			return $res;
		}

		public function selectAllClub()
		{
			$query = $this->db->prepare('SELECT club_id, nom_club FROM Club');
			$query->execute();
			$res = $query->fetchAll();
			return $res;
		}


		public function selectNomClub()
		{
			$query = $this->db->prepare('SELECT nom_club FROM Club WHERE club_id = :club_id');
			$query->execute(array(
				'club_id' => $this->club_id,
				));
			$res = $query->fetch();
			return $res;
		}


		public function selectAllVille()
		{
			$query = $this->db->prepare('SELECT ville_id, nom_ville FROM Ville');
			$query->execute();
			$res = $query->fetchAll();
			return $res;
		}

		public function nbJoueurClub()
		{
			$query = $this->db->prepare('SELECT COUNT(licence) as nombre FROM Joueur
																 WHERE club_id = :club_id');
			$query->execute(array(
				'club_id' => $this->club_id,
				));
			$res = $query->fetch();
			return $res;
		}
	}