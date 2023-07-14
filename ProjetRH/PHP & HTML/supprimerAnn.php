<?php

include 'connectdb.php';

$bdd = connexion();

$delConge = $bdd->query("DELETE FROM annonce  WHERE idAnnonce= ".$_GET['idAnnonce']."  ");

$etat = '<div class="alert alert-success fade show" role="alert">
          Ajout effectué avec succès !
          </div>';
          header('location:gestAnnonce.php');

?>
