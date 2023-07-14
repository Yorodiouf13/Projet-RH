<?php

include 'connectdb.php';

$bdd = connexion();

$delContrat = $bdd->query("DELETE FROM contrat WHERE emp_contrat = ".$_GET['idEmp']."  AND idContrat = ".$_GET['idContrat']."  ");

header('location:contrat.php');
?>