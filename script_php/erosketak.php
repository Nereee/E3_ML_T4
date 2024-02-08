<?php

session_start();

// procesar.php

$data = "";

if(isset($_POST['data'])) {
  $data = $_POST['data'];
  echo $data;
} else {
  echo "No se recibió ninguna fecha.";
}

$_SESSION['zinema'];
$_SESSION['data'] = $data;
$_SESSION['saioa'];

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
    <link rel="shortcut icon" href="../html/logoa/logoa.png">
    <title>Erosketa</title>
</head>
<body id="sarrerak_body">
<main>
    <div class="kutxa">
        <a href="../html/index.html"><img id="buelta" src="../html/irudiak/login/cross-svgrepo-com.svg" alt="buelta"></a>
        <h1>Erosketa</h1>
        <form id="erosketaForm" action="laburpena.php" method="POST"> <!-- Cambiado 'get' a 'laburpena.php' y añadido 'method="POST"' -->
            <label for="filma_aukera">Filma aukeraketa:</label><br>
            <input type="text" name="filma_aukera" id="filma_aukera" disabled value="<?php echo $info_filma; ?>"><br><br>

            <label for="zinema_aukera">Zinema aukeratu:</label><br>
            <select name="zinema_aukera" id="zinema_aukera"></select><br><br>

            <label for="data_aukera">Aukeratu data:</label><br>
            <input type="date" name="data_aukera" id="data_aukera"><br><br>

            <label for="saioa_aukera">Aukeratu saioa:</label><br>
            <select name="saioa_aukera" id="saioa_aukera"></select><br><br>

            <input type="submit" id="jarraitu" name="jarraitu" value="Jarraitu"> <!-- Cambiado type a "submit" -->
        </form>
    </div>
</main>
<script>
    document.getElementById('erosketaForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir que el formulario se envíe normalmente

        // Obtener el valor de la fecha seleccionada
        var fechaSeleccionada = document.getElementById('data_aukera').value;

        // Crear un campo oculto en el formulario para enviar la fecha al servidor
        var hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'data'; // Nombre del campo que recibirá el valor en PHP
        hiddenInput.value = fechaSeleccionada;
        this.appendChild(hiddenInput);

        // Enviar el formulario
        this.submit();
    });
</script>
</body>
</html>
