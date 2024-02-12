<?php

session_start();

if(isset($_SESSION['info_filma'])) {
	$info_filma = $_SESSION['info_filma'];
  }
  
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "db_ElorrietaZinema";

    // Konexioa sortu
    $mysqli = new mysqli($servername, $username, $password, $db);

    // Konexioa egiaztatu
    if ($mysqli->connect_error) {
      die("Connection failed: " . $mysqli->connect_error);
    }

    $sql_zinema = "SELECT z.izena FROM zinema z JOIN saioa s USING (idZinema) JOIN filma f USING (idFilma) WHERE f.izena = '$info_filma' GROUP BY z.idZinema";
    //kontsulta egin db
    $result_zinema = $mysqli->query($sql_zinema);

    if(isset($_GET['zinema_aukera'])) {
        $zinemaSeleccionatua = $_GET['zinema_aukera'];
        echo "<h1>$zinemaSeleccionatua</h1>";
    }

  // Konexioa itxi
  $mysqli->close();


$data = "";

if(isset($_POST['data'])) {
  $data = $_POST['data'];
  echo $data;
}

$_SESSION['data'] = $data;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="../html/logoa/logoa_karratu.png">
    <title>Erosketa</title>
</head>
<body id="sarrerak_body">
<main>
    <div class="kutxa">
        <a href="../html/index.html"><img id="buelta" src="../html/irudiak/login/cross-svgrepo-com.svg" alt="buelta"></a>
        <h1>Erosketa</h1>
        <form id="erosketaForm" action="laburpena.php" method="POST"> 
            <label for="filma_aukera">Filma aukeraketa:</label><br>
            <input type="text" name="filma_aukera" id="filma_aukera" disabled value="<?php echo $info_filma; ?>"><br><br>

            <label for="zinema_aukera">Zinema aukeratu:</label><br>
            <select name="zinema_aukera" id="zinema_aukera">
            <?php
                if ($result_zinema && $result_zinema->num_rows > 0) {
                    while ($row = $result_zinema->fetch_assoc()) {
                        echo "<option value='" . $row['izena'] . "'>" . $row['izena'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No se encontraron zinemak</option>";
                }
            ?>
            </select><br><br>

            <label for="data_aukera">Aukeratu data:</label><br>
            <input type="date" name="data_aukera" id="data_aukera"><br><br>

            <label for="saioa_aukera">Aukeratu saioa:</label><br>
            <select name="saioa_aukera" id="saioa_aukera"></select><br><br>

            <input type="submit" id="jarraitu" name="jarraitu" value="Jarraitu" onclick="dataAukera()">
        </form>
    </div>
</main>
<script>
    function dataAukera() {
        var AukeraData = document.getElementById('data_aukera').value;

        var izkutuaInput = document.createElement('input');
        izkutuaInput.type = 'hidden';
        izkutuaInput.name = 'data'; 
        izkutuaInput.value = AukeraData;
        
        document.getElementById('erosketaForm').appendChild(izkutuaInput);

        document.getElementById('erosketaForm').submit();
    }

    var zinemaSelect = document.getElementById("zinema_aukera");
    zinemaSelect.addEventListener("change", function() {
    var zinemaSeleccionatua = this.value;

    var nuevaURL = `erosketak.php?zinema_aukera=${zinemaSeleccionatua}`;

    // Actualizar la URL sin recargar la página
    window.history.pushState({ path: nuevaURL }, '', nuevaURL);
});

</script>
</body>
</html>
