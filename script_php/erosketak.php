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

    //Kontsulta
    $erabiltzailea = $_POST["erabiltzailea"];
    $pwd = $_POST["pasahitza"]; 

    $sql = "SELECT izena from zinema join saioa ";
    //kontsulta egin db
    $result = $mysqli->query($sql);

    if ($result && $result->num_rows > 0) {
      // Iniciar sesión y redirigir al usuario a la página de inicio
      $_SESSION['erabiltzailea'] =  $erabiltzailea;
      header("Location: sarrerak.php");
      exit;
    } else {
      // Mostrar un mensaje de error si la autenticación falla
      echo "'Pasahitza edo erabiltzailea ez dira zuzenak'";
    }

  // Konexioa itxi
  $mysqli->close();


$data = "";

if(isset($_POST['data'])) {
  $data = $_POST['data'];
  echo $data;
}

$_SESSION['zinema'];
$_SESSION['data'] = $data;
$_SESSION['saioa'];

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
        <form id="erosketaForm" action="laburpena.php" method="POST"> 
            <label for="filma_aukera">Filma aukeraketa:</label><br>
            <input type="text" name="filma_aukera" id="filma_aukera" disabled value="<?php echo $info_filma; ?>"><br><br>

            <label for="zinema_aukera">Zinema aukeratu:</label><br>
            <select name="zinema_aukera" id="zinema_aukera"></select><br><br>

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
</script>
</body>
</html>
