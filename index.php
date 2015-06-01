<?php include("header.php"); ?>

<body>
    <?php
    include('connexionBD.php');
    include("models/user/modelU.php");
    include("menu.php"); 
	
	?>
    <!-- Page Content -->
    <div class="container">

        <!-- Tete de page -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bad'A'Donf</h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Actualités -->
        <div class="row">

            <div class="col-md-7">
                <div class="img_principale">
                    <img class="img-responsive" src="/images/lin_dan_accueil.jpg" alt="Photo de Lin Dan">
                </div>
            </div>

            <div class="col-md-4">
                <div class="actu">
                    <h3>Actualités</h3>
                    <p>Deux médailles d'Or et une flopée de médailles de Bronze et d'argent pour les Bleus
                     à Beijing. David Toupé s'impose en double homme avec son
                     comparse Chan Ho Yuen, et Lucas Mazur s'impose en simple en battant en deux manches le numéro 2 mondial.</p>
                     <p> Lucas Mazur en grande forme ! Le joueur de Tours est en finale de l'Open de Chine - l'un des plus 
                        importants du circuit. Lucas a battu Li Ping le Chinois et sera opposé demain au Numero 1 mondial Malaisien Bakri Omar.
                         Il jouera aussi en double avec Geoffrey Bizery pour une place en finale demain.
                        David Toupé est lui en demi finale dans les trois tableaux, Matthieu Gilles Thomas dans deux demi. Bravo aux Bleus !</p>
                </div>
            </div>

        </div>
        <!-- /.row -->

        <!-- Images bad -->
        <div class="row">

            <div class="col-lg-12">
                <h3 class="page-header"><small>Bad' en image</small></h3>
            </div>

            <div class="col-sm-3 col-xs-6">
                <img class="img-responsive portfolio-item" src="/images/brice_leverdez.jpg" alt="Brice Leverdez">
            </div>

            <div class="col-sm-3 col-xs-6">
                <img class="img-responsive portfolio-item" src="/images/lee_chong_wei_1.jpg" alt="Lee Chong Wei">
            </div>

            <div class="col-sm-3 col-xs-6">
                <img class="img-responsive portfolio-item" src="/images/lin_dan_1.jpg" alt="Lin Dan">
            </div>

            <div class="col-sm-3 col-xs-6">
                <img class="img-responsive portfolio-item" src="/images/lucas_corvée.jpeg" alt="Lucas Corvée">
            </div>

        </div>
        <!-- /.row -->
 
    <?php include("footer.php"); ?>

    </div>
    <!-- /.container -->

</body>

</html>
