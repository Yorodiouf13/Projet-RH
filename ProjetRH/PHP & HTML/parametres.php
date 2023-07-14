<?php
include 'headerTech.php';
include 'connectdb.php';
include 'identification.php';
connecter();

$bdd = connexion();


if (isset($_SESSION['user'])) {   
    $email=$_SESSION['user'];



    $sql = "SELECT employe.*, compte.* , contrat.*  FROM employe RIGHT JOIN compte ON employe.idEmp=  compte.compteEmp LEFT JOIN contrat ON employe.idEmp =  contrat.emp_contrat  WHERE compte.email = '$email' ";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $idEmp = $user['idEmp'];

if (isset($_POST['nom'], $_POST['prenom'], $_POST['telephone'], $_POST['adresse'], $_POST['sexe'])) {

    
    $nom = htmlspecialchars( strtoupper($_POST['nom']) );
    $prenom = htmlspecialchars(ucfirst($_POST['prenom']));
    $telephone = htmlspecialchars($_POST['telephone']);
    $adresse = htmlspecialchars(ucwords($_POST['adresse']));
    $sexe = $_POST['sexe'];
    
    $query = "UPDATE  employe SET nom = '$nom', prenom = '$prenom', telephone = '$telephone',adresse = '$adresse',  sexe ='$sexe' WHERE idEmp = '$idEmp' " ;
    $bdd->exec($query);
   
   
    header('location:techprofil.php');
}

if (isset($_POST['oldemail'], $_POST['email'], $_POST['oldpass'], $_POST['oldpass2'], $_POST['motdepasse'], $_POST['motdepasse2'])) {

    $oldmail = $_POST['oldemail'];
    $email =$_POST['email'];
    $oldpass =md5($_POST['oldpass']);
    $oldpass2 = md5($_POST['oldpass2']);
    $motdepasse = md5($_POST['motdepasse']);
    $motdepasse2 = md5($_POST['motdepasse2']);

    if(md5($_POST['oldpass']) == md5($_POST['oldpass2']) && md5($_POST['motdepasse']) == md5($_POST['motdepasse2']) ){
        if($oldpass == $user['motdepasse']){

            if(strlen($_POST['motdepasse']) > 6){
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $query = "UPDATE  compte SET email = '$email', motdepasse = '$motdepasse' WHERE compteEmp = '$idEmp' " ;
                    $bdd->exec($query);
                   
                   
                    header('location:techprofil.php');
                    $etat = '<div class="alert alert-success" role="alert">
                    Ajout effectué avec succès !
                    </div>';
          

                }else $error ='<div class="alert alert-warning fade show" role="alert"> l\'email n\'est pas valide
                </div> ';

                
            }else $error = '<div class="alert alert-warning fade show" role="alert">Le mot de passe n\'est pas valide
            </div> ';


        }else $error ='<div class="alert alert-warning fade show" role="alert"> L\'ancien mot de passe n\'est pas correct.
        </div> ';

    }else $error ='<div class="alert alert-danger fade show" role="alert"> Les mots de passe ne correspondent pas
    </div> ';

    
   
}

}
    




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <title>Paramètres - NetSystème</title>
</head>
<body>
    

    <div class="main--content">
        <div class="overview">

        <?php if(!empty($error)){echo $error;}?>

        <h1 class=" row justify-content-md-center">Paramètres</h1><br>

        <h4>Paramètres de base</h4>
        <form action="" method="post">

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                    <label for="nom">Nom</label>
                    <input id="nom" class="form-control" type="text" name="nom" value="<?=$user['nom']?>" >
                    </div>
                    <div class="col-md-6">
                    <label for="prenom">Prénom</label>
                    <input id="prenom" class="form-control" type="text" name="prenom" value="<?=$user['prenom']?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                    <label for="nbrEnfant">Date de Naissance</label>
                    <input  class="form-control" type="date" name="ddn" value="<?=$user['ddn']?>" >
                    </div>
                    <div class="col-md-6">
                    <label for="ddn">Sexe</label>
                    <select name="sexe" class="form-control" id="">
                        <option value="<?=$user['sexe']?>"><?=$user['sexe']?></option>
                        <option value="Masculin">Masculin</option>
                        <option value="Féminin">Féminin</option>
                    </select>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                    <label for="nbrEnfant">Téléphone</label>
                    <input  class="form-control" type="text" name="telephone" value="<?=$user['telephone']?>">
                    </div>
                    <div class="col-md-6">
                    <label for="ddn">Adresse</label>
                    <input id="mail" class="form-control" type="text" name="adresse" value="<?=$user['adresse']?>">
                    </div>
                </div>
            </div>
      
            <button type="submit" name="modifier" class="btn btn-primary">
               Modifier
            </button>
        </form><br><br>
        

    



        <h4 >Paramètres du compte</h4> <br>       
        <form action="" method="post">
            <div class="form-group">
                <div class="row">
                    
                    <div class="col-md-6">
                    <label >Ancien email</label>
                    <input id="nom" class="form-control" type="email" name="oldemail" value="<?=$user['email']?>">
                    </div>
                    <div class="col-md-6">
                    <label >Nouvel email</label>
                    <input id="prenom" class="form-control" type="email" name="email" value="<?=$user['email']?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                    <label >Ancien mot de passe</label>
                    <input  class="form-control" type="password" name="oldpass">
                    </div>
                    <div class="col-md-6">
                    <label >Confirmation du mot de passe</label>
                    <input id="mail" class="form-control" type="password" name="oldpass2">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                    <label >Nouveau mot de passe</label>
                    <input  class="form-control" type="password" name="motdepasse">
                    </div>
                    <div class="col-md-6">
                    <label >Confirmation du mot de passe</label>
                    <input id="mail" class="form-control" type="password" name="motdepasse2">
                    </div>
                </div>
            </div>
            
      
            <button type="submit" name="misajour" class="btn btn-primary">Modifer</button>
        </form>

<br><br>
        </div>
    </div>
           
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    
</body>
</html>