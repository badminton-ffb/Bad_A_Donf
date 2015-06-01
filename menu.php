<!-- Navigation -->
<?php
include('/connexionBD.php');
//include("/models/user/modelU.php");
include('/connexionUser.php');

//USER 
if (isset($_COOKIE['id_usr'])){
    $user = new User($_COOKIE['id_usr'], "", "", "");
    $users = array();
    $users['User'] = $user->getToken();
}
?>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Accueil</a>
                <!--<a class="navbar-brand" href="\badminton_ffb\">Accueil</a>-->
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/controllers/joueur/">Joueurs</a>
                        <!--<a href="\badminton_ffb\controllers\joueur\">Joueurs</a>-->
                    </li>
                    <li>
                        <a href="/controllers/club/">Clubs</a>
                        <!--<a href="\badminton_ffb\controllers\club\">Clubs</a>-->
                    </li>
                    <li>
                        <a href="/controllers/categorie/">Categories</a>
                        <!--<a href="\badminton_ffb\controllers\categorie\">Categories</a>-->
                    </li>
                    <li>
                        <a></a>
                    </li>
                    <li>
                        <a></a>
                    </li>
                    <li>
                        <a></a>
                    </li>
                    <?php
                    if(isset($_COOKIE["token"]) && ($_COOKIE["token"] = $users['User'][0][0]))
                    {
                        ?>
                        <li>
                            <?php
                            $login = $user->getLogin();
                            ?>
                            <a><u>
                            <?php
                            echo $login[0][0];
                            ?>
                            </u></a>
                        </li>
                        <li>
                            <div class = "deco">
                                <form action="/controllers/user/" method="POST" class="form-inline">
                                    <div class="form-group">
                                        <button type="submit" class ="btn btn-link" name="deconnexion" id="deconnexion" >Déconnexion</button>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <?php
                    }
                    else
                    {
                    ?>
                    <li>
                        <div class = "left">
                            <form action="/controllers/user/" method="POST" class="form-inline">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="login" id="login"/>                                  
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="pswd" id="pswd"/>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-link" name="connexion" id="connexion" >Connexion</button>
                                </div>
                            </form>
                        </div>
                    </li>
                    <?php
                    }
                    ?>


                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>