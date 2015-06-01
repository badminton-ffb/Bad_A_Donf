<?php 
	include('../../connexionBD.php');
    include("../../models/joueur/modelJ.php");
    include("../../models/club/modelCl.php");
    include("../../models/categorie/modelC.php");
	include("../../models/user/modelU.php");

    // Data from form
    $licence = "";
    isset($_POST['nom_joueur']) ? $nom_joueur = htmlspecialchars($_POST['nom_joueur']) : "";
    isset($_POST['prenom_joueur']) ? $prenom_joueur = htmlspecialchars($_POST['prenom_joueur']) : "";
    isset($_POST['date_naissance']) ? $date_naissance = htmlspecialchars($_POST['date_naissance']) : "";
	$date_premiere_inscription = date('Y').'-'.date('m').'-'.date('d'); #date courrante
    isset($_POST['club_id']) ? $club_id = htmlspecialchars($_POST['club_id']) : "";
	$categorie_id = '5'; #Par default car le trigger s'occupe de modifier la valeur
	isset($_POST['licence_del']) ? $licence_del = htmlspecialchars($_POST['licence_del']) : "";
	isset($_POST['licence_upd']) ? $licence_upd = htmlspecialchars($_POST['licence_upd']) : "";
	isset($_POST['club_id_upd']) ? $club_id_upd = htmlspecialchars($_POST['club_id_upd']) : "";
	isset($_POST['categorie_id_upd']) ? $categorie_id_upd = htmlspecialchars($_POST['categorie_id_upd']) : "";
	isset($_POST['insert']) ? $insert = htmlspecialchars($_POST['insert']) : "";
	isset($_POST['delete']) ? $delete = htmlspecialchars($_POST['delete']) : "";
	isset($_POST['search_text']) ? $search_text = '%'.htmlspecialchars($_POST['search_text']).'%' : "";
	isset($_POST['search']) ? $search = htmlspecialchars($_POST['search']) : "";
	isset($_POST['update']) ? $update = htmlspecialchars($_POST['update']) : "";
	$nom_joueur = htmlspecialchars($nom_joueur);
	$prenom_joueur = htmlspecialchars($prenom_joueur);
	$date_naissance = htmlspecialchars($date_naissance);



    
    
    
	//INSERT
	if (isset($insert) && isset($nom_joueur) && !empty($nom_joueur) && isset($prenom_joueur) && !empty($prenom_joueur) && isset($date_naissance) && !empty($date_naissance) && isset($club_id) && !empty($club_id))
	{
		$img_src = $_FILES['img_src'];
	    if (empty($img_src['name'])) //Pas d'image choisie
	    {
	    	$img_src['name'] = "default.png";
	    }
	    else
	    {
	    	$img_src['name'] = str_replace(' ','_',$img_src['name']);
	    	$img_src['name'] = str_replace('&','_',$img_src['name']);
	    	$img_src['name'] = md5(time()) . '_' . $img_src['name']; //permit to have an unique name
	    }
    
		$joueur = new Joueur($licence, $nom_joueur, $prenom_joueur, $date_naissance, $date_premiere_inscription, $club_id, $categorie_id, $img_src['name']);
		$query = $joueur->insertJoueur();
		if($query == 1) //insertion done
		{
			$dir = '../../img/Joueurs/';
			move_uploaded_file($img_src['tmp_name'], $dir.$img_src['name']);
			$ins = "Le joueur '" . $nom_joueur . " " . $prenom_joueur . "' a été ajouté à la base de données !";
		}
		else // insertion failed
		{
			$ins = "La requête d'insertion a rencontré des erreurs";
		}
	}

	//DELETE
	if(isset($delete) && isset($licence_del) && !empty($licence_del))
	{
			$joueur = new Joueur($licence_del,"","","","","","","");
			$query = $joueur->delJoueur();
			if($query == 1) // deletion done
			{
				$del = "Le joueur '" . $licence_del . "' a été supprimé !";
			}
			else // deletion failed
			{
				$del = "La requête de suppression a rencontré des erreurs";
			}
	}
	
	//SEARCH
	if(isset($search) && isset($search_text) && !empty($search_text)) //button "Rechercher"
	{
		$joueur = new Joueur($search_text, $search_text, $search_text, "", "", $search_text, $search_text,"");
		$search_joueurs=array();
		$search_joueurs['search_joueur']= $joueur->searchJoueur();
	}
	
	// UPDATE
	if (isset($update) && isset($licence_upd) && !empty($licence_upd))
	{
		$img_src_upd = $_FILES['img_src_upd']; //Pas d'image choisie	
	    if (empty($img_src_upd['name']))
	    {
	    	$joueur_tmp = new Joueur($licence_upd, "", "", "", "", "", "", "");
	    	$img_src_upd['name'] = $joueur_tmp->selectImgJoueur();
	    	$img_src_upd['name'] = $img_src_upd['name'][0][0];
	    }
	    else
	    {
	    	$img_src_upd['name'] = str_replace(' ','_',$img_src_upd['name']);
	    	$img_src_upd['name'] = str_replace('&','_',$img_src_upd['name']);
	    	$img_src_upd['name'] = md5(time()) . '_' . $img_src_upd['name']; //permit to have an unique name
	    }
	    $joueur = new Joueur($licence_upd, "", "", "", "", $club_id_upd, $categorie_id_upd, $img_src_upd['name']);
		$query = $joueur->updateJoueur();
		if($query == 1) //update done
		{
			$dir = '../../img/Joueurs/';
			move_uploaded_file($img_src_upd['tmp_name'], $dir.$img_src_upd['name']);
			$upd = "Le joueur '" . $licence_upd . "'' a été mis à jour !";
		}
		else // update failed
		{
			$upd = "La requête de mise à jour a rencontré des erreurs";
		}
	}

	//ALL CLUBS
	$club = new Club("","","");
	$clubs = array();
	$clubs['info_club']= $club->selectAllClub();
 	

	//ALL JOUEUR
	$joueur = new Joueur("","","","","","","","");
	$joueurs = array();
	$joueurs['info_joueur'] = $joueur->selectAllJoueur();

	//ALL CATEGORIES
	$categorie = new Categorie("","","","");
	$categories = array();
	$categories['info_categorie'] = $categorie->selectAllCategorie();
	
	//USER 
	if (isset($_COOKIE['id_usr']))
	{
		$user = new User($_COOKIE['id_usr'], "", "", "");
	    $users = array();
	    $users['User'] = $user->getToken();
	}
	
    include_once('../../views/joueur/index.php');
