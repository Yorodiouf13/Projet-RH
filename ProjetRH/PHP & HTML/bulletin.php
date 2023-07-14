<?php
session_start();
include 'headerAdmin.php';
include 'connectdb.php';

$bdd = connexion();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile-tech.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Bulletin - NetSystème</title>
</head>
<body>
<div class="main--content">
    <div class="overview">
    <h1>Bulletin de Paie</h1><br>
    
<br>
<div class="table table-hover">
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>Téléphone</th>
                    <th>Poste</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            <?php

            $reponse = $bdd->query('SELECT employe.*, contrat.*, salaire.* FROM employe left join contrat on employe.idEmp=contrat.emp_contrat right join salaire on employe.idEmp=salaire.emp_sal ');
    
    while ($utilisateur = $reponse->fetch())
    {?>
                <tr style="cursor: pointer;"  onclick="document.location='afficheBulletin.php?idEmp=<?= $utilisateur['idEmp'];?>&idSalaire=<?=$utilisateur['idSalaire']?>&idContrat=<?=$utilisateur['idContrat']?>'">
                    <td><?= $utilisateur['nom'] ?></td>
                    <td><?= $utilisateur['prenom'] ?></td>
                    <td><?= $utilisateur['ddn'] ?></td>
                    <td><?= $utilisateur['telephone'] ?></td>
                    <td><?=$utilisateur['poste']?></td>
                    <td><span><a href="saisie.php?idEmp=<?= $utilisateur['idEmp']?>&idSalaire=<?=$utilisateur['idSalaire']?>"><i class="ri-calculator-line" style="color: peru;"></i></a><a href="afficheBulletin.php?idEmp=<?= $utilisateur['idEmp'];?>&idSalaire=<?=$utilisateur['emp_sal']?>&idContrat=<?=$utilisateur['idContrat']?>"><i class="ri-eye-line" style="color: teal;"></i></a><a onclick="return confirm('Etes vous sur de vouloir supprimer ce bulletin ?')" href="suppressionBulletin.php?idEmp=<?=$utilisateur['idEmp']?>&idSalaire=<?=$utilisateur['idSalaire']?>"><i class="ri-delete-bin-line" style="color: red;"></i></a></span></td>

                </tr>
                
      
         
    <?php
    }
     ?>          
            </tbody>
        </table>
    </div>
    </div>
</div>
 
</body>
</body>
</html>