<?php
    include_once 'conexion.php';

    $sentencia_select=$conn->prepare('SELECT * FROM costos ORDER BY id DESC');
    $sentencia_select->execute();
    $resultado=$sentencia_select->fetchAll();

    $sentencia_select=$conn->prepare('SELECT * FROM activo ORDER BY id DESC');
    $sentencia_select->execute();
    $resultadoA=$sentencia_select->fetchAll();

    //buscar
    if(isset($_POST['btn_buscar'])){
        $buscar_text=$_POST['buscar'];
        $select_buscar=$conn->prepare('SELECT * FROM costos WHERE concepto LIKE :campo OR id Like :campo;');
        $select_buscar->execute(array(
            ':campo' => "%".$buscar_text."%"
        ));
        $resultado=$select_buscar->fetchAll();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/86b7a86e90.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilos.css">
    <title>Inicio</title>
</head>
<body>
 <div class="contenedor-barra">
        <h1>Formulario</h1>
    </div>
    <div class="bg-amarillo contenedor sombra">

        <form id="materia" action="" method="post">
            <Legend>Lista de Gastos<span>Ingrese un valor para buscar</span> </Legend>
            <div class="campos">
                    <div class="campo">
                        <label for="buscar"></label>
                        <input type="text" placeholder="Buscar" id="concepto"
                            name="buscar"  required="required"
                        >
                        <div class="campo enviar">
                        <input type="submit" value="Buscar" name="btn_buscar">
                        </div>
                    </div>
                    
            </div>
        
            <div class="navs">
                            <nav class="navegacion">
                             <a href="insert.php">Nuevo <i class="fas fa-plus-square"></i></a>
                        </nav>
                        
                        </div>
        </form>
    </div>
    <div class="bg-azul contenedor sombra datos">
        <div class="contenedor-datos">
            <h2>Pasivos</h2>
        
            <div class="contenedor-tabla">
                <table id="listado-costos" class="listado-costos">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Concepto</th>
                                <th>Unidad</th>
                                <th>Cantidad</th>
                                <th>Costo</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th colspan="2">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            
                            <?php foreach($resultado as $fila):?>
                                <tr>
                                <td><?php echo $fila['id'];?></td>
                                <td><?php echo $fila['concepto'];?></td>
                                <td><?php echo $fila['opciones'];?></td>
                                <td><?php echo $fila['cantidad'];?></td>
                                <td><?php echo $fila['costo'];?></td>
                                <td><?php echo $fila['fecha'];?></td>
                                <td class="total_p"><?php echo $fila['total'];?></td>
                                <td><a href="update.php?id=<?php echo $fila['id'];?>"><i class="far fa-edit"></i></a></td>
                                <td><a href="borrar.php?id=<?php echo $fila['id'];?>"><i class="fas fa-trash-alt"></i></a></td>
                                </tr>
                            <?php endforeach ?>
                            
                        </tbody>
                        <div class="navs">
                            <nav class="navegacion">
                             <a href="reporte.php" target="_blank">Generar Reporte</a>
                        </nav>
                </table>
                <div class="totales">
                              <label for="T">Total:</label>
                               <input type="text" id="Totales">
                            </div>
            </div>
        </div>
        
    </div>
    <div class="bg-azul contenedor sombra datos">
        <div class="contenedor-datos">
            <h2>Activos</h2>
        
            <div class="contenedor-tabla">
                <table id="listado-costos" class="listado-costos">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Concepto</th>
                                <th>Categoria</th>
                                <th>Costo</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th colspan="2">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            
                            <?php foreach($resultadoA as $fila):?>
                                <tr>
                                <td><?php echo $fila['id'];?></td>
                                <td><?php echo $fila['concepto'];?></td>
                                <td><?php echo $fila['categoria'];?></td>
                                <td><?php echo $fila['costo'];?></td>
                                <td><?php echo $fila['fecha'];?></td>
                                <td class="total_p"><?php echo $fila['total'];?></td>
                                <td><a href="update.php?id=<?php echo $fila['id'];?>"><i class="far fa-edit"></i></a></td>
                                <td><a href="borrar.php?id=<?php echo $fila['id'];?>"><i class="fas fa-trash-alt"></i></a></td>
                                </tr>
                            <?php endforeach ?>
                            
                        </tbody>
                        <div class="navs">
                            <nav class="navegacion">
                             <a href="reporte.php" target="_blank">Generar Reporte</a>
                        </nav>
                </table>
                <div class="totales">
                              <label for="T">Total:</label>
                               <input type="text" id="Totales">
                            </div>
            </div>
        </div>
  <script src="javascript.js"></script>
</body>
</html>