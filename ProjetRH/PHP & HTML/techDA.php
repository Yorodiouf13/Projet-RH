<?php
include 'headerTech.php';
include 'connectdb.php';
include 'identification.php';
connecter();
// include 'function.php';

$bdd = connexion();
$email=$_SESSION['user'];


if ( isset($_POST["motif"], $_POST["date_depart"], $_POST["date_retour"]) ) {

    $motifAbsence =htmlspecialchars(ucfirst($_POST["motif"])); 
    $date_depart =htmlspecialchars(($_POST["date_depart"])); 
    $date_retour =htmlspecialchars(($_POST["date_retour"]));  
    $emp_absence = filter_var(chercher(), FILTER_VALIDATE_INT);


    $statut = 'En attente';

    if (!empty($_POST["motif"]) &&
     !empty($_POST["date_depart"]) && 
     !empty($_POST["date_retour"])) {
        
        $requete = $bdd->prepare('INSERT INTO absence (motifAbsence, date_depart, date_retour, emp_absence, date_demande, statut) values (?,?,?,?,DATE_FORMAT(NOW(), "%d/%c/%y à %H:%i:%s"),?)');
        
        $status = $requete->execute([$motifAbsence, $date_depart, $date_retour, $emp_absence, $statut]);

				if ($status)
				{
            $etat = '<div class="alert alert-success fade show" role="alert">
            Ajout effectué avec succès !
            </div>';
				}
				else
				{
          $etat = '<div class="alert alert-danger fade show" role="alert">
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
       

            <h1 class=" row justify-content-md-center" >Demande Absence </h1><br>
        <form action="" method="post">

        <div class="form-group">
          <div class="row justify-content-md-center">
            <div class="col-6">
              <label for="motifAbsence">Motif de l'absence</label>
              <input id="adresse" class="form-control" type="text" name="motif">
            </div>
          </div>
      </div>
 
      <div class="form-group">
          <div class="row justify-content-md-center">
            <div class="col-md-6">
              <label for="date_depart">Date de Depart</label>
              <input id="date_debut" class="form-control" type="date" name="date_depart" >
            </div>
           
          </div> 
      </div>
      <div class="form-group">
          <div class="row justify-content-md-center">
            <div class="col-md-6">
              <label for="date_retour">Date de Retour</label>
              <input id="mail" class="form-control" type="date" name="date_retour">
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
        $result = ("SELECT absence.* FROM absence JOIN compte ON absence.emp_absence =compte.compteEmp  WHERE compte.email = '$email' ");
        $prepare = $bdd->prepare($result);
        $prepare->execute();

                while ($resultat = $prepare->fetch(PDO::FETCH_ASSOC))
                {?>

                <div class="card mb-4">
                  <div class="card-body">
                    <p><?= $resultat['motifAbsence'] ?></p>

                  <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center">
               
                      <p class="small mb-0 ms-2"><?= $resultat['statut'] ?></p>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                      <p class="small text-muted mb-0"><?= $resultat['date_demande'] ?></p>
                      <i class="far fa-thumbs-up mx-2 fa-xs text-black" style="margin-top: -0.16rem;"></i>
                      <p class="small text-muted mb-0"><a href="suppressionAbs.php?idEmp=<?= $resultat['emp_absence']?>&idAbsence=<?=$resultat['idAbsence']?>" class="btn btn-danger">Supprimer</a></p>
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