<?php 
session_start();
include 'headerAdmin.php';
include 'connectdb.php';


    $bdd=connexion();
     if (isset($_POST['modifier'])) {
        $idEmp = $_GET['idEmp'];
        $nom =strtoupper( $_POST['nom']);
        $prenom =ucwords( $_POST['prenom']);
        $nbrEnfant = $_POST['nbrEnfant'];
        $sitMatr = $_POST['sitMatr'];
        $poste =ucfirst( $_POST['poste']);
        $telephone = $_POST['telephone'];
        $adresse =ucwords($_POST['adresse']);
        $sexe = $_POST['sexe'];

        $query = "UPDATE  employe SET nom = '$nom', prenom = '$prenom',poste = '$poste', nbrEnfant = '$nbrEnfant', sitMatr = '$sitMatr', adresse = '$adresse',  telephone = '$telephone', sexe ='$sexe' WHERE idEmp = '$idEmp' " ;
        $bdd->exec($query);

        $etat =  '<div class="alert alert-success" role="alert">
            Modification effectuée avec succès ! <a href="listeEmploye.php" class="alert-link">Voir la liste des Employés</a>.
            </div>';

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

    <title>Employé - NetSystème</title>
</head>
<body>
    
<?php
            if (isset($_GET['idEmp'])) {
                $idEmp = $_GET['idEmp'];
                
            $reponse = $bdd->query("SELECT * FROM employe where idEmp = '$idEmp' ");
                       
                       while($utilisateur = $reponse->fetch())
                        { ?>
    <div class="main--content">
        <div class="overview">
        <?php if(!empty($etat)){echo $etat;}?>

            <h1>Modification</h1>
        <form action="" method="post">
      <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label for="nom">Nom</label>
              <input id="nom" class="form-control" type="text" name="nom" value="<?= $utilisateur['nom'] ?>">
            </div>
            <div class="col-md-6">
              <label for="prenom">Prénom</label>
              <input id="prenom" class="form-control" type="text" name="prenom" value="<?= $utilisateur['prenom'] ?>">
            </div>
          </div>
      </div>
      <div class="form-group">
          <div class="row">
            <div class="col-12">
              <label >Poste</label>
              <input  class="form-control" type="text" name="poste" value="<?= $utilisateur['poste'] ?>">
            </div>
          </div>
      </div>
      <div class="form-group">
          <div class="row">
            
            <div class="col-md-6">
              <label for="telephone">Téléphone</label>
              <input id="telephone" class="form-control" type="number" name="telephone" value="<?= $utilisateur['telephone'] ?>">
            </div>
          </div>
      </div>

      

      <div class="form-group">
          <div class="row">
            <div class="col-12">
              <label for="adresse">Adresse</label>
              <input id="adresse" class="form-control" type="text" name="adresse" value="<?= $utilisateur['adresse'] ?>">
            </div>
          </div>
      </div>
      <div class="form-group">
      <div class="row">
           
            <div class="col-md-6">
              <label for="sitMatr">Situation matrimoniale</label>
                <select class="form-control" name="sitMatr" value="<?= $utilisateur['sitMatr'] ?>" id="">
                <option value="<?=$utilisateur['sitMatr']?>"><?=$utilisateur['sitMatr']?></option>
                    <option value="Célibataire">Célibataire</option>
                    <option value="Marié">Marié</option>
                    <option value="Veuf">Veuf</option>
                    <option value="Divorcé">Divorcé</option>
                </select>
            </div>
            <div class="col-md-6">
              <label for="sitMatr">Sexe</label>
                <select class="form-control" name="sexe" id="">
                <option value="<?=$utilisateur['sexe']?>"><?=$utilisateur['sexe']?></option>
                    <option value="Masculin">Masculin</option>
                    <option value="Feminin">Feminin</option>
                </select>
            </div>
          </div>

      <div class="form-group">
          <div class="row">
            <div class="col-12">
              <label for="nbrEnfant">Nombre d'enfant</label>
              <input id="nbrEnfant" class="form-control" type="number" name="nbrEnfant" value="<?= $utilisateur['nbrEnfant'] ?>">
            </div>
          </div>
      </div>

      

      
      <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
    </form>

    <br><br><br> <?php if(!empty($etat)){echo $etat;}?> 


        </div>
    </div>
    <?php }}?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    
</body>
</html>