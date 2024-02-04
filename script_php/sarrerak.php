<?php

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/media.css" />
    <link rel="shortcut icon" href="../html/logoa/logoa_karratu.png" />
    <title>PHIM Zinemak</title>
  </head>
  <body>
    <nav>
      <div class="logo">
        <img src="../html/logoa/logoa.png" alt="Logo" />
      </div>
      <div class="menu-toggle" id="mobile-menu" onclick="MenuAldaketa()">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>
      <div class="menu" id="menu">
        <a href="../html/index.html">Hasiera</a>
        <a href="../html/filma_guztiak.html">Filmak</a>
        <a href="../html/norgara.html">Informazioa</a>
        <a href="../html/eskaintzak.html">Eskaintzak</a>
      </div>
      <script>
        function MenuAldaketa() {
          document.getElementById("menu").classList.toggle("active");
          document.getElementById("mobile-menu").classList.toggle("active");
        }
      </script>
    </nav>
	<main>
        <div id="zentratu">
            <div id="sarrera_kutxa">
                <h2>Hautatu sarrera mota:</h2>
                <hr>
                <form action="">
                    <div id="sarrerak">
                        <div id="normala" class="mota">
                            <label for="normal_mota">Tartalo (Ohiko sarrera) (8.90€)</label>
                            <div class="kantitate_kutxa">
                                <input type="number" name="normal_mota" id="normal_mota" value="0" disabled>
                                <div class="kant_botoiak">
                                  <input type="button" value="-" class="kenduBTN" onclick="kendu(document.getElementById('normal_mota'))">
                                  <input type="button" value="+" class="gehituBTN" onclick="gehitu(document.getElementById('normal_mota'))">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div id="gaztea" class="mota">
                            <label for="gaztea_mota">Galtzagorri (Gazteen Sarrera) (6.90€)</label>
                            <div class="kantitate_kutxa">
                                <input type="number" name="gaztea_mota" id="gaztea_mota" value="0" disabled>
                                <div class="kant_botoiak">
                                  <input type="button" value="-" class="kenduBTN" onclick="kendu(document.getElementById('gaztea_mota'))">
                                  <input type="button" value="+" class="gehituBTN" onclick="gehitu(document.getElementById('gaztea_mota'))">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div id="jubilatua" class="mota">
                            <label for="jubilatu_mota">Basajaun (+65 Sarrera) (6.90€)</label>
                            <div class="kantitate_kutxa">
                                <input type="number" name="jubilatu_mota" id="jubilatu_mota" value="0" disabled>
                                <div class="kant_botoiak">
                                  <input type="button" value="-" class="kenduBTN" onclick="kendu(document.getElementById('jubilatu_mota'))">
                                  <input type="button" value="+" class="gehituBTN" onclick="gehitu(document.getElementById('jubilatu_mota'))">
                                </div>
                            </div>
                        </div>
                        <div id="espazioa">
                            <h1>a</h1><h1>a</h1><h1>a</h1>
                        </div>
						<div id="totala">
							<div id="totala_kutxa">
								<label for="subtotala" id="subtotala_label"><b>Subtotala:</b></label>
								<input type="number" name="subtotala" id="subtotala" value="0.00" disabled>
							</div>
							<div id="botoiak">
								<input type="button" value="Ikusi subtotala guztia" onclick="prezioak()">
								<input type="button" value="Jarraitu" id="jarraitu_btn" disabled onclick="prezioak(), window.location.href = 'erosketak.html'">
							</div>
						</div>
                    </div>
                </form>
            <script>

                let esp_prezioa = 6.90;
                let norm_prezioa = 8.90;
                let subtotala = 0;

                function prezioak() {
                    let normala_kop = parseInt(document.getElementById("normal_mota").value);
    				        let gaztea_kop = parseInt(document.getElementById("gaztea_mota").value);
    				        let jubilatu_kop = parseInt(document.getElementById("jubilatu_mota").value);

                    let subtotala = 0;

                    if (normala_kop > 0) {
                        subtotala += normala_kop * norm_prezioa;
                    }

                  if (gaztea_kop > 0) {
                    subtotala += gaztea_kop * esp_prezioa;
                  }
                          
                  if (jubilatu_kop > 0) {
                    subtotala += jubilatu_kop * esp_prezioa;
                  }

                    document.getElementById("subtotala").value = subtotala.toFixed(2); 

                  if (subtotala > 0) {
                    document.getElementById("jarraitu_btn").disabled = false;
                  }
				      }

                function gehitu(sarrera) {
                    var kop = parseInt(sarrera.value);
                    kop++;
                    sarrera.value = kop;
                }
    
                function kendu(sarrera) {
                    var kop = parseInt(sarrera.value);
    
                    if (kop != 0) {
                        kop--;
                        sarrera.value = kop;
                    }
                }
            </script>
        </div>
    </main>
    <footer>
      <div id="info">
        <div id="datuak">
          <h3>Informazioa</h3>
          <p>
            Murgildu mundu zinematografikoan ELORRIETA-rekin, non proiekzio
            bakoitza esperientzia ahaztezina da. Areto bakoitzean, PHIM siglen
            azpian, emozioz eta fantasiaz beteriko munduetara eramango zaitugu.
            Denboraz kanpoko klasikoetatik hasi eta gehien espero diren
            estreinaldietaraino, fotograma bakoitzean zazpigarren artearen magia
            aurkituko duzu gure zinemetan.
          </p>
        </div>
        <div class="kategoriak">
          <h3>ZERBITZUAK</h3>
          <ul>
            <li><a href="">Filmak</a></li>
            <li><a href="">Eskaitzak</a></li>
          </ul>
        </div>
        <div class="kategoriak">
          <h3>BESTE ORRIAK</h3>
          <ul>
            <li><a href="">Eskaintzak</a></li>
            <li><a href="">Hasiera</a></li>
            <li><a href="">Nor gara</a></li>
          </ul>
        </div>
      </div>
      <hr />
      <div id="footerkarratu">
        <a class="copy" href="http://creativecommons.org/ns#"
          >Lan honek CC lizentzia du
          <img
            style="
              height: 22px !important;
              margin-left: 3px;
              vertical-align: text-bottom;
            "
            src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1"
            alt="" /><img
            style="
              height: 22px !important;
              margin-left: 3px;
              vertical-align: text-bottom;
            "
            src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1"
            alt="" /><img
            style="
              height: 22px !important;
              margin-left: 3px;
              vertical-align: text-bottom;
            "
            src="https://mirrors.creativecommons.org/presskit/icons/nc.svg?ref=chooser-v1"
            alt="" /><img
            style="
              height: 22px !important;
              margin-left: 3px;
              vertical-align: text-bottom;
            "
            src="https://mirrors.creativecommons.org/presskit/icons/nd.svg?ref=chooser-v1"
            alt=""
        /></a>
        <div id="saresozialak">
          <a href="">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              aria-label="Instagram"
              role="img"
              viewBox="0 0 512 512"
              fill="#000000"
            >
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g
                id="SVGRepo_tracerCarrier"
                stroke-linecap="round"
                stroke-linejoin="round"
              ></g>
              <g id="SVGRepo_iconCarrier">
                <rect width="512" height="512" rx="15%" id="b"></rect>
                <use fill="url(#a)" xlink:href="#b"></use>
                <use fill="url(#c)" xlink:href="#b"></use>
                <radialGradient id="a" cx=".4" cy="1" r="1">
                  <stop offset=".1" stop-color="#fd5"></stop>
                  <stop offset=".5" stop-color="#ff543e"></stop>
                  <stop offset="1" stop-color="#c837ab"></stop>
                </radialGradient>
                <linearGradient id="c" x2=".2" y2="1">
                  <stop offset=".1" stop-color="#3771c8"></stop>
                  <stop offset=".5" stop-color="#60f" stop-opacity="0"></stop>
                </linearGradient>
                <g fill="none" stroke="#ffffff" stroke-width="30">
                  <rect width="308" height="308" x="102" y="102" rx="81"></rect>
                  <circle cx="256" cy="256" r="72"></circle>
                  <circle cx="347" cy="165" r="6"></circle>
                </g>
              </g>
            </svg>
          </a>
          <a href="">
            <svg
              viewBox="0 0 256 256"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              preserveAspectRatio="xMidYMid"
              fill="#000000"
            >
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g
                id="SVGRepo_tracerCarrier"
                stroke-linecap="round"
                stroke-linejoin="round"
              ></g>
              <g id="SVGRepo_iconCarrier">
                <g>
                  <path
                    d="M241.871,256.001 C249.673,256.001 256,249.675 256,241.872 L256,14.129 C256,6.325 249.673,0 241.871,0 L14.129,0 C6.324,0 0,6.325 0,14.129 L0,241.872 C0,249.675 6.324,256.001 14.129,256.001 L241.871,256.001"
                    fill="#395185"
                  ></path>
                  <path
                    d="M176.635,256.001 L176.635,156.864 L209.912,156.864 L214.894,118.229 L176.635,118.229 L176.635,93.561 C176.635,82.375 179.742,74.752 195.783,74.752 L216.242,74.743 L216.242,40.188 C212.702,39.717 200.558,38.665 186.43,38.665 C156.932,38.665 136.738,56.67 136.738,89.736 L136.738,118.229 L103.376,118.229 L103.376,156.864 L136.738,156.864 L136.738,256.001 L176.635,256.001"
                    fill="#FFFFFF"
                  ></path>
                </g>
              </g>
            </svg>
          </a>
          <a href="">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              aria-label="Twitter"
              role="img"
              viewBox="0 0 512 512"
              fill="#000000"
            >
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g
                id="SVGRepo_tracerCarrier"
                stroke-linecap="round"
                stroke-linejoin="round"
              ></g>
              <g id="SVGRepo_iconCarrier">
                <rect width="512" height="512" rx="15%" fill="#1da1f2"></rect>
                <path
                  fill="#ffffff"
                  d="M437 152a72 72 0 01-40 12a72 72 0 0032-40a72 72 0 01-45 17a72 72 0 00-122 65a200 200 0 01-145-74a72 72 0 0022 94a72 72 0 01-32-7a72 72 0 0056 69a72 72 0 01-32 1a72 72 0 0067 50a200 200 0 01-105 29a200 200 0 00309-179a200 200 0 0035-37"
                ></path>
              </g>
            </svg>
          </a>
        </div>
      </div>
    </footer>
  </body>
</html>
