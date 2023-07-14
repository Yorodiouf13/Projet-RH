<?php

function salaire_base($tauxHoraire){

    $salaireBase= $tauxHoraire * 173.33;
    return $salaireBase;
}

function calculerSBSocial($salaire_base, $sursalaire, $primeAnc, $heureSup) {
    // Calcul du salaire brut
    $salaireBrutSocial = $salaire_base + $sursalaire + $primeAnc + $heureSup ;
    
    return $salaireBrutSocial;
}

function calculerSBFiscal($avantageNature, $abattement, $salaireBrutSocial){
    $salaireFiscal = $salaireBrutSocial + $avantageNature - $abattement;

    return $salaireFiscal;
}

function calculerIpressRG($salaireBrutSocial) {
     
    $plafond=360000;

    if ($salaireBrutSocial <= $plafond) {

        $IpressRG = ($salaireBrutSocial *5.6)/100 ;

    } else {
        $IpressRG = (360000 * 5.6)/100;
    }
        
    return $IpressRG;
}


function calculerIpressRC($salaireBrutSocial) {
     
    $plafond = 1080000;
    $plafond2 = 360000;

    if ($salaireBrutSocial  > $plafond2) {
            
    if ($salaireBrutSocial <= $plafond) {

        $IpressRC = ($salaireBrutSocial *2.4)/100 ;

    } else {
        $IpressRC = ($plafond * 2.4)/100;
    }
          return $IpressRC;
} else{
    $IpressRC = 0;

}

}


function retenue($ipm, $ipressRG, $ipressRC, $opposition, $PartTrimf, $partIR){
    $retenueSalaire = $ipm + $ipressRG + $ipressRC + $opposition + $PartTrimf + $partIR;

    return $retenueSalaire;

}
function renumerationNette($salaireBrutFiscal, $retenueSalaire){
    $remuneNette = $salaireBrutFiscal - $retenueSalaire;

    return $remuneNette;
}

function netAPayer($remuneNette, $primeTrans){
    $netAPayer = $remuneNette + $primeTrans;
    return $netAPayer;
}

?>