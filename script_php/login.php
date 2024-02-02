<?php

if(isset($_GET['izena'])&&($_GET['pasahitza'])){
	
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

$izena = $_GET["izena"];
$pwd = $_GET["pasahitza"]; 
$sql = "select id from t_erabiltzaile where izena = '$izena' and pasahitza = '$pwd'";
//kontsulta egin db
$result = $mysqli->query($sql);

if($result->num_rows > 0){
    header("Location: sarrerak.php");
    // abriri sarrerak
}else{
    echo "Pasahitza edo erabiltzailea ez dira zuzenak";
}



// Konexioa itxi
$mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/login.css" />
    <link rel="shortcut icon" href="../html/logoa/logoa.png" />
    <title>PHIM Zinemak</title>
  </head>
  <body>
    <main>
      <div class="kutxa">
        <a href="index.html"
          ><img
            id="buelta"
            src="../html/irudiak/login/cross-svgrepo-com.svg"
            alt="buelta"
        /></a>
        <h1>Login</h1>
        <form id="userform" action="">
          <div class="userkutxa">
            <img
              src="../html/irudiak/login/profile-svgrepo-com.svg"
              alt="erabiltzailea"
            />
            <label for="erabiltzailea">Erabiltzailea</label> <br />
          </div>
          <input type="text" id="erabiltzailea" name="erabiltzailea" /> <br />
          <div class="userkutxa">
            <img
              src="../html/irudiak/login/padlock-svgrepo-com.svg"
              alt="pasahitza"
            />
            <label for="pasahitza">Pasahitza</label> <br />
          </div>
          <input type="password" id="pasahitza" name="pasahitza" />
        </form>
        <input id="jarraitu" type="button" value="Jarraitu" onclick="window.location.href = 'sarrerak.php'">
      </div>
    </main>
  </body>
</html>
