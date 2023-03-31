<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans">
	<title>Fantacalcio</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
		<h1>Fantacalcio</h1>
	</header>
	<main> 
		<?php        
			session_start();
			// se l'utente è già autenticato, mostra il messaggio di benvenuto
			if (isset($_SESSION['username'])) {
				echo "<p>Benvenuto, " . $_SESSION['username'] . "!</p>";
				echo "<p>Seleziona una delle seguenti opzioni:</p>";
				echo "<ul>";
				echo "<li><a href='./pages/asta.php'>Asta</a></li>";
				echo "<li><a href='./pages/squadra.php'>Squadra</a></li>";
				echo "<li><a href='./pages/partite.php'>Partite</a></li>";
				echo "<li><a href='./pages/classifica.php'>Classifica</a></li>";
				echo "<li><a href='./API/logout.php'>Logout</a></li>";
				echo "</ul>";
			} else {
				// altrimenti, mostra il form di login e il link alla pagina di registrazione
				echo "<form action='./API/login.php' method='post'>";
				echo "<img src='./img/logo.jpg" . "'width='250'> ";
				echo "<label for='username'>Username:</label>";
				echo "<input type='text' id='username' name='username' required>";
				echo "<label for='password'>Password:</label>";
				echo "<input type='password' id='password' name='password' required>";
				echo "<input type='submit' value='Login'>";
				echo "</form>";
				echo "<p>Non hai ancora un account? <a href='./API/registrazione.php'>Registrati</a> ora!</p>";
			}
		?>
	</main>
	<footer>
		<p>© 2023 Fantacalcio</p>
	</footer>
</body>
</html>
