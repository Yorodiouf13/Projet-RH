<?php

include 'connectdb.php';


function recherche($recherche) {
	// Connexion à la base de données
	$bdd = connexion();
	
		// Requête SQL pour effectuer la recherche
		$requete = "SELECT * FROM employe WHERE nom LIKE :recherche OR prenom LIKE :recherche OR idEmp LIKE :recherche ";
		$statement = $bdd->prepare($requete);
		$statement->bindValue(':recherche', '%' . $recherche . '%');
		$statement->execute();
	
		// Récupération des résultats
		$resultats = $statement->fetchAll(PDO::FETCH_ASSOC);
	
		// Fermeture de la bdd à la base de données
		$bdd = null;
	
		// Retourne les résultats de la recherche
		return $resultats;
	}
	
	// Exemple d'utilisation de la fonction de recherche
	$recherche = $_GET['q']; // La valeur à rechercher
	$resultats = recherche($recherche);
	
	// Affichage des résultats
	header("location:pp.php");

	
	?>