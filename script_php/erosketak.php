<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db = "db_ElorrietaZinemaT4";

// Konexioa sortu
$mysqli = new mysqli($servername, $username, $password, $db);

// Konexioa egiaztatu
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

// Pelikularen izena berrezkuratu eta aldagai batean gorde.
if(isset($_SESSION['info_filma'])) {
	$info_filma = $_SESSION['info_filma'];
}

// ZINEMAREN IZENAK JAKITEKO KONTSULTA:
$sql_zinema = "SELECT z.izena 
                FROM zinema z 
                JOIN saioa s USING (idZinema) 
                JOIN filma f USING (idFilma) 
                WHERE f.izena = '$info_filma' 
                GROUP BY z.idZinema";
    
// Egin kontsulta eta emaitza gorde:
$result_zinema = $mysqli->query($sql_zinema);

// ZEIN SAIOAK DAUDEN JAKITEKO KONTSULTA, BAINA BAKARRIK ZINEMA AUKERATUTA BADAGO:
if(isset($_GET['zinemaIzena'])) {
    $zinemaIzena = $_GET['zinemaIzena'];  
    $sql_saioa = "SELECT s.ordua 
                    FROM saioa s 
                    JOIN zinema z USING (idZinema) 
                    JOIN filma f USING (idFilma) 
                    WHERE z.izena = '$zinemaIzena' AND f.izena = '$info_filma' 
                    GROUP BY s.ordua";

    // Egin kontsulta eta emaitza gorde:
    $result_saioa = $mysqli->query($sql_saioa);

    // Zinemaren izena gorde, beste orrialde batean erabiltzeko:
    $_SESSION['zinema'] = $zinemaIzena;
}

// URL barruan dagoen "Data" balioa hartu eta gorde. (Existitzen bada)
if(isset($_GET['dataAukera'])) {
    $data = $_GET['dataAukera']; 
    $_SESSION['data'] = $data;
}

// URL barruan dagoen "Saioa" balioa hartu eta gorde. (Existitzen bada)
if(isset($_GET['saioaAukera'])) {
    $saioa = $_GET['saioaAukera']; 
    $_SESSION['saioa'] = $saioa;
}

// Konexioa itxi
$mysqli->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="../html/logoa/logoa_karratu.png">
    <title>Erosketa</title>
    <style>
    select option {
        color: black;
    }
    </style>
</head>
<body id="sarrerak_body">
<main>
    <div class="kutxa">
        <a href="../index.html"><img id="buelta" src="../html/irudiak/login/cross-svgrepo-com.svg" alt="buelta"></a>
        <h1>Erosketa</h1>
        <form id="erosketaForm" action="erosketak.php" method="POST"> 
            <label for="filma_aukera">Filma aukeraketa:</label><br>
            <input type="text" name="filma_aukera" id="filma_aukera" disabled value="<?php echo $info_filma; ?>"><br><br>

            <label for="zinema_aukera">Zinema aukeratu:</label><br>
            <select name="zinema_aukera" id="zinema_aukera">
                <?php
                if ($result_zinema && $result_zinema->num_rows > 0) {
                    while ($row = $result_zinema->fetch_assoc()) {
                        echo "<option value='" . $row['izena'] . "'>" . $row['izena'] . "</option>";
                    }
                }
                ?>
            </select><br><br>

            <label for="data_aukera">Aukeratu data:</label><br>
            <input type="date" name="data_aukera" id="data_aukera" min=""><br><br>

            <label for="saioa_aukera">Aukeratu saioa:</label><br>
            <select name="saioa_aukera" id="saioa_aukera">
            <?php
                if ($result_saioa && $result_saioa->num_rows > 0) {
                    while ($row = $result_saioa->fetch_assoc()) {
                        echo "<option value='" . $row['ordua'] . "'>" . $row['ordua'] . "</option>";
                    }
                }
            ?>
            </select><br><br>
            <input type="button" id="jarraitu" name="jarraitu" value="Jarraitu" onclick="Bidali()">
        </form>
    </div>
</main>
<script>

    // DATA MINIMOA //
        var dataInput = document.getElementById('data_aukera');
        const gaurkoData = new Date().toISOString().split('T')[0];
        dataInput.min = gaurkoData;

    // ZINEMA AUKERAN PLACEHOLDER BAT SORTU //
    function ZinemarenPlaceholder() {
        var selectZinema = document.getElementById('zinema_aukera');

        // Option elementua sortzen du eta ezaugarri batzuk esartzen ditu.
        var AukeraIzkutua = document.createElement('option');
        AukeraIzkutua.value = '';
        AukeraIzkutua.text = 'AUKERATU ZINEMA';
        AukeraIzkutua.disabled = true;
        AukeraIzkutua.selected = true;

        // Option-a eta select-a elkartzen du.
        selectZinema.insertBefore(AukeraIzkutua, selectZinema.firstChild);
    }

    // DOM (HTML-eko elementu guztiak) kargatzen direnean funtzioa ejekutatuko da.
    document.addEventListener('DOMContentLoaded', ZinemarenPlaceholder);
    

    // ZINEMAREN ETA DATAREN BALIOAK HARTU ETA URL BARRUAN SARTU //

    // Select-eko aldaketa entzuten eta aztertzen du.
    document.getElementById("zinema_aukera").addEventListener("change", function() {
        // Goiko balorea aldagai batean gordetzen du. 
        var zinemaValue = this.value;
        // URL aldatzeko edo beste bat sortzeko Javascript URLSearchParams izeneko OBJETUA du, objetu hori URL
        // baten query string-arekin lan egiteko hainbat metodo eskaintzen ditu (Errezten du lana eta ez dugu hardkodeatzen)
        var URLparametroak = new URLSearchParams(window.location.search);
        // URL barruan atal bat dago non gordeko dugu balioa, non dagoen jakiteko hau beharrezkoa da.
        URLparametroak.set("zinemaIzena", zinemaValue); 
        // Eguneratzen du URL-a datu berriekin eta ez ditu berridazten.
        window.location.href = "?" + URLparametroak.toString();
    });

    // Berdin berdina egiten dugu "Data" informazioarekin.
    document.getElementById("data_aukera").addEventListener("change", function() {
        var dataValue = this.value;
        var URLparametroak = new URLSearchParams(window.location.search);
        URLparametroak.set("dataAukera", dataValue);
        window.location.href = "?" + URLparametroak.toString();
    });

    
    // AUKERAKETAK EZ GALDU ORRIALDEA KARGATZEN DENEAN //

    // Kode hau exekutatzen da orria erabat kargatzen denean (onload). Momentu horretan dagoen URLaren parametroak 
    // berreskuratzen ditu, eta elementuen balioak ezartzen (ez ezabatzeko) ditu, URLan egoten badaude.
    window.onload = function() {
    var urlParams = new URLSearchParams(window.location.search);
    var AukeraketaZinema = urlParams.get('zinemaIzena');
    if (AukeraketaZinema) {
        document.getElementById("zinema_aukera").value = AukeraketaZinema;
        // URL barruan SAIOA ez badago, saioaren balioa gordeko da.
        if (!urlParams.has('saioaAukera')) {
            var saioaValue = document.getElementById("saioa_aukera").value;
            var URLparametroak = new URLSearchParams(window.location.search);
            URLparametroak.set("saioaAukera", saioaValue);
            window.location.href = "?" + URLparametroak.toString();
        }
    }

    var AukeraketaData = urlParams.get('dataAukera');
    if (AukeraketaData) {
        document.getElementById("data_aukera").value = AukeraketaData;
    }

    var AukeraketaSaioa = urlParams.get('saioaAukera');
    if (AukeraketaSaioa) {
        document.getElementById("saioa_aukera").value = AukeraketaSaioa;
    }
};

// BESTE WEBGUNERA JOAN //

function Bidali() {
    // Balioak berrezkuratu eta gorde.
    var zinemaValue = document.getElementById("zinema_aukera").value;
    var dataValue = document.getElementById("data_aukera").value;
    var saioaValue = document.getElementById("saioa_aukera").value;

    // Egiaztu INPUT-ak balioak badauzkate.
    if (zinemaValue && dataValue && saioaValue) {
        // Laburpen orriara aldatu.
        window.location.href = "laburpena.php";
    } else {
        // Input bat datu barik badago, alert pantaila.
        alert("Eremu guztiak bete behar dira");
    }
}
</script>
</body>
</html>
