<?php
require_once "conexion2.php";
$conexion = conexion();
$sql = "SELECT costo,fecha FROM activo";
$resultado = mysqli_query($conexion, $sql);
$valoresY = array();
$valoresX = array();

while ($ver = mysqli_fetch_row($resultado)) {
    $valoresY[] = $ver[0];
    $valoresX[] = $ver[1];
}
$datosX = json_encode($valoresX);
$datosY = json_encode($valoresY);

?>



<div id="graficaLineal"></div>

<script type="text/javascript">
    function crearCadenaLineal(json) {
        var parsed = JSON.parse(json);
        var arr = [];
        for (var x in parsed) {
            arr.push(parsed[x]);
        }
        return arr;
    }
</script>

<script type="text/javascript">
    datosX = crearCadenaLineal('<?php echo $datosX ?>');
    datosY = crearCadenaLineal('<?php echo $datosY ?>');
    var trace1 = {
        x: datosX,
        y: datosY,
        type: 'scatter'
    };

    var data = [trace1];
    Plotly.newPlot('graficaLineal', data);
</script>