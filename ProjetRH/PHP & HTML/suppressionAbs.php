<?php

include 'connectdb.php';

$bdd = connexion();

$delAbsence = $bdd->query("DELETE FROM absence WHERE emp_absence= ".$_GET['idEmp']."  AND idAbsence = ".$_GET['idAbsence']."  ");

$etat = '<div class="alert alert-success fade show" role="alert">
          Ajout effectué avec succès !
          </div>';

header('location:techDA.php');
?>