<?php

require_once "../conexion2.php";
$conexion = conexion();

$sql = "SELECT concepto,costo from activo";
$result = mysqli_query($conexion, $sql);

$valoresY = array();
$valoresX = array();

while ($ver = mysqli_fetch_row($result)) {
    $valoresY[] = $ver[1]; //monto
    $valoresX[] = $ver[0]; //fecha
}

$datosX = json_encode($valoresX);
$datosY = json_encode($valoresY);
?>

<div id="graficaBarras"></div>

<script type="text/javascript">
    function crearCadenaBarras(json) {
        var parsed = JSON.parse(json);
        var arr = [];
        for (var x in parsed) {
            arr.push(parsed[x]);
        }
        return arr;
    }
</script>

<script type="text/javascript">
    datosX = crearCadenaBarras('<?php echo $datosX; ?>');
    datosY = crearCadenaBarras('<?php echo $datosY; ?>');
    var data = [{
        x: datosX,
        y: datosY,
        type: 'bar',
        marker: {
            color: 'red'
        }
    }];


    var layout = {
        title: 'Grafica de Activos',
        font: {
            family: 'Raleway, sans-serif'
        },
        xaxis: {
            tickangle: -45,
            title: 'Conceptos'
        },
        yaxis: {
            title: '$$ Montos'
        },
        bargap: 0.05
    };

    Plotly.newPlot('graficaBarras', data, layout);
</script>