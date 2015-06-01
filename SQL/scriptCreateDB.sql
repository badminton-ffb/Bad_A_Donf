#CATEGORIE
CREATE TABLE IF NOT EXISTS Categorie  (
	 categorie_id  int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	 nom_categorie  varchar(100) NOT NULL,
	 age_debut  int NOT NULL,
	 age_fin  int NOT NULL
);

#VILLE
CREATE TABLE IF NOT EXISTS Ville  (
   ville_id  int NOT NULL PRIMARY KEY AUTO_INCREMENT,
   nom_ville  varchar(100) NOT NULL
);

#CLUB
CREATE TABLE IF NOT EXISTS Club  (
   club_id  int NOT NULL PRIMARY KEY AUTO_INCREMENT,
   nom_club varchar(100) NOT NULL,
   ville_id  int NOT NULL,
  
  FOREIGN KEY (ville_id)
		REFERENCES Ville(ville_id) ON DELETE CASCADE
		
);

#JOUEUR
CREATE TABLE IF NOT EXISTS Joueur  (
   licence  int NOT NULL PRIMARY KEY AUTO_INCREMENT,
   nom_joueur  varchar(100) NOT NULL,
   prenom_joueur  varchar(100) NOT NULL,
   date_naissance  DATE NOT NULL,
   date_premiere_inscription  DATE NOT NULL,
   club_id  int NOT NULL,
   categorie_id  int NOT NULL,
   img_src varchar(255),
  
  FOREIGN KEY (club_id) 
        REFERENCES Club(club_id) ON DELETE CASCADE,
		
  FOREIGN KEY (categorie_id) 
        REFERENCES Categorie(categorie_id) ON DELETE CASCADE
		
);

#USER
CREATE TABLE IF NOT EXISTS User (
  id_user int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  login_usr varchar(50) NOT NULL,
  pswd_usr varchar(50) NOT NULL,
  token_usr varchar(100) NOT NULL,
);

#TRIGGERS

CREATE TRIGGER `update_categorie_joueur` BEFORE INSERT ON `joueur` FOR EACH ROW 
	BEGIN
		 IF year(new.date_naissance) <= (SELECT year(NOW())-40) THEN SET NEW.categorie_id=8;
		 ELSEIF year(new.date_naissance) <= (SELECT year(NOW())-20) and  year(new.date_naissance) > (SELECT year(NOW())-40) THEN SET NEW.categorie_id= 7;
		 ELSEIF year(new.date_naissance) <= (SELECT year(NOW())-18) and  year(new.date_naissance) > (SELECT year(NOW())-20) THEN SET NEW.categorie_id=6;
		 ELSEIF year(new.date_naissance) <= (SELECT year(NOW())-16) and  year(new.date_naissance) > (SELECT year(NOW())-18) THEN SET NEW.categorie_id= 5;
		 ELSEIF year(new.date_naissance) <= (SELECT year(NOW())-14) and  year(new.date_naissance) > (SELECT year(NOW())-16) THEN SET NEW.categorie_id= 4;
		 ELSEIF year(new.date_naissance) <= (SELECT year(NOW())-12) and  year(new.date_naissance) > (SELECT year(NOW())-14) THEN SET NEW.categorie_id= 3;
		 ELSEIF year(new.date_naissance) <= (SELECT year(NOW())-10) and  year(new.date_naissance) > (SELECT year(NOW())-12) THEN SET NEW.categorie_id= 2;
		 ELSEIF year(new.date_naissance) > (SELECT year(NOW())-10) THEN SET NEW.categorie_id= 1;
		 END IF;
	END;
 
CREATE TRIGGER `ins_check_age_fin_categorie` BEFORE INSERT ON `categorie` FOR EACH ROW 
	BEGIN
		IF new.age_fin <= new.age_debut THEN 
			SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Age de fin invalide, il doit être supérieur à celui de début';
		END IF;
	END;
	
CREATE TRIGGER `upd_check_age_fin_categorie` BEFORE UPDATE ON `categorie` FOR EACH ROW 
	BEGIN
		IF new.age_fin <= new.age_debut THEN 
			SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Age de fin invalide, il doit être supérieur à celui de début';
		END IF;
	END;




