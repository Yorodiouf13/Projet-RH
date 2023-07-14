<?php
session_start();
include 'headerAdmin.php';
include 'connectdb.php';


$bdd = connexion();

$reponse = $bdd->query ("SELECT absence.* ,employe.* FROM absence JOIN employe ON absence.emp_absence = employe.idEmp ORDER BY absence.date_demande DESC ");
$reponse2 = $bdd->query ("SELECT conges.* ,employe.* FROM conges JOIN employe ON conges.emp_conge = employe.idEmp ORDER BY conges.date_demande DESC ");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <title>Demandes - NetSystème</title>
</head>
<body>
    
    <div class="main--content">
        <div class="overview">
        <?php if(!empty($etat)){echo $etat;}?>

            <h3>Demande d'absence </h3><br><br>

            <div class="table">
                    <table >
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
                                    <a href="suppressionAbs.php?idEmp=<?= $absence['emp_absence']?>&idAbsence=<?=$absence['idAbsence']?>">
                                            <i class="ri-delete-bin-line delete"></i>
                                        </a>
                                    </span>
                                </td>

                                 <?php
                                        break;
                                    
                                    case 'Refusé':
                                        ?> 
                                <td class="rejected"><?=$absence['statut']?></td>
                                <td>
                                    <span>
                                    <a href="suppressionAbs.php?idEmp=<?= $absence['emp_absence']?>&idAbsence=<?=$absence['idAbsence']?>">
                                            <i class="ri-delete-bin-line delete"></i>
                                    </a>
                                    </span>
                                </td>


                                 <?php
                                        break;
                                    
                                    case 'En attente':
                                        ?> 
                                <td class="pending"><?=$absence['statut']?></td>
                                <td>
                                    <span>
                                        <a href="accepterabs.php?idEmp=<?=$absence['emp_absence']?>&idAbsence=<?=$absence['idAbsence']?>">
                                            <i class="ri-check-fill" style="color: greenyellow;"></i>
                                        </a>
                                        <a href="refusabs.php?idEmp=<?= $absence['emp_absence']?>&idAbsence=<?=$absence['idAbsence']?>">
                                            <i class="ri-close-fill" style="color: red;"></i>
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
                            <?php }
                            ?>
                           
                           
                        </tbody>
                    </table>
                </div>

<br><br>
            <h3>Demande de congés </h3><br><br>

            <div class="table">
                    <table >
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
                            <tr >
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
                                    <a href="suppressionCo.php?idEmp=<?= $conge['emp_conge']?>&idConge=<?=$conge['idConge']?>">
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
                                    <a href="suppressionCo.php?idEmp=<?= $conge['emp_conge']?>&idConge=<?=$conge['idConge']?>">
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
                                        <a href="accepter.php?idEmp=<?=$conge['emp_conge']?>&idConge=<?=$conge['idConge']?>">
                                            <i class="ri-check-fill" style="color: greenyellow;"></i>
                                        </a>
                                        <a href="refus.php?idEmp=<?= $conge['emp_conge']?>&idConge=<?=$conge['idConge']?>">
                                            <i class="ri-close-fill" style="color: red;"></i>
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
            
        </div>
    </div>
           
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>