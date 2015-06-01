<?php

	class User
	{
		private $id_user;
		private $login_user;
		private $pswd_user;
		private $token_user;
		private $db;


		public function __construct ($id_user, $login_user, $pswd_user, $token_user)
		{
			$this->id_user = $id_user;
			$this->login_user = $login_user;
			$this->pswd_user = $pswd_user;
			$this->token_user = $token_user;
			$this->db = connectionDB();
		}


		public function existUser()
		{
			$query = $this->db->prepare("SELECT id_user, login_usr, pswd_usr, token_usr  FROM User WHERE login_usr = :login_user AND pswd_usr = :pswd_user");
			$query->execute(array(
				'login_user' => $this->login_user,
				'pswd_user' => $this->pswd_user
				));
			return $query->fetchAll();
		}


		public function insertUser()
		{
			$query = $this->db->prepare("INSERT INTO User (id_user, login_usr, pswd_usr, token_usr) VALUES (:id_user, :login_user, :pswd_user, :token_user);");
			$res = $query->execute(array(
				'id_user' => $this->id_user,
				'login_user' => $this->login_user,
				'pswd_user' => $this->pswd_user,
				'token_user' => $this->token_user
				));
			return $res;
		}
		
		public function infoUser()
		{
			$query = $this->db->prepare("DESCRIBE User;");
			$query->execute();
			return $query->fetchAll();
		}


		public function getIdUser()
		{
			$query = $this->db->prepare("SELECT id_user FROM User WHERE login_usr = :login_user AND pswd_usr = :pswd_user");
			$query->execute(array(
				'login_user' => $this->login_user,
				'pswd_user' => $this->pswd_user
				));
			var_dump($query);
			return $query->fetchAll();
		}


		public function getLogin()
		{
			$query = $this->db->prepare("SELECT login_usr FROM User WHERE id_user = :id_user");
			$query->execute(array(
				'id_user' => $this->id_user
				));
			return $query->fetchAll();
		}


		public function getToken()
		{
			$query = $this->db->prepare("SELECT token_usr FROM User WHERE id_user = :id_user");
			$query->execute(array(
				'id_user' => $this->id_user
				));
			return $query->fetchAll();
		}


		public function newToken($token)
		{
			$query = $this->db->prepare("UPDATE User SET token_usr = :token_user WHERE login_usr = :login_user");
			$query->execute(array(
				'token_user' => $token,
				'login_user' => $this->login_user
				));
			return $query;
		}

	}