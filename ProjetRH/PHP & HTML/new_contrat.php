<?php 
include 'connectdb.php';
include 'calcul.php';

$bdd = connexion();


if ( isset($_POST["type"], $_POST["date_debut"], $_POST["date_fin"], $_POST["tauxH"], $_POST["poste"],$_POST["nbrPart"] ) ) {

    $type =(($_POST["type"])); 
    $date_debut =(($_POST["date_debut"])); 
    $date_fin =(($_POST["date_fin"])); 
    $tauxH =htmlspecialchars($_POST["tauxH"]);
    $nbrHeure = 173.33;
    $nbrPart = ($_POST["nbrPart"]);
    $emp_contrat = filter_var($_REQUEST["idEmp"], FILTER_VALIDATE_INT);

    $salaire_base = salaire_base($tauxH);

    if (!empty($_POST["type"]) &&
     !empty($_POST["date_debut"]) && 
     !empty($_POST["tauxH"]) &&
     !empty($_POST["nbrPart"]) ) {
        
        $requete = $bdd->prepare('INSERT INTO contrat (typeContrat, date_debut, date_fin_CDD, tauxH, emp_contrat, salaire_base, nbrHeure, nbrPart) values (?,?,?,?,?,?,?,?)');
        
        $status = $requete->execute([$type, $date_debut, $date_fin, $tauxH, $emp_contrat, $salaire_base, $nbrHeure, $nbrPart]);

				if ($status)
				{
          header('location:success.php');
				}
				else
				{
          echo'<div class="alert alert-danger fade show" role="alert">
          Echec de l\'ajout.
        </div>';					print_r($bdd->errorInfo());
				}
			
			
	}
    
    
}else {
  echo '<div class="alert alert-danger" role="alert">
  Des champs du formulaire sont vides !
</div>';
}


?>