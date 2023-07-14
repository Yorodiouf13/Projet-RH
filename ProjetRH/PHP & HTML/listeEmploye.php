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

    <title>Employé - NetSystème</title>
</head>
<body>
<div class="main--content">
    <div class="overview">


      <h1>Liste des employés </h1><br>

<div class="table">
        <table class="table-hover" >
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>Sexe</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            <?php

            $reponse = $bdd->query('SELECT * FROM employe');
    
    while ($utilisateur = $reponse->fetch())
    {?>
                <tr style="cursor: pointer;"  onclick="document.location='pp.php?idEmp=<?= $utilisateur['idEmp'];?>'">
                    <td><?= $utilisateur['nom'] ?></td>
                    <td><?= $utilisateur['prenom'] ?></td>
                    <td><?= $utilisateur['ddn'] ?></td>
                    <td><?= $utilisateur['sexe'] ?></td>
                    <td><?= $utilisateur['telephone'] ?></td>
                    <td><?= $utilisateur['adresse'] ?></td>
                    <td><span><a href="modifierEmploye.php?idEmp=<?= $utilisateur['idEmp'];?>"><i class="ri-edit-line edit"></i></a><a onclick="return confirm('Etes vous sur de vouloir supprimer cet utilisateur')" href="suppressionEmp.php?idEmp=<?= $utilisateur['idEmp'];?>"><i class="ri-delete-bin-line delete"></i></a><a href="pp.php?idEmp=<?= $utilisateur['idEmp'];?>"> <i class="ri-book-read-fill"></i></a></span></td>

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