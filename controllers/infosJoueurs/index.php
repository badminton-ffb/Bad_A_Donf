<?php
include('../../connexionBD.php');
include("../../models/user/modelU.php");

$licence = $_GET['licence'];
$nom_joueur = $_GET['nom_joueur'];
$prenom_joueur = $_GET['prenom_joueur'];
$date_naissance = $_GET['date_naissance'];
$date_premiere_inscription= $_GET['date_premiere_inscription'];
$nom_club = $_GET['nom_club'];
$nom_categorie= $_GET['nom_categorie'];
$img_src = $_GET['img_src'];

include_once('../../views/infosJoueurs/index.php');