<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php
    $link = mysqli_connect('localhost', 'root', '');
    if ($link) {
        mysqli_select_db($link, "panaderia");
        mysqli_query($link, "SET NAMES 'utf8'");
    }
    $f1 = $_POST['f1'];
    $f2 = $_POST['f2'];

    ?>
    <title>Document</title>
</head>

<body>
    <form method="POST" action="consulta_fechas.php">
        <input type="date" name="f1" require>
        <input type="date" name="f2" require>
        <input type="submit">
    </form>
    </br>
    Inicio : <?php echo $f1 ?> - Fin <?php echo $f2 ?> </br> </br> </br> </br>
    <?php
    $v = mysqli_query($link, "SELECT * FROM costos WHERE fecha BETWEEN '$f1' AND '$f2'");
    while ($costos = mysqli_fetch_row($v)) {
    ?>
        <?php echo $costos[0] ?> - <?php echo $costos[1] ?> - <?php echo $costos[2] ?> - <?php echo $costos[3] ?> - <?php echo $costos[4] ?>- <?php echo $costos[5] ?>- <?php echo $costos[6] ?> </br> </br>
    <?php } ?>
</body>

</html>