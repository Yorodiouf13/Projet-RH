<?php 
session_start();
include 'headerAdmin.php';
include 'connectdb.php';
include 'calcul.php';
$bdd = connexion();

if (isset($_GET['idEmp'])) {
  $idEmp = $_GET['idEmp'];


if (isset($_POST['salaire_base'],  $_POST['sursalaire'], $_POST['primeAnc'],$_POST['heureSup'],$_POST['avantageNature'], $_POST['abattement'], $_POST['partIR'],  $_POST['partTrimf'],$_POST['ipm'],$_POST['oppositions'],$_POST['primeTrans']    )) {
       $salaire_base =$_POST['salaire_base'];
       $avantageNature =$_POST['avantageNature'];
       $abattement =$_POST['abattement'];
       $partIR =$_POST['partIR'];
       $partTrimf =$_POST['partTrimf'];
       $ipm =$_POST['ipm'];
       $oppositions = $_POST['oppositions'];
       $primeTrans =$_POST['primeTrans'];
       $sursalaire = $_POST['sursalaire'];
       $primeAnc = $_POST['primeAnc'];
       $heureSup = $_POST['heureSup'];
       $emp_sal = filter_var($_REQUEST["idEmp"], FILTER_VALIDATE_INT);
       
       
       $salaireBrutSocial = calculerSBSocial($salaire_base, $sursalaire, $primeAnc, $heureSup) ;
       $salaireFiscal = calculerSBFiscal($avantageNature, $abattement, $salaireBrutSocial);
       $ipressRC = calculerIpressRC($salaireBrutSocial);
       $ipressRG = calculerIpressRG($salaireBrutSocial);
       $retenueSalaire = retenue($ipm, $ipressRG, $ipressRC, $oppositions, $partTrimf, $partIR);
       $remuneNette = renumerationNette($salaireFiscal, $retenueSalaire);
       $netAPayer = netAPayer($remuneNette, $primeTrans);

       $requete = $bdd->prepare('INSERT INTO salaire (salaire_base, sursalaire, primeAnc, heureSup, salaireBrutSocial, salaireFiscal, avantageNature, abattement, partIR, partTrimf, ipm, ipressRC, ipressRG, retenueSalaire, remuneNette, netAPayer, primeTrans, oppositions, emp_sal) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        
       $status = $requete->execute([$salaire_base, $sursalaire, $primeAnc, $heureSup, $salaireBrutSocial, $salaireFiscal, $avantageNature, $abattement, $partIR, $partTrimf, $ipm, $ipressRC, $ipressRG, $retenueSalaire, $remuneNette, $netAPayer, $primeTrans, $oppositions, $emp_sal]);
       if ($status)
       {
         $etat = '<div class="alert alert-success fade show" role="alert">
         Ajout effectué avec succès ! <a href="bulletin.php" class="alert-link">Voir la liste des Bulletins</a> disponibles.
         </div>';
         
       }  
       else
       {
         $etat = '<div class="alert alert-warning fade show" role="alert">
         Echec de l\'ajout.
       </div>';					print_r($bdd->errorInfo());  
       }

}       


  $reponse = $bdd->query("SELECT * FROM employe where idEmp = '$idEmp' ");  
         while($utilisateur = $reponse->fetch())
          { ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <title>Employé - NetSystème</title>
</head>
<body>
 
    <div class="main--content">
        <div class="overview">

        <h1>Calcul du salaire de <?= $utilisateur['prenom'] ." ". $utilisateur['nom']?></h1><?php }}?><br>

        <form method="post">

        <?php if(!empty($etat)){echo $etat;}?>

        <!-- <div class="row">
        <div class="col-md-6">
              <label for="nom">Nombre d'heure</label>
              <input type="text" class="form-control" name="nbrHeure">
            </div>
            <div class="col-md-6">
              <label for="nom">Taux Horaire</label>
              <input type="text" class="form-control" name="tauxH">
            </div>
            </div>
             <br> -->

            <div class="row">
            <div class="col-md-6">
              <label for="nom">Salaire de Base</label>
              <input type="number" class="form-control" name="salaire_base" value="<?=$_GET['salaire_brute']?>" readonly>
            </div>
            <div class="col-md-6">
              <label for="nom">Sursalaire</label>
              <input type="text" class="form-control" name="sursalaire">
            </div>
            </div>

<br>



          <div class="row">
            <div class="col-md-6">
              <label for="nom">Prime d'Ancienneté</label>               
              <input class="form-control" name="primeAnc" >
            </div>
            <div class="col-md-6">
              <label for="datedebut">Heures Supplémentaires</label>
              <input id="date_debut" class="form-control" type="number" name="heureSup">
            </div>
          </div>
          <br>

         
          <br><br>
         

        

          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label>Avantage Nature</label>
                <input  class="form-control" type="number" name="avantageNature">
              </div>

              <div class="col-md-6">
                <label>Abattement</label>
                <input class="form-control" type="number" name="abattement">
              </div>
            </div>
          </div>
          <br>

         

          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label>IR</label>
                <input class="form-control" type="number" name="partIR">
              </div>

              <div class="col-md-6">
                <label>TRIMF</label>
                <input class="form-control" type="number" name="partTrimf">
              </div>
            </div>
          </div>
                                
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label>IPM</label>
                <input class="form-control" type="number" name="ipm">
              </div>

              <div class="col-md-6">
                <label >Oppositions</label>
                <input  class="form-control" type="number" name="oppositions">
              </div>
            </div>
          </div>

          <br>
                                
         
  <br><br>
  


          <div class="form-group">
            <div class="row">
              
              <div class="col-md-6">
                <label>Prime de transport</label>
                <input class="form-control" type="number" value="20800" readonly name="primeTrans"> 
              </div>

            </div>
          </div>
          
          <br>
          
          
          
          <button class="btn btn-primary"  name="ajout">Calculer</button>
      <br><br>
      
     </form>
<br><br><br><br>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    
</body>
</html>









