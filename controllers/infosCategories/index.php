<?php
include('../../connexionBD.php');
include("../../models/user/modelU.php");

$categorie_id = $_GET['categorie_id'];
$nom_categorie = $_GET['nom_categorie'];
$age_debut = $_GET['age_debut'];
$age_fin = $_GET['age_fin'];

include_once('../../views/infosCategories/index.php');