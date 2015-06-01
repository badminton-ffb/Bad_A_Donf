<?php
include('../../connexionBD.php');
include("../../models/user/modelU.php");

$club_id = $_GET['club_id'];
$nom_club = $_GET['nom_club'];
$nom_ville = $_GET['nom_ville'];
$nb_joueurs = $_GET['nb_joueurs'];

include_once('../../views/infosClubs/index.php');