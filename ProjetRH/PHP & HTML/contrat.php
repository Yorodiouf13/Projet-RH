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
    <link rel="stylesheet" href="profile-tech.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Contrat - NetSystème</title>
</head>
<body>
<div class="main--content">
    <div class="overview">
    <h1>Contrat </h1><br>

<div class="table">
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>date de naissance</th>
                    <th>Poste</th>
                    <th>Type de contrat</th>
                    <th>Salaire en FCFA</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>



            <?php

                $reponse = $bdd->query('SELECT employe.*, contrat.* FROM employe join contrat on employe.idEmp=contrat.emp_contrat');
               
                while ($utilisateur = $reponse->fetch())
                {?>
                    <tr>
                        <td><?= $utilisateur['nom'] ?></td>
                        <td><?= $utilisateur['prenom'] ?></td>
                        <td><?= $utilisateur['ddn'] ?></td>
                        <td><?= $utilisateur['poste'] ?></td>
                        <td><?= $utilisateur['typeContrat'] ?></td>
                        <td><?= $utilisateur['salaire_base'] ?></td>
                        <td><a onclick="return confirm('Etes vous sur de vouloir supprimer ce contrat ?')" href="suppressionContrat.php?idEmp=<?=$utilisateur['idEmp']?>&idContrat=<?=$utilisateur['idContrat']?>"><i class="ri-delete-bin-line" style="color: red;"></i></a></td>

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
</html>