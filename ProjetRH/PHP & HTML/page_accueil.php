<?php

session_start();
include 'connectdb.php';
//Si une session est deja ouverte
if(isset($_SESSION['user'])):
    header('location:deconnexion.php');
    exit();

else:

    //on se connecte a la base de données
    $bdd = connexion();

    //lorsqu'on clique sur submit
    if(   isset(   $_POST['connexion'])   ){

        //On recupère dans une variable l'identifiant et le mdp, et on securise (eviter l'injection SQL + chiffrage du mdp)
        $email = htmlspecialchars($_POST['email']);
        $password    = md5($_POST['password']);
        $role = $_POST['role'];
        $empid = "";

       
        

        //On verifie que les champs soient rempli
        if(  !empty($_POST['email'])   &&   !empty($_POST['password'])  ){

            // On compare l'identifiant et le mdp saisi avec ceux de la base de données
            $reqidentification = $bdd->query("SELECT * FROM compte WHERE email = '$email' AND motdepasse = '$password' AND roles = '$role'");
            $tableau = $reqidentification->fetch(PDO::FETCH_ASSOC);

            if ($role == 'Administration') {
                if(is_array($tableau)){
                    $_SESSION['user']=$tableau['email'];
                    echo "redirection vers votre espace membre";
                    header('location:admin.php');
                    
                }
    
                else{
                    $erreur = "identifiant incorrect";
                    
                }
            }

            if ($role == 'Technicien') {
                if(is_array($tableau)){
                    $_SESSION['user']=$tableau['email'];
                    echo "redirection vers votre espace membre";
                    header("location:techprofil.php");
                }
    
                else{
                    echo "Identifiant incorrect et/ou rôle ne correspondant pas";
                    
                }
            }
            

        }

       
    }
endif;
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-------------alll cdn links and css -->
    <link rel="stylesheet" href="page.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Se connecter</title>
</head>

<body>

    <header id="header">
        <div class="logo"><a href="https://netsys-info.com/" target="_blank">
            <img src="Photo Netsysteme.png" class="img">
        </a> 
    </div>
        <div class="hamburger" id="toggle">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar" id="navbar">
            <ul>
                <li>
                    <a href="acceuil.html">Accueil</a>
                </li>
                <li>
                    <a href="propos.html">A propos</a>
                </li>
                <li>
                    <a href="contact.html">Contact</a>
                </li>
                <div class="login" id="login">
                    <li>
                        <a href="page_accueil.php" class="navlogin">Connexion</a>
                    </li>
                </div>
            </ul>
        </nav>
    </header>


    <div class="container" >
      
        <div class="login-left">
            <div class="login-header">
                <h1>Bienvenue</h1>
                <p>Entrez vos informations pour vous connecter.</p>
            </div>
            <form method="post" class="login-form" autocomplete="off">
                <div class="login-content">
                <div class="form-item">
                <select name="role" id="role" >
                        <option value="Administration">Administration</option>
                        <option value="Technicien">Technicien</option>
                    </select>
                </div>
                    <div class="form-item">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="" placeholder="E-mail">
                    </div>
                    <div class="form-item">
                        <label for="password">Mot de passe</span></label>
                        <label for="text"></label>
                        <input type="password" name="password" id="" placeholder="Mot de passe" required class="pass-key">
                    </div>
                    <div class="form-item">
                        <div class="checkbox">
                            <input type="checkbox" name="" id="rememberMeCheckbox" checked>
                            <label for="rememberMeCheckbox" class="checkboxlabel">Se souvenir de moi</label>
                        </div>
                    </div>
                    <button type="submit" name="connexion">Se Connecter</button>
                </div>
                
            </form>

            <?php //if(!empty($erreur)){echo"<p class='erreur'>".$erreur."</p>";}?>

        </div>
    </div>
</body>