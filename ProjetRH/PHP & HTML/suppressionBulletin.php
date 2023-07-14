<?php

include 'connectdb.php';

$bdd = connexion();

$delSalaire = $bdd->query("DELETE FROM salaire WHERE emp_sal = ".$_GET['idEmp']."  AND idSalaire = ".$_GET['idSalaire']."  ");

header('location:bulletin.php');
?>