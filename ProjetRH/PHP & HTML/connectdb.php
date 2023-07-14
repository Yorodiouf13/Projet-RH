<?php

function connexion(){
    $bdd = new PDO('mysql:host=localhost;dbname=RH','root', 'root');
    return $bdd;
}

?>