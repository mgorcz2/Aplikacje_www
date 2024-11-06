<!DOCTYPE html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="pl" />
    <meta name="Author" content="Marcin Gorczyński" />
    <title>Loty kosmiczne</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/index_styl.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/color/jquery.color.js"></script>

    <script src="js/waga.js" type="text/javascript"></script>
    <script src="js/time.js" type="text/javascript"></script>

</head>

<body onload="gettheDate()">
    <nav class="menu">
        <div class="dropdown">
            <a href="html/start.html">Historia lotów kosmicznych</a>
            <ul>
                <li><a href="html/start.html">Jak się zaczęło?</a></li>
                <li><a href="html/kontynuacja.html">Kontynuacja podboju kosmosu</a></li>
                <li><a href="html/coprzed.html">Co przed nami?</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <a href="html/sklep.html">Sklep</a>
            <ul>
                <li><a href="html/sklep.html#anchor1">Koszulki</a></li>
                <li><a href="html/sklep.html#anchor2">Kubki</a></li>
            </ul>
        </div>
        <a href="kontakt.html">Kontakt</a>
    </nav>

    <div class="main">
        <div class="kalkulator">
            <h2>Sprawdź ile byś ważył na innych planetach naszego układu słonecznego</h2>
            <input type="number" id="weight" required>
            <label>Wpisz swoją wage</label>
            <br>
            <select id="planet" required>
			<option value="Merkury">Merkury</option>
			<option value="Venus">Venus</option>
			<option value="Mars">Mars</option>
			<option value="Jowisz">Jowisz</option>
			<option value="Saturn">Saturn</option>
			<option value="Uran">Uran</option>
			<option value="Neptun">Neptun</option>
		</select>
            <br>
            <button onclick="calculateWeight()">Oblicz wagę</button>
            <h3 id="result"></h3>
        </div>
        <h3 id="data">Data</h3>
		<?php
		$nr_indeksu = '169240';
		$nrGrupy = 'ISI 1';
		echo 'Marcin Gorczyński';
		?>
    </div>
    <div class="forward">
        <a href="html/start.html">Historia lotów kosmicznych➔ </a>
    </div>

</body>

</html>