<?php 

    $token =  uniqid() . str_shuffle("abcdefghijklmnopqrstuvwxz0123456789") . time(); // random token
    
    include('../../connexionBD.php');
    include("../../models/user/modelU.php");

    // Recupere les donnees
    isset($_POST['login']) ? $login = htmlspecialchars($_POST['login']) : "";
    isset($_POST['pswd']) ? $pswd = md5(htmlspecialchars($_POST['pswd'])) : "";
    isset($_POST['connexion']) ? $connexion = htmlspecialchars($_POST['connexion']) : "";
    isset($_POST['deconnexion']) ? $deconnexion = htmlspecialchars($_POST['deconnexion']) : "";

    if(isset($connexion) && isset($login) && !empty($login) && isset($pswd) && !empty($pswd))
    {
        
        $user = new User("", $login, $pswd, "");
        $query = $user->existUser();
        
		
        if ($query)
        {
            $id_usr = $query[0][0];
            $new_token = $user->newToken($token);
            if($new_token)
            {
                setcookie("token", $token, 0, '/');
                setcookie("id_usr", $id_usr, 0, '/');
            }
        }
    }
    else
    {
        var_dump($login);
    }

    if(isset($deconnexion))
    {
        setcookie("token", "", time()-3600, '/');
        setcookie("id_usr", "", time()-3600, '/');
    }

    require("../../views/index.php");