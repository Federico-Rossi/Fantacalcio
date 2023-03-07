<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registrazione</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
		<h1>Registrazione</h1>
	</header>
	<main>
		<?php
			// se il form è stato sottomesso, elabora i dati inseriti dall'utente
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// controlla che tutti i campi siano stati inseriti correttamente
				if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
					echo "<p>Tutti i campi sono obbligatori!</p>";
				} else {
					// connessione al database
					require_once '../Common/connect.php';

					// preparazione della query per l'inserimento del nuovo utente
					$query = "INSERT INTO utenti (username, password, email) VALUES (?, ?, ?)";
					$stmt = $conn->prepare($query);
					$stmt->bind_param("sss", $_POST['username'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['email']);

					// esecuzione della query
					if ($stmt->execute()) {
						echo "<p>Registrazione effettuata con successo!</p>";
					} else {
						echo "<p>Errore durante la registrazione. Riprova più tardi.</p>";
					}

					// chiusura della connessione al database
					$stmt->close();
					$conn->close();
				}
			}
		?>
		<form action="registrazione.php" method="post">
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" required>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required>
			<input type="submit" value="Registrati">
		</form>
		<p>Hai già un account? <a href="index.php">Accedi</a> ora!</p>
	</main>
	<footer>
		<p>© 2023 Fantacalcio</p>
	</footer>
</body>
</html>
