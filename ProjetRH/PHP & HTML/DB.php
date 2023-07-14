<?php
include 'headerTech.php';
include 'connectdb.php';
require_once('identification.php');
connecter();

$bdd = connexion();
if (isset($_SESSION['user'])) {

  $email=$_SESSION['user'];
  $sql = "SELECT employe.*, compte.* , contrat.*, salaire.*  FROM employe RIGHT JOIN compte ON employe.idEmp=  compte.compteEmp LEFT JOIN contrat ON employe.idEmp =  contrat.emp_contrat LEFT JOIN salaire on employe.idEmp=salaire.emp_sal  WHERE compte.email = '$email' ";

  $stmt = $bdd->prepare($sql);
  $stmt->execute();
  $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <script src="vendor/spipu/html2pdf/-"></script>

</head>
<body>
<body>
    <div class="main--content">
        <div class="overview">
        
        <table class=" table-bordered table-sm">
            <tr colspan="6">
                <th class="d-flex justify-content-center">Bulletin de Paie</th>
            </tr>
           
        </table> 

    <table class="table table-bordered table-striped table-sm">
  <thead>
  <tr>
    <th colspan="2">      
        Netsystème-Informatique<br>
        Adresse : Ouest Foire<br>
        Periode : <?php echo date('m/Y') ?><br>
        Nombre d'heure : 173.33H<br>      
    </th>

 <th colspan="4">
        Nom : <?=$utilisateur['nom']?><br>
        Prénom :  <?=$utilisateur['prenom']?><br>
        Catégorie :  <?=$utilisateur['categorie']?> <br>
        Ancienneté en année
 </th>

    </tr>
    <tr>
      <th>N˚</th>
      <th scope="col">Libellés</th>
      <th>Base</th>
      <th>Taux</th>
      <th>Gains</th> 
      <th>Retenues</th>    
    </tr>
    
  </thead>
  <tbody>
    
    <tr>
      <td rowspan="23"></td>
      <th>Salaire de base</th>
      <td class="table-borderless"><?=$utilisateur['salaire_base']?></td>
      <td></td>
      <td></td>
      <td></td>
      
    </tr>
    
    
    <tr>
      <td>Taux horaire </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      
    </tr>
    
    <tr>
      <td>Heures Supplementaires </td>
      <td></td>
      <td>15%</td>
      <td></td>
      <td></td>
      
    </tr>
    
    <tr>
    <td>Heures Supplementaires </td>
      <td></td>
      <td>40%</td>
      <td></td>
      <td></td>
      
    </tr>
    
    <tr>
      <td>Heures Supplementaires </td>
      <td></td>
      <td>60%</td>
      <td></td>
      <td></td>
      
    </tr>
    
    
    <tr>
      <td> Heures Supplementaires  </td>
      <td></td>
      <td>100%</td>
      <td></td>
      <td></td>
      
    </tr>
    
    <tr>
      <td>Primes et indemnités imposables</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      
    </tr>
    
    <tr>
      <th>Sursalaire </th>
      <td><?=$utilisateur['sursalaire']?></td>
      <td></td>
      <td></td>
      <td></td>
      
    </tr>
    
    <tr>
      <th>Salaire brut social</th>
      <td><?=$utilisateur['salaireBrutSocial']?></td>
      <td></td>
      <td></td>
      <td></td>
      
    </tr>
    
    <tr>
    <th>Salaire brut fiscal</td>
    <td><?=$utilisateur['salaireFiscal']?></td>
    <td></td>
    <td></td>
    <td></td>
    
  </tr>
  
  <tr>
    <th>Cotisation IPRESS RG </th>
    <td><?=$utilisateur['salaireBrutSocial']?></td>
    <td>2,4%</td>
    <td></td>
    <td><?=$utilisateur['ipressRG']?></td>
    
  </tr>
  
  <tr>
    <th>Cotisation IPRESS RC </th>
    <td><?=$utilisateur['salaireBrutSocial']?></td>
    <td>5,6%</td>
    <td></td>
    <td><?=$utilisateur['ipressRC']?></td>
    
  </tr>

  <tr>
    <th>IPM</th>
    <td></td>
    <td></td>
    <td></td>
    <td><?=$utilisateur['ipm']?></td>
    
  </tr>
  
  <tr>
    <th>IR</td>
    <td><?=$utilisateur['salaireBrutSocial']?></td>
    <td></td>
    <td></td>
    <td><?=$utilisateur['partIR']?></td>
    
  </tr>
  
  <tr>
    <th>TRIMF</th>
    <td><?=$utilisateur['salaireFiscal']?></td>
    <td></td>
    <td></td>
    <td><?=$utilisateur['partTrimf']?></td>
    
  </tr>

    <tr>
      <th>Oppositions</th>
      <td></td>
      <td></td>
      <td></td>
      <td><?=$utilisateur['oppositions']?></td>
      
    </tr>
    
    <tr>
      <th>Total Retenus</th>
      <td></td>
      <td></td>
      <td></td>
      <td><?=$utilisateur['retenueSalaire']?></td>
      
    </tr>
    
    <tr>
      <th>Rémunération nette</th>
      <td><?=$utilisateur['remuneNette']?></td>
      <td></td>
      <td></td>
      <td></td>
      
    </tr>
    
    <tr>
      <th>Prime de Transport</th>
      <td> 20800</td>
      <td>..........</td>
      <td></td>
      <td></td>
      
    </tr>
    
    <table class=" table-bordered table-sm">
      <tr colspan="6">
        <th>Net A Payer : <?=$utilisateur['netAPayer']?> </th>
      </tr>       
      
    </table> 
  </tbody>
</table>

<br>

<label>
  <p>Date de Paie</p>
</>




</div>
</div>

<?php }?>
</body>
</html>