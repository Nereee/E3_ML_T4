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

if(isset($_SESSION['subtotala'])) {
  $subtotala = $_SESSION['subtotala'];
}

if(isset($_SESSION['koptotala'])) {
  $koptotala = $_SESSION['koptotala'];
}


$servername = "localhost";
$username = "root";
$password = "";
$db = "db_ElorrietaZinemaT4";

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


// AQUI VA EL INSEERT LUEGO

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
            <form action="laburpena.php" method="POST">
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
                    <p><strong>Sarrera kopuru:</strong> <?php echo $koptotala . " sarrera"; ?></p>
                    <p><strong>PVP:</strong> <?php echo $subtotala . "€"; ?></p>
										<p><strong>Deskontua:</strong> <span id="deskontuaValue"></span>€</p>
                </div>

                <br><br>

                <input type="submit" id="jarraitu" value="Baieztatu" onclick="window.location.href = '../html/index.html'">
            </form>
        </div>
    </main>
    <script>

		var kantitate = '<?php echo $koptotala; ?>';
		var subtotala = '<?php echo $subtotala; ?>';

		var deskontua = 0;
		var totala = 0;

		let deskontuBI = 0.2;
		let deskontuGEHIA = 0.3;

		if (kantitate == 2) {
			deskontua = subtotala * deskontuBI;
		}else if (kantitate > 2) {
			deskontua = subtotala * deskontuGEHIA;
		}

		totala = subtotala - deskontua;

		document.getElementById('deskontuaValue').textContent = totala;

    </script>
</body>
</html>
