<?php 
include 'connectdb.php';
$bdd = connexion();


if ( isset($_POST["email"], $_POST["motdepasse"], $_POST["Role"] )) {

    $motdepasse =(md5($_POST["motdepasse"])); 
    $Role =(($_POST["Role"])); 
    $compteEmp= filter_var($_REQUEST["idEmp"], FILTER_VALIDATE_INT);
    $email = (($_POST["email"])); 

   
    $stmt = $bdd->prepare("SELECT * FROM compte WHERE email=?");
    $stmt->execute([$email]); 
    $user = $stmt->fetch();
    if ($user) {
        header('location:pp.php');
    } else {
               
    if (!empty($_POST["email"]) &&
     !empty($_POST["motdepasse"]) && 
     !empty($_POST["Role"]) 
      ) {
        
        $requete = $bdd->prepare('INSERT INTO compte (email, motdepasse, roles, compteEmp ) values (?,?,?,?)');
        
        $status = $requete->execute([$email, $motdepasse, $Role, $compteEmp]);

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

    
}

}

?>