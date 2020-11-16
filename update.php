<?php
include_once 'conexion.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $buscar_id = $conn->prepare('SELECT * FROM costos WHERE id=:id LIMIT 1');
    $buscar_id->execute(array(
        ':id' => $id
    ));
    $resultado = $buscar_id->fetch();
} else {
    header('Location: index.php');
}

if (isset($_POST['btn_update'])) {
    $concepto = $_POST['concepto'];
    $opciones = $_POST['opciones'];
    $cantidad = $_POST['cantidad'];
    $costo = $_POST['costo'];
    $total = $_POST['total'];
    $total = $cantidad * $costo;
    if (!empty($concepto) && !empty($opciones) && !empty($cantidad) && !empty($costo)) {
        $consulta_update = $conn->prepare('UPDATE costos SET concepto=:concepto,opciones=:opciones,cantidad=:cantidad,costo=:costo,total=:total WHERE id=:id;');
        $consulta_update->execute(array(
            ':concepto' => $concepto,
            ':opciones' => $opciones,
            ':cantidad' => $cantidad,
            ':costo' => $costo,
            ':total' => $total,
            ':id' => $id
        ));
        header('Location: index.php');
    } else {
        echo "<script>alert('Los campos estan vacios ');</script>";
    }
}

//Activos

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $buscar_id = $conn->prepare('SELECT * FROM activo WHERE id=:id LIMIT 1');
    $buscar_id->execute(array(
        ':id' => $id
    ));
    $resultadoA = $buscar_id->fetch();
} else {
    header('Location: index.php');
}

if (isset($_POST['btn_updateA'])) {
    $concepto = $_POST['concepto'];
    $categoria = $_POST['categoria'];
    $costo = $_POST['costo'];

    if (!empty($concepto) && !empty($categoria) && !empty($costo)) {
        $consulta_update = $conn->prepare('UPDATE activo SET concepto=:concepto,categoria=:categoria,costo=:costo WHERE id=:id;');
        $consulta_update->execute(array(
            ':concepto' => $concepto,
            ':categoria' => $categoria,
            ':costo' => $costo,
            ':id' => $id
        ));
        header('Location: index.php');
    } else {
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
    <title>Editar</title>
</head>

<body>
    <div class="contenedor-barra navegacion">
        <nav>
            <a href="index.php">Volver</a>
        </nav>
        <h1>Formulario</h1>
    </div>

    <div class="bg-amarillo contenedor sombra">

        <form id="materia" action="" method="post">
            <Legend>Ingrese los Datos <span>Todos los campos son obligatorio</span> </Legend>
            <div class="campos">
                <div class="campo">
                    <label for="concepto">Concepto:</label>
                    <input type="text" value="<?php if ($resultado) echo $resultado['concepto']; ?>" name="concepto" required="required">
                </div>
                <div class="campo">
                    <label for="opciones">Unidad:</label>
                    <select name="opciones" required="required" value="<?php if ($resultado) echo $resultado['opciones']; ?>">
                        <option value="" disbled selected>Seleccione</option>
                        <option value="KG">Kilogramo</option>
                        <option value="Litro">Litro</option>
                        <option value="Pieza">Pieza</option>

                    </select>
                </div>
                <div class="campo">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" value="<?php if ($resultado) echo $resultado['cantidad']; ?>" name="cantidad" required="required">
                </div>
                <div class="campo">
                    <label for="costo">Costo:</label>
                    <input type="number" value="<?php if ($resultado) echo $resultado['costo']; ?>" name="costo" required="required">
                </div>


            </div>
            <div class="campo enviar">
                <input type="submit" name="btn_update" value="Editar">
            </div>
        </form>
    </div>


    <div class="bg-amarillo contenedor sombra">

        <form id="materia" action="" method="post">
            <Legend>Ingrese los Datos <span>Todos los campos son obligatorio</span> </Legend>
            <div class="campos">
                <div class="campo">
                    <label for="concepto">Concepto:</label>
                    <input type="text" value="<?php if ($resultadoA) echo $resultadoA['concepto']; ?>" name="concepto" required="required">
                </div>
                <div class="campo">
                    <label for="opciones">Categoria:</label>
                    <select name="categoria" required="required" value="<?php if ($categoria) echo $resultadoA['categoria']; ?>">
                        <option value="" disbled selected>Seleccione</option>
                        <option value="Activo Circulante">Activo Circulante</option>
                        <option value="Activo Fijo">Activo Fijo</option>

                    </select>
                </div>
                <div class="campo">
                    <label for="costo">Costo:</label>
                    <input type="number" value="<?php if ($resultadoA) echo $resultadoA['costo']; ?>" name="costo" required="required">
                </div>


            </div>
            <div class="campo enviar">
                <input type="submit" name="btn_updateA" value="Editar">
            </div>
        </form>
    </div>

</body>

</html>