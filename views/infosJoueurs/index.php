<?php include("../../header.php"); ?>

<body>
	<?php include("../../menu.php"); 
	
	?>
    <!-- Page Content -->
    <div class="container">

        <!-- Tete de page -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $nom_joueur." ".$prenom_joueur; ?> </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Actualités -->
        <div class="row">

            <div class="col-md-5">
                <div class="img_infos">
                    <?php $img_src = "http://badminton-ffb.olympe.in/img/Joueurs/" . $img_src;?>
                    <img class="img-responsive" src=<?php echo $img_src; ?> alt="Photo du joueur">
                </div>
            </div>

            <div class="col-md-5">
                <div class="actu">
                    <h3>Informations</h3>
                    <ul>
                        <li>Licence : <?php echo $licence; ?></li>
                        <li>Nom : <?php echo $nom_joueur; ?></li>
                        <li>Prenom : <?php echo $prenom_joueur; ?></li>
                        <li>Date de naissance : <?php echo $date_naissance ;?></li>
                        <li>Date de première inscription : <?php echo $date_premiere_inscription; ?></li>
                        <li>Club : <?php echo $nom_club; ?></li>
                        <li>Catégorie : <?php echo $nom_categorie; ?></li>
                    </ul>
                    <?php 
                    if(isset($_COOKIE["token"]) && ($_COOKIE["token"] == $users['User'][0][0]))
                    {?>
                    <form method=POST action="../../controllers/joueur/">
                       <input type="hidden" name="licence_del" value="<?php echo "". $licence ."" ?>"></input>
                       <div class="form-group">
                            <button type="submit" class="btn btn-danger" name="delete" id="delete">Supprimer</button>
                        </div>
                    </form>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
        <!-- /.row -->
 
    <?php include("../../footer.php"); ?>

    </div>
    <!-- /.container -->

</body>

</html>
