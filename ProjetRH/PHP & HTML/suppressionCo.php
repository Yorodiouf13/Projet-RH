<?php

include 'connectdb.php';

$bdd = connexion();

$delConge = $bdd->query("DELETE FROM conges  WHERE emp_conge= ".$_GET['idEmp']." AND idConge = ".$_GET['idConge']."  ");

$etat = '<div class="alert alert-success fade show" role="alert">
          Ajout effectué avec succès !
          </div>';
          header('location:techDC.php');

?>
