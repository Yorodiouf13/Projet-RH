<?php
session_start();
include 'headerAdmin.php';
include 'connectdb.php';

$bdd = connexion();


if ( isset($_POST["date_saisie"], $_POST["date_paiement"], $_POST["mode_paiement"]) ) {

    $date_saisie =htmlspecialchars(($_POST["date_saisie"])); 
    $date_paiement =htmlspecialchars(($_POST["date_paiement"])); 
    $mode_paiement =(($_POST["mode_paiement"]));
    $bull_emp = $_POST['employe'];
    $bull_sal = filter_var($_REQUEST["emp_sal"], FILTER_VALIDATE_INT);



    if (!empty($_POST["date_saisie"]) && 
     !empty($_POST["date_paiement"]) &&
     !empty($_POST["mode_paiement"])) {

     
        $requete = $bdd->prepare('INSERT INTO bulletin_paie (date_saisie, date_paiement, mode_paiement, bull_emp, bull_sal) VALUES (?,?,?,?,?)');
        
        $status = $requete->execute([$date_saisie, $date_paiement, $mode_paiement, $bull_emp, $bull_sal]);

				if ($status)
				{
            $etat =  '<div class="alert alert-success fade show" role="alert">
            Ajout effectué avec succès !
            </div>';
            header('location:salaire.php?idEmp='.$employe);
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
            <h1 class="row">Nouveau Bulletin de Paie</h1><br>
        <form action="" method="post">
      </div>
      <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label >Employé</label>
              <select class="form-control" name="employe">
                <option value=""></option>
                <?php
                $reponse = $bdd->query('SELECT * FROM employe');

                while ($utilisateur = $reponse->fetch())
                {?>
                <option value="<?=$utilisateur['idEmp']?>"><?=$utilisateur['nom']?> <?=$utilisateur['prenom']?> </option>
                <?php } ?>
              </select>
            </div>

            <div class="col-md-6">
           
                <label>Salaire de Base</label>
                <input class="form-control" type="number" name="salaire_base">

              </div>
           
          </div>
      </div>
      <div class="form-group">
      <div class="row">
      <div class="col-md-6">
                <label>Date de saisie</label>
                <input class="form-control" type="date" name="date_saisie">
              </div>
            <div class="col-md-6">
              <label for="date_paiement">Date de Paiement</label>
              <input  class="form-control" type="date" name="date_paiement">
            </div>
          </div>
      </div>

      <div class="form-group">
      <div class="row">
        
            <div class="col-md-6">
              <label for="mode_paiement">Mode de paiement</label>
                <select class="form-control" name="mode_paiement" id="">
                <option value=""></option>
                    <option value="Banque">Banque</option>
                    <option value="Liquide">Liquide</option>
                </select>
            </div>
           
          </div>
</div>

     
      <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

   

        </div>
    </div>
           
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    
</body>
</html>