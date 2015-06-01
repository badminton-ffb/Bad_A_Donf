<?php include("../../header.php"); ?>

<body>
	<?php include("../../menu.php"); 
	
	?>
    <!-- Page Content -->
    <div class="container">

        <!-- Tete de page -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $nom_club; ?></h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Actualités -->
        <div class="row">

            <div class="col-md-5">
                <div class="actu">
                    <h3>Informations</h3>
                    <ul>
                        <li>Numéro de club : <?php echo $club_id; ?></li>
                        <li>Nom de club : <?php echo $nom_club; ?></li>
                        <li>Ville : <?php echo $nom_ville; ?></li>
                        <li>Nombres de joueurs : <?php echo $nb_joueurs ;?></li>
                    </ul>
                    <?php 
                    if(isset($_COOKIE["token"]) && ($_COOKIE["token"] == $users['User'][0][0]))
                    {?>
                    <form method=POST action="../../controllers/club/">
                       <input type="hidden" name="club_id_del" value="<?php echo "". $club_id ."" ?>"></input>
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
