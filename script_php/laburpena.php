<?php
session_start();

if(isset($_SESSION['info_filma'])) {
  $info_filma = $_SESSION['info_filma'];
}

if(isset($_SESSION['zinema'])) {
  $zinema = $_SESSION['zinema'];
}

if(isset($_SESSION['data'])) {
  $data = $_SESSION['data'];
}

if(isset($_SESSION['saioa'])) {
  $saioa = $_SESSION['saioa'];
}

$servername = "localhost";
$username = "root";
$password = "";
$db = "db_ElorrietaZinema";

$mysqli = new mysqli($servername, $username, $password, $db);

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

$sql_aretoa = "SELECT a.izena
                FROM aretoa a 
                JOIN saioa s USING (idAretoa) 
                JOIN zinema z ON s.idZinema = z.idZinema 
                JOIN filma f USING (idFilma) 
                WHERE s.ordua = '$saioa' AND s.eguna = '$data' AND z.izena = '$zinema' AND f.izena = '$info_filma'
                group by s.eguna";

$result_aretoa = $mysqli->query($sql_aretoa);

$mysqli->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="../html/logoa/logoa_karratu.png">
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
                <div id="laburpena">
                    <p><strong>Pelíkula:</strong> <?php echo $info_filma; ?></p>
                    <p><strong>Data:</strong> <?php echo $data; ?></p>
                    <p><strong>Zinema:</strong> <?php echo $zinema; ?></p>
                    <p><strong>Saioa:</strong> <?php echo $saioa; ?></p>
                    <p><strong>Aretoa:</strong>
                    <?php
                    if ($result_aretoa) {
                      if ($result_aretoa->num_rows > 0) {
                          while ($row = $result_aretoa->fetch_assoc()) {
                              echo $row['izena'] . " Aretoa";
                          }
                      }
                    }
                    ?></p>
                    <p><strong>Sarrera kopuru:</strong></p>
                    <p><strong>PVP:</strong></p>
                    <p><strong>Deskontua:</strong></p>
                </div>

                <br><br>

                <input type="button" id="jarraitu" value="Baieztatu" onclick="window.location.href = '../html/index.html'">
            </form>
        </div>
    </main>
    <script>
    </script>
</body>
</html>
