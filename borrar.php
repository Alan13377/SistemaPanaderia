<?php
    include_once 'conexion.php';
    if(isset($_GET['id'])){
        $id = (int) $_GET['id'];
        $delete=$conn->prepare('DELETE FROM costos WHERE id=:id');
        $delete->execute(array(
            ':id'=>$id
        ));
        header('Location: index.php');
    }else{
        header('Location: index.php');

    }
?>