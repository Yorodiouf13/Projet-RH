<?php

?>

<button class="hidden-print" id="btnPrint" style="position: relative; left: 45%;"> <i class='bx bx-printer'></i> Imprimer</button>

<div class="home-content" >

<table class=" table-bordered table-sm" >
    <tr colspan="6">
      <style>
        .po{
          height: 8%;
          width: 8%;
          padding-left: 50px;
        }
      </style>
      <img src="Photo-Netsysteme.ico" alt="" class="po">
        <th class="d-flex justify-content-center">Bulletin de Paie
          <br>
          <br>
        </th>
    </tr>
   
</table> 

<table class="table table-bordered table-striped table-sm" >
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
Nombre de part :
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
<td class="table-borderless"></td>
<td></td>
<td><?=$utilisateur['salaire_base']?></td>
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
<td></td>
<td></td>
<td><?=$utilisateur['sursalaire']?></td>
<td></td>

</tr>

<tr>
<th>Salaire brut social</th>
<td></td>
<td></td>
<td><?=$utilisateur['salaireBrutSocial']?></td>
<td></td>

</tr>

<tr>
<th>Salaire brut fiscal</td>
<td></td>
<td></td>
<td><?=$utilisateur['salaireFiscal']?></td>
<td></td>

</tr>

<tr>
<th>Cotisation IPRESS RG </th>
<td><?php if ($utilisateur['salaireBrutSocial'] > $utilisateur['plafond'] ) { 
echo $utilisateur['plafond'];
}else{
echo  $utilisateur['salaireBrutSocial'];
}?></td>
<td>5,6%</td>
<td></td>
<td><?=$utilisateur['ipressRG']?></td>

</tr>

<tr>
<th>Cotisation IPRESS RC </th>
<td><?php if ($utilisateur['salaireBrutSocial'] > $utilisateur['plafond2'] ) { 
echo $utilisateur['plafond2'];
}else{
echo  $utilisateur['salaireBrutSocial'];
}?></td>
<td>2,4%</td>
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
<td></td>
<td></td>
<td><?=$utilisateur['remuneNette']?></td>
<td></td>

</tr>

<tr>
<th>Prime de Transport</th>
<td>..........</td>
<td></td>
<td> 20800</td>
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
<p>Date de Paie :  <?php echo date('m/Y') ?></p>
</>



</div>
<script>
    
    var btnPrint = document.querySelector('#btnPrint');
    btnPrint.addEventListener("click", () => {
        window.print();
    });
   

</script>

