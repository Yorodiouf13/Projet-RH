<?php

include 'connectdb.php';
 
    $bdd=connexion();

 $accepterConge = $bdd->query("UPDATE conges SET statut = 'Accepté' WHERE emp_conge=".$_GET['idEmp']." AND idConge = ".$_GET['idConge']." ");

 $etat = '<div class="alert alert-success fade show" role="alert">
 Ajout effectué avec succès !
 </div>';

 header('location:absConge.php');


   

?>