<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Logout</title>
	<link rel="stylesheet" href="stile.css">
</head>
<body>
	<header>
		<h1>Logout</h1>
	</header>
	<main>
		<?php
			// avvia la sessione
			session_start();

			// se l'utente è autenticato, termina la sessione
			if (isset($_SESSION['username'])) {
				// distrugge tutte le variabili di sessione
				session_unset();

				// distrugge la sessione
				session_destroy();

				echo "<p>Logout effettuato con successo!</p>";
			} else {
				echo "<p>Non sei autenticato!</p>";
			}
		?>
		<p><a href="../index.php">Torna alla pagina principale</a></p>
	</main>
	<footer>
		<p>© 2023 Fantacalcio</p>
	</footer>
</body>
</html>
