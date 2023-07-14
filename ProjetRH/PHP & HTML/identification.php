<?php
session_start();

    function connecter(){
    
    if(!isset($_SESSION['user'])) {
        header('location:page_accueil.php');
        exit();
    }
}

function chercher(){
    if (isset($_SESSION['user'])) {

        $email=$_SESSION['user'];
    
        $bdd= connexion();
        $sql = "SELECT compte.* ,employe.* FROM compte JOIN employe ON compte.compteEmp = employe.idEmp WHERE compte.email = '$email' ";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(array());

        while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $idEmp = $user['idEmp'];
        }
        


        return $idEmp;
    
    }
      
}
?>
