<?php
session_start();

if(isset($_SESSION['info_filma'])) {
  $info_filma = $_SESSION['info_filma'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="logoa/logoa.png">
    <title>Erosketa</title>
</head>
<body id="sarrerak_body">
    <main>
        <div class="kutxa">
            <a href="../html/index.html">
                <img id="buelta" src="../html/irudiak/login/cross-svgrepo-com.svg" alt="buelta">
            </a>
            <h1>Erosketa</h1>
            <form action="get">

                <label for="filma_aukera">Filma aukeraketa:</label> <br>
                <input type="text" name="filma_aukera" id="filma_aukera" disabled value="<?php echo $info_filma; ?>">
                <!-- Agregar datos de compra aquí -->
                <label for="laburpena">Laburpena:</label> <br>
                <div id="laburpena">
                    <p><strong>Película:</strong> <?php echo $_GET['pelicula'] ?? 'Nombre de la Película'; ?></p>
                    <p><strong>Fecha:</strong> <?php echo $_GET['fecha'] ?? 'Fecha de la función'; ?></p>
                    <p><strong>Cine:</strong> <?php echo $_GET['cine'] ?? 'Nombre del Cine'; ?></p>
                    <p><strong>Cantidad de Entradas:</strong> <?php echo $_GET['cantidad_entradas'] ?? 0; ?></p>
                    <p><strong>PVP:</strong> <?php echo $_GET['pvp'] ?? 0; ?></p>
                    <p><strong>Descuento:</strong> <?php echo $_GET['descuento'] ?? 0; ?>%</p>
                </div>

                <br><br>

                <label for="zinema_aukera">Zinema aukeratu:</label> <br>
                <select name="zinema_aukera" id="zinema_aukera">
                    <!-- Opciones del select -->
                </select>

                <br><br>

                <label for="data_aukera">Aukeratu data:</label> <br>
                <input type="date" name="data_aukera" id="data_aukera">

                <br><br>

                <label for="saioa_aukera">Aukeratu saioa:</label> <br>
                <select name="saioa_aukera" id="saioa_aukera">
                    <!-- Opciones del select -->
                </select>

                <br><br>

                <input type="button" id="jarraitu" value="Jarraitu">
            </form>
        </div>
    </main>
    <script>
      data_aukera.min = new Date().toLocaleDateString('fr-ca')
    </script>
</body>
</html>
