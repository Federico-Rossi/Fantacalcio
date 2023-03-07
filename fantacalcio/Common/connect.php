<?php
// Informazioni di connessione al database MySQL
$servername = "localhost"; // Indirizzo IP del server MySQL
$username = "root"; // Nome utente del database
$password = ""; // Password del database
$dbname = "fantacalcio"; // Nome del database

// Crea una connessione al database MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se la connessione al database è avvenuta con successo
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
?>