<?php 
include 'connectdb.php';

$bdd = connexion();

//On supprime la ligne qui correspond a l'id present dans l'URL 
$delete = $bdd->query("DELETE employe, compte, contrat, absence, conges FROM employe 
                         INNER JOIN compte ON employe.idEmp = compte.compteEmp
                         INNER JOIN contrat ON employe.idEmp = contrat.emp_contrat
                         INNER JOIN absence ON employe.idEmp = absence.emp_absence
                         INNER JOIN conges ON employe.idEmp = conges.emp_conge 
                         WHERE employe.idEmp=".$_GET['idEmp']." AND  
                        compte.compteEmp = ".$_GET['idEmp']." AND 
                        contrat.emp_contrat =  ".$_GET['idEmp']." AND 
                        absence.emp_absence  =  ".$_GET['idEmp']." AND 
                        conges.emp_conge =  ".$_GET['idEmp']."   ");



header('location:success.php');


?>