<?php

include 'connectdb.php';
 
    $bdd=connexion();

 $refusConge = $bdd->query("UPDATE conges SET statut = 'Refusé' WHERE emp_conge= ".$_GET['idEmp']."    AND idConge = ".$_GET['idConge']."  ");


 $etat = '<div class="alert alert-info fade show" role="alert">
 Refus effectué avec succès !
 </div>';
 header('location:absConge.php');


   

?>