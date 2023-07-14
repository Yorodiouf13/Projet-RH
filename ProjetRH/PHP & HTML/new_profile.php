<?php
session_start();
include 'headerAdmin.php';
include 'connectdb.php';
// include 'function.php';

$bdd = connexion();

if ( isset($_POST["nom"], $_POST["prenom"], $_POST["adresse"], $_POST["tel"], $_POST["sexe"], $_POST["ddn"], $_POST["ldn"], $_POST["sitmat"], $_POST["nbrenf"], $_POST["categorie"] )    ) {

    $nom =htmlspecialchars(strtoupper($_POST["nom"])); 
    $prenom =htmlspecialchars(ucfirst($_POST["prenom"])); 
    $adresse =htmlspecialchars(ucwords($_POST["adresse"])); 
    $tel =($_POST["tel"]); 
    $sexe =($_POST["sexe"]); 
    $service =($_POST["service"]); 
    $ddn =htmlspecialchars($_POST["ddn"]); 
    $ldn =htmlspecialchars(ucfirst($_POST["ldn"])); 
    $sitmat =($_POST["sitmat"]); 
    $nbrenf =($_POST["nbrenf"]); 
    $categorie =($_POST["categorie"]); 
    $poste = htmlspecialchars(ucfirst($_POST["poste"]));


    if (!empty($_POST["nom"]) &&
     !empty($_POST["prenom"]) && 
     !empty($_POST["tel"]) && 
     !empty($_POST["adresse"]) && 
     !empty($_POST["poste"]) && 
     !empty($_POST["categorie"]) && 
     !empty($_POST["ldn"]) && 
     !empty($_POST["ddn"]) ) {
        
        $requete = $bdd->prepare('INSERT INTO employe (nom, prenom, sexe, ddn,ldn, sitMatr, nbrEnfant,adresse, telephone, poste, categorie, service ) values (?,?,?,?,?,?,?,?,?,?,?,?)');
        
        $status = $requete->execute([$nom, $prenom, $sexe, $ddn, $ldn, $sitmat, $nbrenf,  $adresse, $tel, $poste, $categorie, $service ]);
				if ($status)
				{
          $etat = '<div class="alert alert-success fade show" role="alert">
          Ajout effectué avec succès ! <a href="listeEmploye.php" class="alert-link">Voir la liste des Employés</a>.
          </div>';

				}
				else
				{
          $etat = '<div class="alert alert-warning fade show" role="alert">
          Echec de l\'ajout.
        </div>';					print_r($bdd->errorInfo());
				}
			
			
	}else
  {
    $etat = '<div class="alert alert-danger fade show" role="alert">
    Vous devez remplir tous les champs du formulaires
  </div>';					print_r($bdd->errorInfo());
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

    <title>Employé - NetSystème</title>
</head>
<body>
    

    <div class="main--content">
        <div class="overview">
        <?php if(!empty($etat)){echo $etat;}?>

            <h1>Ajout d'un employé </h1>
        <form action="" method="post">
      <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label for="nom">Nom</label>
              <input id="nom" class="form-control" type="text" name="nom" >
            </div>
            <div class="col-md-6">
              <label for="prenom">Prénom</label>
              <input id="prenom" class="form-control" type="text" name="prenom">
            </div>
          </div>
      </div>
      <div class="form-group">
          <div class="row">
            <div class="col-6">
              <label for="nbrEnfant">Service</label>
              <select class="form-control" name="service">
                <option value=""></option>
                <option value="Commercial">Commercial</option>
                <option value="Informatique">Informatique</option>
              </select>
            </div>
          
            <div class="col-6">
              <label for="nbrEnfant">Poste occupé</label>
              <input  class="form-control" type="text" name="poste">
            </div>
          </div>
      </div>

      <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label for="ddn">Date de naissance</label>
              <input id="mail" class="form-control" type="date" name="ddn">
            </div>
            <div class="col-md-6">
              <label>Lieu de Naissance</label>
              <input class="form-control" type="text" name="ldn">
            </div>
          </div>
      </div>

      <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label for="ddn">Catégorie Professionnelle</label>
              <input  class="form-control" type="text" name="categorie">
            </div>
            <div class="col-md-6">
              <label for="telephone">Téléphone</label>
              <input id="telephone" class="form-control" type="number" name="tel">
            </div>
          </div>
      </div>
      <div class="form-group">
          <div class="row">
            <div class="col-12">
              <label for="adresse">Adresse</label>
              <input id="adresse" class="form-control" type="text" name="adresse">
            </div>
          </div>
      </div>
      <div class="form-group">
      <div class="row">
            <div class="col-md-6">
              <label for="sitMatr">Sexe</label>
                <select class="form-control" name="sexe" id="">
                <option value=""></option>
                    <option value="Masculin">Masculin</option>
                    <option value="Feminin">Feminin</option>
                </select>
            </div>
            <div class="col-md-6">
              <label for="sitMatr">Situation matrimoniale</label>
                <select class="form-control" name="sitmat" id="">
                    <option value=""></option>
                    <option value="Célibataire">Célibataire</option>
                    <option value="Marié">Marié</option>
                    <option value="Veuf">Veuf</option>
                    <option value="Divorcé">Divorcé</option>
                </select>
            </div>
          </div>

      <div class="form-group">
          <div class="row">
            <div class="col-12">
              <label for="nbrEnfant">Nombre d'enfant</label>
              <input id="nbrEnfant" class="form-control" type="number" name="nbrenf">
            </div>
          </div>
      </div>

     
         </div>

      
      <button type="submit" name="ajout" class="btn btn-primary">Ajouter</button>
    </form>



        </div>
    </div>
           
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    
</body>
</html>