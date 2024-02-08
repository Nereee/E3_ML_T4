<?php
session_start();

if(isset($_SESSION['info_filma'])) {
  $info_filma = $_SESSION['info_filma'];
}

if(isset($_SESSION['data'])) {
  $data = $_SESSION['data'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="../html/logoa/logoa.png">
    <title>Erosketa Laburpena</title>
</head>
<body id="sarrerak_body">
    <main>
        <div class="kutxa">
            <a href="../html/index.html">
                <img id="buelta" src="../html/irudiak/login/cross-svgrepo-com.svg" alt="buelta">
            </a>
            <h1>Laburpena</h1>
            <form action="get">

                <!-- Agregar datos de compra aquí -->
                <div id="laburpena">
                    <p><strong>Pelíkula:</strong> <?php echo $info_filma; ?></p>
                    <p><strong>Data:</strong> <?php echo $data; ?></p>
                    <p><strong>Zinema:</strong> <?php echo $_GET['cine'] ?? 'Nombre del Cine'; ?></p>
                    <p><strong>Sarrera kopuru:</strong> <?php echo $_GET['cantidad_entradas'] ?? 0; ?></p>
                    <p><strong>PVP:</strong> <?php echo $_GET['pvp'] ?? 0; ?></p>
                    <p><strong>Deskontua:</strong> <?php echo $_GET['descuento'] ?? 0; ?>%</p>
                </div>

                <br><br>

                <input type="button" id="jarraitu" value="Baieztatu" onclick="window.location.href = '../html/index.html'">
            </form>
        </div>
    </main>
    <script>
      data_aukera.min = new Date().toLocaleDateString('fr-ca');
    </script>
</body>
</html>
