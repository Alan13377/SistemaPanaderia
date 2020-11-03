<?php
    include_once 'conexion.php';


    if(isset($_POST['guardar'])){
        $concepto = $_POST['concepto'];
        $opciones = $_POST['opciones'];
        $cantidad = $_POST['cantidad'];
        $costo = $_POST['costo'];
        $total = $_POST['total'];
        $total = $cantidad*$costo;
        if(!empty($concepto) && !empty($opciones) && !empty($cantidad) && !empty($costo)){
            $consulta_insert = $conn->prepare('INSERT INTO costos(concepto,opciones,cantidad,costo,total) VALUES(:concepto,:opciones,:cantidad,:costo,:total)');
            $consulta_insert->execute(array(
                ':concepto' =>$concepto,
                ':opciones' =>$opciones,
                ':cantidad' =>$cantidad,
                ':costo' =>$costo,
                ':total' =>$total
            ));
            header('Location: index.php');
        }else{
            echo "<script>alert('Los campos estan vacios ');</script>";
        }

    }
    if(isset($_POST['guardarA'])){
        $concepto = $_POST['concepto'];
        $categoria = $_POST['categoria'];
        $costo = $_POST['costo'];
        $total = $_POST['total'];
        $total = $total+$costo;
        if(!empty($concepto) && !empty($categoria) && !empty($costo)){
            $consulta_insert = $conn->prepare('INSERT INTO activo(concepto,categoria,costo,total) VALUES(:concepto,:categoria,:costo,:total)');
            $consulta_insert->execute(array(
                ':concepto' =>$concepto,
                ':categoria' =>$categoria,
                ':costo' =>$costo,
                ':total' =>$total
            ));
            header('Location: index.php');
        }else{
            echo "<script>alert('Los campos estan vacios ');</script>";
        }

    }

    $sentencia_select=$conn->prepare('SELECT * FROM materiales');
    $sentencia_select->execute();
    $resultado=$sentencia_select->fetchAll();
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
            <Legend>Ingrese los Pasivos <span>Todos los campos son obligatorio</span> </Legend>
            <div class="campos">
                    <div class="campo">
                    <label for="">Elija el concepto</label>
                    <select name="concepto" required="required">
                            <option value="" disbled selected>Seleccione</option>
                            <?php foreach ($resultado as $concepto):?>
                                <option value="<?php echo $concepto ['nombre']?>"><?php echo $concepto ['nombre']?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="opciones">Unidad:</label>
                        <select name="opciones" required="required">
                            <option value="" disbled selected>Seleccione</option>
                            <option value="KG">Kilogramo</option>
                            <option value="Litro">Litro</option>
                            <option value="Pieza">Pieza</option>
    
                        </select>
                    </div>
                    <div class="campo">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number"  placeholder="Ingrese la cantidad" name="cantidad"  required="required">
                    </div>
                    <div class="campo">
                        <label for="costo">Costo:</label>
                        <input type="number" placeholder="Ingrese el costo" name="costo"  required="required">
                    </div>
                    
    </div>
        <div class="campo enviar">
                 <input type="submit" name="guardar" value="Añadir">
        </div>
        </form>
    </div>
    
    
    <div class="bg-amarillo contenedor sombra">
        
        <form id="materia2" action="" method="post">
            <Legend>Ingrese los Activos <span>Todos los campos son obligatorio</span> </Legend>
            <div class="campos">
                    <div class="campo">
                        <label for="concepto">Concepto:</label>
                        <input type="text" placeholder="Ingrese el activo"
                            name="concepto"  required="required"
                        >
                    </div>
                    <div class="campo">
                        <label for="opciones">Categoria:</label>
                        <select name="categoria" required="required">
                            <option value="" disabled selected>Seleccione</option>
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