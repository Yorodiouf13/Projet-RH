<?php
session_start();
include 'headerAdmin.php';
include 'connectdb.php';

$bdd = connexion();
     if (isset($_GET['idEmp'])) {
                $idEmp = $_GET['idEmp'];
               
            $reponse = $bdd->query("SELECT * FROM employe where idEmp = '$idEmp' ");
                       
                       while($utilisateur = $reponse->fetch())
                        { ?>
 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="pp.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - NetSystème</title>
    <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Fira Sans', sans-serif;
}

.page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}



.popup {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 999;
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.4s;
}

.popup.is-active {
    opacity: 1;
    pointer-events: all;
}

.popup-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 0;
    background-color: rgba(0, 0, 0, 0.5);
}

.popup-inner {
    position: relative;
    z-index: 1;
    max-width: 600px;
    padding: 50px 30px;
    background-color: #FFF;
    border-radius: 16px;
    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
}


</style>
</head>
<body>

<div class="main--content">
    <div class="overview">

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <div class="mt-3">
                                <h4><?= $utilisateur['nom'] ." ". $utilisateur['prenom']?></h4>
                                <p class="text-secondary mb-1"><?= $utilisateur['poste'];?></p>
                                <p class="text-muted font-size-sm"><?= $utilisateur['adresse'];?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <div class="btn btn-primary popup-button" data-target="#popup-main">Nouveau Contrat</div>
                            <div class="popup" id="popup-main">
                                <div class="popup-overlay popup-button" data-target="#popup-main"></div>
                                <div class="popup-inner">
                                    <h1>Ajouter Contrat</h1>
                                    <?php if(!empty($etat)){echo $etat;}?>

                                    <form action="new_contrat.php" method="post">
                                        <div class="form-group">
                                        <div class="col-md-16">
                                                    <label for="nom">ID Employé</label>
                                                    <input type="number" class="form-control" name="idEmp" value="<?= $utilisateur['idEmp'];?>" readonly>
                                                </div>
                                                <div class="col-md-16">
                                                    <label for="nom">Poste</label>
                                                    <input type="text" class="form-control" name="poste"value="<?= $utilisateur['poste'];?>" readonly>
                                                </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="nom">Type de contrat</label>
                                                    <select class="form-control" name="type" id="">
                                                        <option value=""></option>
                                                        <option value="CDD">CDD</option>
                                                        <option value="CDI">CDI</option>
                                                    </select> 
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="datedebut">Date de début</label>
                                                    <input id="date_debut" class="form-control" type="date" name="date_debut">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="date_fin">Date de fin</label>
                                                    <input id="date_fin" class="form-control" type="date" name="date_fin">
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <label for="salaire">Taux Horaire</label>
                                                    <input id="salaire" class="form-control" type="text" name="tauxH">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="date_fin">Nombre de part </label>
                                                    <input id="date_fin" class="form-control" type="text" name="nbrPart">
                                                </div>
                                            </div>
                                        </div>
                                
                                        <button class="btn btn-primary" data-target="#popup-main" name="ajout">Ajouter</button>
                                    </form>

                                </div>
                        </div>


                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            
                            <div class="btn btn-primary popup-button" data-target="#popup-secondary">Ajouter Compte</div>
                            <div class="popup" id="popup-secondary">
                                <div class="popup-overlay popup-button" data-target="#popup-secondary"></div>
                                <div class="popup-inner">
                                    <h1>Ajouter compte</h1>
                                    <?php if(!empty($etat)){echo $etat;}?>

                                    <form action="new_compte.php" method="post">
                                        <div class="form-group">
                                        <div class="col-md-16">
                                                    <label for="nom">ID Employé</label>
                                                    <input type="number" class="form-control" name="idEmp" value="<?= $utilisateur['idEmp'];?>" readonly>
                                                </div>
                                                <div class="col-md-16">
                                                    <label for="nom">Email</label>
                                                    <input type="text" class="form-control" name="email" >
                                                </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="nom"> Mot de passe</label>
                                                    <input type="password" class="form-control" name="motdepasse" >
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="datedebut">Role</label>
                                                    <select class="form-control" name="Role" id="">
                                                        <option value=""></option>
                                                        <option value="Administration">Administrateur</option>
                                                        <option value="Technicien">Technicien</option>
                                                    </select>
                                                    
                                                </div>

                                            </div>
                                        </div>

                                        
                                
                                        <button class="btn btn-primary" data-target="#popup-main" name="ajout">Ajouter</button>
                                    </form>

                                </div>
                        </div>


                        </li>
                        <?php
                        $bulletin = $bdd->query("SELECT employe.*, contrat.* FROM employe  join contrat on employe.idEmp=contrat.emp_contrat  where employe.idEmp = '$idEmp' ");
    
    while ($test = $bulletin->fetch())
    {?>
                        <li  class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <a class="btn btn-primary" href="salaire.php?idEmp=<?= $test['idEmp']?>&salaire_brute=<?=$test['salaire_base']?>">Calculer Salaire</a>
                        </li>
                        <?php
    }
     ?>       
                    </ul>
                </div>

            </div>
            
         
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="mb-0">Nom</h6>
                            </div>
                        <div class="coordonnes"> <?= $utilisateur['nom']?></div>
                    </div>
                    <hr>

                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mb-0">Prenom</h6>
                    </div>
                <div class="coordonnes">
                <?= $utilisateur['prenom'] ?>
                </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mb-0">Date de Naissance</h6>
                    </div>
                <div class="coordonnes">
                <?= $utilisateur['ddn'] ?>
                </div>
                </div>


                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mb-0">Lieu de Naissance</h6>
                    </div>
                <div class="coordonnes">
                <?= $utilisateur['ldn'] ?>
                </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mb-0">Téléphone</h6>
                    </div>
                    <div class="coordonnes"> <?= $utilisateur['telephone'] ?></div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mb-0">Sexe</h6>
                    </div>
                    <div class="coordonnes"> <?= $utilisateur['sexe'] ?></div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mb-0">Adresse</h6>
                    </div>
                    <div class="coordonnes"> <?= $utilisateur['adresse'] ?></div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mb-0">Situation Matrimoniale</h6>
                    </div>
                    <div class="coordonnes"> <?= $utilisateur['sitMatr'] ?></div>

                </div>

                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mb-0">Nombre d'enfants</h6>
                    </div>
                    <div class="coordonnes"> <?= $utilisateur['nbrEnfant'] ?></div>

                    <?php }}?>
                </div>
            </div>
            <hr>
        </div>

                  
    </div>
</div>

<script>

window.onload = () => {
    const popup_btns = document.querySelectorAll('.popup-button');

    popup_btns.forEach(button => {
        button.addEventListener('click', e => {
            const target = e.target.dataset.target;

            const popup_el = document.querySelector(target);
            if (popup_el != null) {
                popup_el.classList.toggle('is-active');
            }
        });
    });
}
    
    </script>

</body>
</html>