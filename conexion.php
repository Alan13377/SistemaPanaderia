<?php
    $bd = "panaderia";
    $user ="root";
    $password="";

    try{
         $conn = new PDO('mysql:host=localhost;dbname='.$bd,$user,$password);
    }catch(PDOException $e){
        echo "Erro".$e->getMessage();
    }
?>