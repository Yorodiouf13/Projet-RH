<?php
include 'headerTech.php';
include 'connectdb.php';
include 'identification.php';
connecter();

$bdd = connexion();
$email=$_SESSION['user'];


if ( isset($_POST["date_debut"], $_POST["date_fin"], $_POST["type_conges"]) ) {

    $date_debut =htmlspecialchars(($_POST["date_debut"])); 
    $date_fin =htmlspecialchars(($_POST["date_fin"])); 
    $type_conges =(($_POST["type_conges"]));
    $emp_conge = filter_var(chercher(), FILTER_VALIDATE_INT);
    $statut = 'En attente';


    if (!empty($_POST["date_debut"]) && 
     !empty($_POST["date_fin"]) &&
     !empty($_POST["type_conges"])) {

     
        $requete = $bdd->prepare('INSERT INTO conges (date_demande, date_debut, date_fin, type_conges, emp_conge, statut) VALUES (DATE_FORMAT(NOW(), "%d/%c/%y à %H:%i:%s"),?,?,?,?,?)');
        
        $status = $requete->execute([$date_debut, $date_fin, $type_conges, $emp_conge, $statut]);

				if ($status)
				{
            $etat =  '<div class="alert alert-success fade show" role="alert">
            Ajout effectué avec succès !
            </div>';
				}
				else
				{
          $etat = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          Echec de l\'ajout.
        </div>';					print_r($bdd->errorInfo());
				}
			
			
	}else {
    $etat =  '<div class="alert alert-warning fade show" role="alert">
    Des champs du formulaire sont vides !
  </div>';
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

    <title>Demande - NetSystème</title>
</head>
<body>
    

    <div class="main--content">
        <div class="overview">
            <h1 class="row justify-content-md-center">Demande de Congés </h1><br>
        <form action="" method="post">
      </div>
      <div class="form-group">
          <div class="row justify-content-md-center">
            <div class="col-md-6">
              <label for="date_debut">Date de debut de congés</label>
              <input id="mail" class="form-control" type="date" name="date_debut">
            </div>
           
          </div>
      </div>
      <div class="form-group">
      <div class="row justify-content-md-center">
            <div class="col-md-6">
              <label for="Date_fin">Date de fin de congés</label>
              <input id="adresse" class="form-control" type="date" name="date_fin">
            </div>
          </div>
      </div>

      <div class="form-group">
      <div class="row justify-content-md-center">
        
            <div class="col-md-6">
              <label for="type_conges">Type de congés</label>
                <select class="form-control" name="type_conges" id="">
                <option value=""></option>
                    <option value="Congé Maternité">Congé Maternité</option>
                    <option value="Congé Annuel">Congé Annuel</option>
                    <option value="Congé Exceptionnel">Congé Exceptionnel</option>
                </select>
            </div>
           
          </div>
</div>

     
 <div class="d-grid gap-2 col-2 mx-auto">
      <button type="submit" name="ajout" class="btn btn-primary btn-lg">Envoyer</button>
      </div>
    </form>

    <br><br><br> <?php if(!empty($etat)){echo $etat;}?> 

    
    <div class="card shadow-0 border" style="background-color: #f0f2f5;">
        <p>Mes demandes</p>
        <?php 
$result2 = ( "SELECT conges.* FROM conges JOIN compte ON conges.emp_conge =compte.compteEmp WHERE compte.email = '$email' ");

$prepare2 = $bdd->prepare($result2);

$prepare2->execute();



while ($resultat2 = $prepare2->fetch(PDO::FETCH_ASSOC))
                {?>

                <div class="card mb-4">
                  <div class="card-body">
                    <p><?= $resultat2['type_conges'] ?></p>

                  <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center">
               
                      <p class="small mb-0 ms-2"><?= $resultat2['statut'] ?></p>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                      <p class="small text-muted mb-0"><?= $resultat2['date_demande'] ?></p>
                      <i class="far fa-thumbs-up mx-2 fa-xs text-black" style="margin-top: -0.16rem;"></i>
                      <p class="small text-muted mb-0"><a href="suppressionCo.php?idEmp=<?= $resultat2['emp_conge']?>&idConge=<?=$resultat2['idConge']?>" class="btn btn-danger">Supprimer</a></p>
                    </div>
                  </div>
                </div>
              </div>
              <?php
    }
    ?>   
    </div>


        </div>
    </div>
           
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    
</body>
</html>