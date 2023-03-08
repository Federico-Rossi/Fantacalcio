<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans">
	<title>Login</title>
	<link rel="stylesheet" href="../style.css"></head>
<body>
	<header>
		<h1>Login</h1>
	</header>
	<main>
		<?php
			// avvia la sessione
			session_start();

			// se l'utente è già autenticato, reindirizza alla pagina principale
			if (isset($_SESSION['username'])) {
				header('Location: ../index.php');
				exit;
			}

			// se il form è stato sottomesso, elabora i dati inseriti dall'utente
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// controlla che tutti i campi siano stati inseriti correttamente
				if (empty($_POST['username']) || empty($_POST['password'])) {
					echo "<p>Username e password sono obbligatori!</p>";
				} else {
					// connessione al database
					require_once '../Common/connect.php';

					// preparazione della query per il recupero delle informazioni dell'utente
					$query = "SELECT * FROM utenti WHERE username = ?";
					$stmt = $conn->prepare($query);
					$stmt->bind_param("s", $_POST['username']);

					// esecuzione della query
					if ($stmt->execute()) {
						$result = $stmt->get_result();
						$row = $result->fetch_assoc();

						// verifica che la password inserita corrisponda a quella salvata nel database
						if ($row && password_verify($_POST['password'], $row['password'])) {
							// autenticazione riuscita
							$_SESSION['username'] = $row['username'];
							header('Location: ../index.php');
							exit;
						} else {
							// autenticazione fallita
							echo "<p>Credenziali non valide!</p>";
						}
					} else {
						echo "<p>Errore durante l'autenticazione. Riprova più tardi.</p>";
					}

					// chiusura della connessione al database
					$stmt->close();
					$conn->close();
				}
			}
		?>
		<form action="./API/login.php" method="post">
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" required>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>
			<input type="submit" value="Accedi">
		</form>
		<p>Non hai ancora un account? <a href="./API/registrazione.php">Registrati</a> ora!</p>
	</main>
	<footer>
		<p>© 2023 Fantacalcio</p>
	</footer>
</body>
</html>
