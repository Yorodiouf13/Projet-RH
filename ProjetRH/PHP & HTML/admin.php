<?php
session_start();
if(!isset($_SESSION['user'])):
    header('location:page_accueil.php');
    exit();
endif;

include 'headerAdmin.php';

include 'connectdb.php';
$bdd = connexion();

$reponse = $bdd->query ("SELECT absence.* ,employe.* FROM absence JOIN employe ON absence.emp_absence = employe.idEmp ORDER BY employe.nom ");
$reponse2 = $bdd->query ("SELECT conges.* ,employe.* FROM conges JOIN employe ON conges.emp_conge = employe.idEmp ORDER BY conges.date_demande DESC ");

$employe = $bdd->prepare('SELECT count(idEmp) AS total FROM employe');
$admin = $bdd->prepare('SELECT count(idCompte) AS total2 FROM compte WHERE roles="Administration"');

$employe->execute();
$admin->execute();

$resultat = $employe->fetch();
$resultat2 = $admin->fetch();

$total = $resultat['total'];
$total2 = $resultat2['total2'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">


    <title>Tableau de Bord </title>
</head>
<body>
<div class="main--content">
            <div class="overview">
                
                <div class="cards">
                    <div class="card card-1">
                        <div class="card--data">
                            <div class="card--content">
                                <h5 class="card--title">Administrateur</h5>
                                <h1><?=$total2?></h1>
                            </div>
                            <i class="ri-user-2-line card--icon--lg"></i>
                        </div>
                       
                    </div>
                    <div class="card card-2">
                        <div class="card--data">
                            <div class="card--content">
                                <h5 class="card--title">Employé</h5>
                                <h1><?=$total?></h1>
                            </div>
                            <i class="ri-user-line card--icon--lg"></i>
                        </div>
                        <!-- <div class="card--stats">
                            <span><i class="ri-bar-chart-fill card--icon stat--icon"></i>82%</span>
                            <span><i class="ri-arrow-up-s-fill card--icon up--arrow"></i>230</span>
                            <span><i class="ri-arrow-down-s-fill card--icon down--arrow"></i>45</span>
                        </div> -->
                    </div>
                    
                    
                </div>
            </div>
            
           
            <div class="recent--patients">
                <div class="title">
                    <h2 class="section--title">Demande d'absence</h2>
                </div>

                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Motif Absence</th>
                                <th>Date de Demande</th>
                                <th>Date de Départ</th>
                                <th>Date de Retour</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        
                        while ($absence = $reponse->fetch())
    {?>
                            <tr>
                                <td><?=$absence['nom']?></td>
                                <td><?=$absence['prenom']?></td>
                                <td><?=$absence['motifAbsence']?></td>
                                <td><?=$absence['date_demande']?></td>
                                <td><?=$absence['date_depart']?></td>
                                <td><?=$absence['date_retour']?></td>
                                <?php 
                                switch ($absence['statut'] ) {
                                    case 'Accepté':
                                        ?> 
                                <td class="confirmed"><?=$absence['statut']?></td>
                                <td>
                                    <span>
                                        <i class="ri-delete-bin-line delete"></i>
                                    </span>
                                </td>

                                 <?php
                                        break;
                                    
                                    case 'Refusé':
                                        ?> 
                                <td class="rejected"><?=$absence['statut']?></td>
                                <td>
                                    <span>
                                            <i class="ri-delete-bin-line delete"></i>
                                    </span>
                                </td>


                                 <?php
                                        break;
                                    
                                    case 'En attente':
                                        ?> 
                                <td class="pending"><?=$absence['statut']?></td>
                                <td>
                                    <span>
                                        <a href="accepter.php?idEmp=<?=$absence['emp_absence']?>">
                                            <i class="ri-check-fill" style="color: greenyellow;"></i>
                                        </a>
                                        <a href="refus.php?idEmp=<?= $absence['emp_absence']?>">
                                            <i class="ri-close-fill" style="color: red;"></i>
                                        </a>
                                            <i class="ri-delete-bin-line delete"></i>
                                    </span>
                                </td>


                                 <?php
                                        break;
                                    
                                    default:
                                        echo "aucun";
                                        break;
                                }
                                
                                ?>    
                            </tr>
                            <?php }
                            ?>
                           
                        </tbody>
                    </table>
                </div>

<br><br>
            <h3>Demande de congés </h3>

            <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Type de Congés</th>
                                <th>Date de Demande</th>
                                <th>Date de Début</th>
                                <th>Date de Fin</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        
                        while ($conge = $reponse2->fetch())
    {?>
                            <tr>
                                <td><?=$conge['nom']?></td>
                                <td><?=$conge['prenom']?></td>
                                <td><?=$conge['type_conges']?></td>
                                <td><?=$conge['date_demande']?></td>
                                <td><?=$conge['date_debut']?></td>
                                <td><?=$conge['date_fin']?></td>

                                <?php 
                                switch ($conge['statut'] ) {
                                    case 'Accepté':
                                        ?> 
                                <td class="confirmed"><?=$conge['statut']?></td>
                                <td>
                                    <span>
                                    <a href="suppressionEmploye.php?idEmp=<?= $conge['emp_conge']?>">
                                            <i class="ri-delete-bin-line delete"></i>
                                        </a>                                    
                                    </span>
                                </td>

                                 <?php
                                        break;
                                    
                                    case 'Refusé':
                                        ?> 
                                <td class="rejected"><?=$conge['statut']?></td>
                                <td>
                                    <span>
                                    <a href="suppressionEmp.php?idEmp=<?= $conge['emp_conge']?>">
                                            <i class="ri-delete-bin-line delete"></i>
                                        </a>                                    
                                    </span>
                                </td>


                                 <?php
                                        break;
                                    
                                    case 'En attente':
                                        ?> 
                                <td class="pending"><?=$conge['statut']?></td>
                                <td>
                                    <span>
                                        <a href="accepter.php?idEmp=<?=$conge['emp_conge']?>">
                                            <i class="ri-check-fill" style="color: greenyellow;"></i>
                                        </a>
                                        <a href="refus.php?idEmp=<?= $conge['emp_conge']?>">
                                            <i class="ri-close-fill" style="color: red;"></i>
                                        </a>
                                        <a href="suppressionEmploye.php?idEmp=<?= $conge['emp_conge']?>">
                                            <i class="ri-delete-bin-line delete"></i>
                                        </a>
                                    </span>
                                </td>


                                 <?php
                                        break;
                                    
                                    default:
                                        echo "aucun";
                                        break;
                                }
                                
                                ?>
                             </tr>   

<?php } ?>
                        </tbody>
                    </table>
                </div>
            
        
</body>
</html>