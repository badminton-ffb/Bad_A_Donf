<?php include("../../header.php"); ?>

<body>
	<?php include("../../menu.php"); 
	
	?>
    <!-- Page Content -->
    <div class="container">

        <!-- Tete de page -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $nom_categorie; ?></h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Actualités -->
        <div class="row">

            <div class="col-md-5">
                <div class="actu">
                    <h3>Informations</h3>
                    <ul>
                        <li>Numéro de catégorie : <?php echo $categorie_id; ?></li>
                        <li>Nom de catégorie : <?php echo $nom_categorie; ?></li>
                        <li>Age de début : <?php echo $age_debut; ?></li>
                        <li>Age de fin : <?php echo $age_fin ;?></li>
                    </ul>
                    <?php 
                    if(isset($_COOKIE["token"]) && ($_COOKIE["token"] == $users['User'][0][0]))
                    {?>
                    <form method=POST action="../../controllers/categorie/">
                       <input type="hidden" name="categorie_id_del" value="<?php echo "". $categorie_id ."" ?>"></input>
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
