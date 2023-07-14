<?php

include 'connectdb.php';
 
    $bdd=connexion();
$refusAbsence = $bdd->query("UPDATE absence SET statut = 'Refusé' WHERE emp_absence=".$_GET['idEmp']." AND idAbsence = ".$_GET['idAbsence']."     ");

$etat = '<div class="alert alert-success fade show" role="alert">
          Ajout effectué avec succès !
          </div>';

          header('location:absConge.php');


?>