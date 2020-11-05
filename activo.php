<?php
    include_once 'conexion.php';


    if(isset($_POST['guardarA'])){
        $concepto = $_POST['concepto'];
        $categoria = $_POST['categoria'];
        $costo = $_POST['costo'];
        $total = $_POST['total'];
        $total = $total+$costo;
        if(!empty($concepto) && !empty($opciones) && !empty($cantidad) && !empty($costo)){
            $consulta_insert = $conn->prepare('INSERT INTO activo(concepto,categoria,costo,total) VALUES(:concepto,:categoria,:costo,:total)');
            $consulta_insert->execute(array(
                ':concepto' =>$concepto,
                ':opciones' =>$categoria,
                ':cantidad' =>$costo,
                ':total' =>$$total
            ));
            header('Location: index.php');
        }else{
            echo "<script>alert('Los campos estan vacios ');</script>";
        }

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Insertar</title>
</head>
<body>


<div class="contenedor-barra">
<div class="navegacion">
            <nav>
                <a href="index.php">Volver</a>
            </nav>
            <h1>Formulario</h1>
        </div>
       
        
    </div>
    <div class="bg-amarillo contenedor sombra">
        
        <form id="materia" action="" method="post">
            <Legend>Ingrese los Datos <span>Todos los campos son obligatorio</span> </Legend>
            <div class="campos">
                    <div class="campo">
                        <label for="concepto">Concepto:</label>
                        <input type="text" placeholder="Ingrese la materia"
                            name="concepto"  required="required"
                        >
                    </div>
                    <div class="campo">
                        <label for="opciones">Categoria:</label>
                        <select name="categoria" required="required">
                            <option value="" disbled selected>Seleccione</option>
                            <option value="Activo Circulante">Activo Circulante</option>
                            <option value="Activo No Circulante">Activo No Circulante</option>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="costo">Costo:</label>
                        <input type="number" placeholder="Ingrese el costo" name="costo"  required="required">
                    </div>
                    
    </div>
        <div class="campo enviar">
                 <input type="submit" name="guardarA" value="Añadir">
        </div>
        </form>
    </div>
    
</body>
</html>