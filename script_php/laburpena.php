<?php
session_start();

// DATUAK KARGATU

// FILMEN IZENA ETA ZINEMAREN IZENA
if(isset($_SESSION['info_filma']) && isset($_SESSION['zinema'])) {
  $info_filma = $_SESSION['info_filma'];
  $zinema = $_SESSION['zinema'];
}

// DATA INFORMAZIOA ETA SAIOA (ORDUA)
if(isset($_SESSION['data']) && isset($_SESSION['saioa'])) {
  $data = $_SESSION['data'];
  $saioa = $_SESSION['saioa'];
}

// SUBTOTALA ETA SARREREN GUZTIEN KOPURUA LORTU
if(isset($_SESSION['subtotala']) && isset($_SESSION['koptotala'])) {
  $subtotala = $_SESSION['subtotala'];
  $koptotala = $_SESSION['koptotala'];
}

// SARRERA BAKOITZAREN KOPURUA
if(isset($_SESSION['normal_mota']) && isset($_SESSION['gaztea_mota']) && isset($_SESSION['jubilatu_mota'])) {
  $normalKop = $_SESSION['normal_mota'];
  $gazteKop = $_SESSION['gaztea_mota'];
  $jubilatuKop = $_SESSION['jubilatu_mota'];
}

// DATUAK KARGATU

// MYSQL KONTSULTAK

$servername = "localhost";
$username = "root";
$password = "";
$db = "db_ElorrietaZinemaT4";

$mysqli = new mysqli($servername, $username, $password, $db);

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

// ID-AK LORTU

// idBezero

if(isset($_SESSION['erabiltzailea'])) {
  $erabiltzailea = $_SESSION['erabiltzailea'];

  $sql_idBezero = "SELECT idBezero 
  FROM bezeroa
  WHERE erabiltzailea = '$erabiltzailea'";

  $result_idBezero = $mysqli->query($sql_idBezero);

  if ($result_idBezero && $result_idBezero->num_rows > 0) {
  $row = $result_idBezero->fetch_assoc();
  $idBezero = $row['idBezero'];
  }
}

//idBezero

// IdFilma

$sql_idFilma = "SELECT idFilma
                  FROM filma
                  WHERE izena = '$info_filma'";

$result_idFilma = $mysqli->query($sql_idFilma);

  if ($result_idFilma && $result_idFilma->num_rows > 0) {
    $row = $result_idFilma->fetch_assoc();
    $idFilma = $row['idFilma'];
  }

// IdFilma

// idZinema

$sql_idZinema = "SELECT idZinema
                  FROM zinema
                  WHERE izena = '$zinema'";

$result_idZinema = $mysqli->query($sql_idZinema);

  if ($result_idZinema && $result_idZinema->num_rows > 0) {
    $row = $result_idZinema->fetch_assoc();
    $idZinema = $row['idZinema'];
  }

// idZinema

// idSaioa

$sql_idSaioa = "SELECT idSaioa 
                  FROM saioa
                  WHERE idFilma = '$idFilma' AND idZinema = '$idZinema' AND eguna = '$data' AND ordua = '$saioa'";

$result_idSaioa = $mysqli->query($sql_idSaioa);

if ($result_idSaioa && $result_idSaioa->num_rows > 0) {
$row = $result_idSaioa->fetch_assoc();
$idSaioa = $row['idSaioa'];
}

// idSaioa

// ARETO INFORMAZIOA 

$sql_aretoa = "SELECT izena 
                FROM aretoa 
                WHERE idZinema = '$idZinema' 
                AND idAretoa = (SELECT idAretoa FROM saioa WHERE idSaioa = '$idSaioa') 
                GROUP BY idAretoa";

$result_aretoa = $mysqli->query($sql_aretoa);

if ($result_aretoa && $result_aretoa->num_rows > 0) {
  $row = $result_aretoa->fetch_assoc();
  $areto_info = $row['izena'];
}

//idAretoa

$sql_idAretoa = "SELECT idAretoa
                  FROM aretoa
                  WHERE izena = '$areto_info'";

$result_idAretoa = $mysqli->query($sql_idAretoa);

  if ($result_idAretoa && $result_idAretoa->num_rows > 0) {
    $row = $result_idAretoa->fetch_assoc();
    $idAretoa = $row['idAretoa'];
  }

//IdAretoa

// ARETO INFORMAZIOA 

if(isset($_POST['guztira_info']) && isset($_POST['deskontu_info'])) {
  $guztira = $_POST['guztira_info'];
  $deskontua = $_POST['deskontu_info'];


  if ($gazteKop > 0 || $jubilatuKop > 0) {
    $sql_insert = "INSERT INTO EROSKETA ( eguna, deskontua, diru_totala, idMota, idBezero, jatorria)
    VALUES
    ( '$data', '$deskontua', '$guztira', 4, '$idBezero',	'Online' )";
  }else {
    $sql_insert = "INSERT INTO EROSKETA ( eguna, deskontua, diru_totala, idMota, idBezero, jatorria)
    VALUES
    ( '$data', '$deskontua', '$guztira', 1, '$idBezero',	'Online' )";
  }

  if ($mysqli->query($sql_insert) === TRUE) {
    $idErosketa = $mysqli->insert_id;

    $sql_insert_sarrera = "INSERT INTO SARRERA (idErosketa, idSaioa, sarreraKant)
                            VALUES
                            ('$idErosketa', '$idSaioa', '$koptotala')";

    if ($mysqli->query($sql_insert_sarrera) == TRUE) {
      echo "<script>
        alert('Zure datuak ondo gorde dira. :D');
        window.location.href = '../index.html';
      </script>";
    }
  }
}

$mysqli->close();

// MYSQL KONTSULTAK

?>

<!DOCTYPE html>
<html lang="eu">
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
            <a href="../index.html">
                <img id="buelta" src="../html/irudiak/login/cross-svgrepo-com.svg" alt="buelta">
            </a>
            <h1>Laburpena</h1>
            <form action="laburpena.php" method="POST">
                <div id="laburpena">
                    <label for="filma_info">Filma:</label> <br>
                    <input class="lbp_kutxa" type="text" name="filma_info" id="filma_info" disabled> <br>

                    <label for="zinema_info">Zinema:</label> <br>
                    <input class="lbp_kutxa" type="text" name="zinema_info" id="zinema_info" disabled> <br>

                    <label for="data_info">Data:</label> <br>
                    <input class="lbp_kutxa" type="text" name="data_info" id="data_info" disabled> <br>

                    <label for="saioa_info">Saioa:</label> <br>
                    <input class="lbp_kutxa" type="text" name="saioa_info" id="saioa_info" disabled> <br>

                    <label for="areto_info">Aretoa:</label> <br>
                    <input class="lbp_kutxa" type="text" name="areto_info" id="areto_info" disabled> <br>

                    <label for="sarrera_info">Sarrera kopuru:</label> <br>
                    <input class="lbp_kutxa" type="text" name="sarrera_info" id="sarrera_info" disabled> <br>

                    <label for="subtotala_info">Subtotala: (€)</label> <br>
                    <input class="lbp_kutxa" type="text" name="subtotala_info" id="subtotala_info" disabled> <br>

                    <label for="deskontu_info">Zenbat deskontu: (€)</label> <br>
                    <input class="lbp_kutxa" type="text" name="deskontu_info" id="deskontu_info" disabled>  <br>

                    <label for="guztira_info">Ordaintzeko guztira: (€)</label> <br>
                    <input class="lbp_kutxa" type="text" name="guztira_info" id="guztira_info" disabled>  
                </div><br>
                <input type="submit" id="jarraitu" value="Baieztatu">
            </form>
        </div>
    </main>
    <script>

		var kantitate = "<?php echo $koptotala; ?>";
		var subtotala = "<?php echo $subtotala; ?>";

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

    document.getElementById('filma_info').value = "<?php echo $info_filma ?>";
    document.getElementById('zinema_info').value = "<?php echo $zinema ?>";
    document.getElementById('data_info').value = "<?php echo $data ?>";
    document.getElementById('saioa_info').value = "<?php echo $saioa ?>";
    document.getElementById('areto_info').value = "<?php echo $areto_info; ?>" + " Aretoa";
    document.getElementById('sarrera_info').value = kantitate + " sarrerak";
    document.getElementById('subtotala_info').value = subtotala;
    document.getElementById('deskontu_info').value = deskontua.toFixed(2);
    document.getElementById('guztira_info').value = totala.toFixed(2);

    document.getElementById("jarraitu").addEventListener("click", function() {
		  document.getElementById("deskontu_info").disabled = false;
    	document.getElementById("guztira_info").disabled = false;
	});

    </script>
</body>
</html>
