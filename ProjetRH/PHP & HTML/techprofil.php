<?php
include 'headerTech.php';
include 'connectdb.php';
require_once('identification.php');
connecter();



if (isset($_SESSION['user'])) {

    $email=$_SESSION['user'];

    $bdd= connexion();
    $sql = "SELECT employe.*, compte.* , contrat.*  FROM employe RIGHT JOIN compte ON employe.idEmp=  compte.compteEmp LEFT JOIN contrat ON employe.idEmp =  contrat.emp_contrat  WHERE compte.email = '$email' ";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $reponse = "SELECT count(absence.idAbsence) AS total FROM absence JOIN compte ON absence.emp_absence =compte.compteEmp  WHERE compte.email = '$email' AND absence.statut = 'Accepté'";
    $reponse2 =  "SELECT count(conges.idConge) AS total2 FROM conges JOIN compte ON conges.emp_conge =compte.compteEmp WHERE compte.email = '$email' AND conges.statut = 'Accepté'";

    $prepare = $bdd->prepare($reponse);
    $prepare2 = $bdd->prepare($reponse2);

    $prepare->execute();
    $prepare2->execute();

    $resultat = $prepare->fetch(PDO::FETCH_ASSOC);
    $resultat2 = $prepare2->fetch(PDO::FETCH_ASSOC);

    $total = $resultat['total'];
    $total2 = $resultat2['total2'];


}
  

  ?>  
   


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

.button {
    appearance: none;
    border: none;
    outline: none;

    display: inline-block;
    background-color: #FE4880;
    color: #FFF;
    font-size: 20px;
    padding: 10px 15px;
    border-radius: 8px;
    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    margin: 0px 15px;
}

.button.large {
    font-size: 24px;
    padding: 15px 30px;
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

.popup h2 {
    color: #313131;
    font-size: 28px;
    font-weight: 600;
}

.popup h3 {
    color: #888;
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 30px;
}

.popup p {
    color: #666;
    font-size: 16px;
    font-weight: 400;
    margin-bottom: 15px;
}

.popup p:last-of-type {
    margin-bottom: 30px;
}
</style>
</head>
<body>
<div class="main--content">
    <div class="overview">
    <?php if(!empty($etat)){echo $etat;}?>

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <div class="mt-3">
                                <h4><?=$user['prenom']?> <?=$user['nom']?></h4>
                                <p class="text-secondary mb-1"><?=$user['poste']?></p>
                                <p class="text-muted font-size-sm"><?=$user['adresse']?></p>
                                <!-- <button class="btn btn-primary"><a href=""><i class="ri-edit-line edit"></i>Modifier</a></button> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <div class="btn btn-primary popup-button" data-target="#popup-main">Voir Contrat</div>
                            <div class="popup" id="popup-main">
                            <div class="popup-overlay popup-button" data-target="#popup-main"></div>
                            <div class="popup-inner">
                                <h1>Contrat</h1> 
                                 <?php
                                 $db = connexion();

                                 ?>
                                
                                    <div class="row">
                                                <div class="col-sm-6">
                                                    <h6 class="mb-0">Type de Contrat</h6>
                                                </div>
                                            <div class="coordonnes"><?=$user['typeContrat']?> </div>
                                        </div>
                                        <hr>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h6 class="mb-0">Date début du contrat</h6>
                                        </div>
                                    <div class="coordonnes">
                                    <?=$user['date_debut']?>
                                    </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h6 class="mb-0">Date de fin</h6>
                                        </div>
                                        <div class="coordonnes"><?=$user['date_fin_CDD']?></div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h6 class="mb-0">Salaire de Base</h6>
                                        </div>
                                        <div class="coordonnes"> <?=$user['salaire_base']?></div>
                                    </div>

                                    <hr>


                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h6 class="mb-0">Nombre de Part</h6>
                                        </div>
                                        <div class="coordonnes"> <?=$user['nbrPart']?></div>
                                    </div>

                                    <hr>

                                </div>



                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <span class="text-secondary">Nombre d'absence</span>
                            <span class="text-secondary"><?=$total?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <span class="text-secondary">Nombre de congés</span>
                            <span class="text-secondary"><?=$total2?></span>
                        </li>
                
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
                        <div class="coordonnes" for="nom">
                        <?=$user['nom']?>
                        </div>
                    </div>
                    <hr>

                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mb-0">Prenom</h6>
                    </div>
                <div class="coordonnes" for="prenom">
                <?=$user['prenom']?>
                </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mb-0">Date de Naissance</h6>
                    </div>
                <div class="coordonnes">
                <?=$user['ddn']?>
                </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mb-0">Téléphone</h6>
                    </div>
                    <div class="coordonnes" for="telephone">
                    <?=$user['telephone']?>
                    </div>
                    
                </div>

                <hr>

                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mb-0">Sexe</h6>
                    </div>
                    <div class="coordonnes" for="sexe">
                    <?=$user['sexe']?>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="coordonnes">
                    <?=$user['email']?>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mb-0">Adresse</h6>
                    </div>
                    <div class="coordonnes">
                    <?=$user['adresse']?>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mb-0">Situation Matrimoniale</h6>
                    </div>
                <div class="coordonnes">
                <?=$user['sitMatr']?>
                </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="mb-0">Nombre d'enfants</h6>
                    </div>
                <div class="coordonnes"> <?=$user['nbrEnfant']?>
                </div>
            <hr>
            </div>
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