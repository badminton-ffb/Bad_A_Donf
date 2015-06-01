<?php 
	include('../../connexionBD.php');
    include_once("../../models/club/modelCl.php");
	include_once("../../models/user/modelU.php");

    // Data from form
    $club_id = "";
    isset($_POST['nom_club']) ? $nom_club = htmlspecialchars($_POST['nom_club']) : "";
    isset($_POST['ville_id']) ? $ville_id = htmlspecialchars(trim(substr($_POST['ville_id'],0,2))) : "";
    isset($_POST['club_id_del']) ? $club_id_del = htmlspecialchars(trim(substr($_POST['club_id_del'],0,2))) : "";
	isset($_POST['club_id_upd']) ? $club_id_upd = htmlspecialchars(trim(substr($_POST['club_id_upd'],0,2))) : ""; 
	isset($_POST['nom_club_upd']) ? $nom_club_upd = htmlspecialchars($_POST['nom_club_upd']) : "";   
	isset($_POST['ville_id_upd']) ? $ville_id_upd = htmlspecialchars(trim(substr($_POST['ville_id_upd'],0,2))) : "";
	isset($_POST['insert']) ? $insert = htmlspecialchars($_POST['insert']) : "";
	isset($_POST['delete']) ? $delete = htmlspecialchars($_POST['delete']) : "";
	isset($_POST['search_text']) ? $search_text = '%'.htmlspecialchars($_POST['search_text']).'%' : "";
	isset($_POST['search']) ? $search = htmlspecialchars($_POST['search']) : "";
	isset($_POST['update']) ? $update = htmlspecialchars($_POST['update']) : "";
	$nom_club = htmlspecialchars($nom_club);
	$nom_club_upd = htmlspecialchars($nom_club_upd);
	
	// INSERTION
	if (isset($insert) && isset($nom_club) && !empty($nom_club) && isset($ville_id) && !empty($ville_id))
	{
		$club = new Club($club_id, $nom_club, $ville_id);
		$query = $club->insertClub();
		if($query == 1) //insertion done
		{
			$ins = "Le club '" . $nom_club . "' a été ajoutée à la base de données !";
		}
		else // insertion failed
		{
			$ins = "La requête d'insertion a rencontré des erreurs";
		}
	}
	
	// DELETION
	if(isset($delete) && isset($club_id_del) && !empty($club_id_del))
	{
		$club = new Club($club_id_del,"","");
		$query = $club->delClub();
		if($query == 1) // deletion done
		{
			$del = "Le club '" . $club_id_del . "' a été supprimé !";
		}
		else // deletion failed
		{
			$del = "La requête de suppression a rencontré des erreurs";
		}
	}

	// SEARCH
	if(isset($search) && isset($search_text) && !empty($search_text)) //button "Rechercher"
	{
		$club = new Club($search_text, $search_text, $search_text);
		$search_clubs = array();

		$search_clubs['search_club']= $club->searchClub(); //array of clubs matching search condition

		$nb_joueur = array();
		foreach($search_clubs['search_club'] as $search_club)
		{
			$clubs = new Club($search_club['club_id'], $search_club['nom_club'], $search_club['ville_id']);
			array_push($nb_joueur, $clubs->nbJoueurClub());
		}
	}

	// UPDATE
	if (isset($update) && isset($club_id_upd) && !empty($club_id_upd) && isset($ville_id_upd) && !empty($ville_id_upd))
	{	
		if (empty($nom_club_upd))
		{
			$club_tmp = new Club($club_id_upd,"","");
			$nom_club_upd = $club_tmp->selectNomClub();
			var_dump($nom_club_upd['nom_club']);
			$club = new Club($club_id_upd, $nom_club_upd['nom_club'], $ville_id_upd);
			$query = $club->updateClub();
		}
		else
		{
			$club = new Club($club_id_upd, $nom_club_upd, $ville_id_upd);
			$query = $club->updateClub();
		}	
		if($query == 1) //update done
		{
			$upd = "Le club '" . $club_id_upd . "' a été mis à jour !";
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

	//ALL VILLES
	$villes = array();
	$villes['info_ville']= $club->selectAllVille();
	
	//USER 
	if (isset($_COOKIE['id_usr']))
	{
		$user = new User($_COOKIE['id_usr'], "", "", "");
	    $users = array();
	    $users['User'] = $user->getToken();
	}

    include_once('../../views/club/index.php');