<?php 
	include('../../connexionBD.php');
    include_once("../../models/categorie/modelC.php");
	include("../../models/user/modelU.php");

    // Data from form
    $categorie_id = "";
    isset($_POST['nom_categorie']) ? $nom_categorie = htmlspecialchars($_POST['nom_categorie']) : "";
    isset($_POST['age_debut']) ? $age_debut = htmlspecialchars($_POST['age_debut']) : "";
    isset($_POST['age_fin']) ? $age_fin = htmlspecialchars($_POST['age_fin']) : "";
    isset($_POST['categorie_id_del']) ? $categorie_id_del = htmlspecialchars($_POST['categorie_id_del']) : "";
    isset($_POST['categorie_id_upd']) ? $categorie_id_upd = htmlspecialchars($_POST['categorie_id_upd']) : "";
    isset($_POST['nom_categorie_upd']) ? $nom_categorie_upd = htmlspecialchars($_POST['nom_categorie_upd']) : "";
    isset($_POST['age_debut_upd']) ? $age_debut_upd = htmlspecialchars($_POST['age_debut_upd']) : "";
    isset($_POST['age_fin_upd']) ? $age_fin_upd = htmlspecialchars($_POST['age_fin_upd']) : "";
	isset($_POST['insert']) ? $insert = htmlspecialchars($_POST['insert']) : "";
	isset($_POST['delete']) ? $delete = htmlspecialchars($_POST['delete']) : "";
	isset($_POST['search_text']) ? $search_text = '%'.htmlspecialchars($_POST['search_text']).'%' : "";
	isset($_POST['search']) ? $search = htmlspecialchars($_POST['search']) : "";
	isset($_POST['update']) ? $update = htmlspecialchars($_POST['update']) : "";
	$nom_categorie = htmlspecialchars($nom_categorie);
	$nom_categorie_upd = htmlspecialchars($nom_categorie_upd);
	
	// INSERTION
	if (isset($insert) && isset($nom_categorie) && !empty($nom_categorie) && isset($age_debut) && !empty($age_debut) && isset($age_fin) && !empty($age_fin))
	{
		$categorie = new Categorie($categorie_id, $nom_categorie, $age_debut, $age_fin);
		$query = $categorie->insertCategorie();
		if($query == 1) //insertion done
		{
			$ins = "La categorie '" . $nom_categorie . "'' a été ajoutée à la base de données !";
		}
		else // insertion failed
		{
			$ins =  "La requête d'insertion a rencontré des erreurs";
		}
	}
	
	// DELETION
	if(isset($delete) && isset($categorie_id_del) && !empty($categorie_id_del))
	{
		$categorie = new Categorie($categorie_id_del, "", "", "");
		$query = $categorie->delCategorie();
		if($query == 1) // deletion done
		{
			$del =  "La catégorie '" . $categorie_id_del . "' a été supprimé !";
		}
		else // deletion failed
		{
			$del = "La requête de suppression a rencontré des erreurs";
		}
	}

	// SEARCH
	if(isset($search) && isset($search_text) && !empty($search_text)) //button "Rechercher"
	{
		$categorie = new Categorie($search_text, $search_text, $search_text, $search_text);
		$search_categories=array();
		$search_categories['search_categorie']= $categorie->searchCategorie();
	}
	

	// UPDATE
	if (isset($update) && isset($categorie_id_upd) && !empty($categorie_id_upd) && isset($age_debut_upd) && !empty($age_debut_upd) && isset($age_fin_upd) && !empty($age_fin_upd))
	{
		if (empty($nom_categorie_upd))
		{
			$categorie_tmp = new Categorie($categorie_id_upd, "", "", "");
			$nom_categorie_upd = $categorie_tmp->selectNomCategorie();
			$categorie = new Categorie($categorie_id_upd,$nom_categorie_upd['nom_categorie'],$age_debut_upd, $age_fin_upd);
			$query = $categorie->updateCategorie();
		}
		else
		{
			$categorie = new Categorie($categorie_id_upd, $nom_categorie_upd, $age_debut_upd, $age_fin_upd);
			$query = $categorie->updateCategorie();
		}	
		if($query == 1) //update done
		{
			$upd =  "La categorie '" . $categorie_id_upd . "'' a été mise à jour !";
		}
		else // update failed
		{
			$upd = "La requête de mise à jour a rencontré des erreurs";
		}
	}

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

    include_once('../../views/categorie/index.php');