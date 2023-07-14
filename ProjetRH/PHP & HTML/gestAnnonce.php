<?php
session_start();
include 'headerAdmin.php';
include 'connectdb.php';
$bdd = connexion();

date_default_timezone_set('UTC');

if (isset( $_POST["titre"], $_POST["contenu"] ) ) {

    $titre =htmlspecialchars($_POST["titre"]); 
    $contenu =htmlspecialchars($_POST["contenu"]); 

    if (!empty($_POST["titre"]) &&
     !empty($_POST["contenu"]) 
     ) {
        
        $requete = $bdd->prepare('INSERT INTO annonce (titre, contenu, dateAnnonce) values (?,?,DATE_FORMAT(NOW(), "%d, %b, %Y, %H:%i:%s")) ');
      
        $status = $requete->execute([$titre, $contenu]);

				if ($status)

       
				{
          
				  $etat =  '<div class="alert alert-success" role="alert">
            Ajout effectué avec succès !
            </div>';
				}
				else
				{
					$etat = "<p>Echec de l'ajout : </p>";
					print_r($bdd->errorInfo());
				}
			
			
	}else
    {
        $etat = '<div class="alert alert-warning" role="alert">
        Vous devez remplir tous les champs du formulaire
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
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="shortcut icon" href="Photo-Netsysteme.ico" type="image/x-icon">

    <title>Annonce - NetSystème</title>
</head>

  
<body>
    <div class="main--content">
        <div class="overview">
        <?php if(!empty($etat)){echo $etat;}?>
        
        <div class="card shadow-0 border" style="background-color: #f0f2f5;">
        <h2  class=" row justify-content-md-center" >Annonce</h2>
            <form  method="post">
           
              <div class="card-body p-4">
                <div class="form-outline mb-4">
                  <label class="form-label" for="addANote">Titre</label>
                  <input type="text"  class="form-control" name="titre">
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="addANote">Annonce</label>
                  <textarea type="text" name="contenu" id="" cols="30" rows="10" class="form-control"></textarea>
                <br><br>
                <button type="submit" class="btn btn-primary " >Poster</button>
                </form>
                </div>

                <?php 
                $reponse = $bdd->query('SELECT * FROM annonce ORDER BY dateAnnonce DESC');
                while ($annonce = $reponse->fetch())
                {?>
                <div class="card mb-4">
                  <div class="card-body">
                    <p><?= $annonce['contenu'] ?></p>

                  <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center">
               
                      <p class="small mb-0 ms-2"><?= $annonce['titre'] ?></p>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                      <p class="small text-muted mb-0"><?= $annonce['dateAnnonce'] ?></p>
                      <i class="far fa-thumbs-up mx-2 fa-xs text-black" style="margin-top: -0.16rem;"></i>
                      <p class="small text-muted mb-0"><a onclick="return confirm('Etes vous sur de vouloir supprimer cette annonce ?')" href="supprimerAnn.php?idAnnonce=<?=$annonce['idAnnonce']?>" class="btn btn-danger">Supprimer</a></p>
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
    </div>
           
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>