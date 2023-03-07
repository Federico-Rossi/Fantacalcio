USE fantacalcio;

-- Tabella degli utenti
CREATE TABLE IF NOT EXISTS utenti (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);

-- Tabella delle squadre
CREATE TABLE IF NOT EXISTS squadre (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    utente_id INT(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (utente_id) REFERENCES utenti(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabella dei giocatori
CREATE TABLE IF NOT EXISTS giocatori (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    ruolo VARCHAR(20) NOT NULL,
    valore DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (id)
);

-- Tabella delle rose
CREATE TABLE IF NOT EXISTS rose (
    id INT(11) NOT NULL AUTO_INCREMENT,
    squadra_id INT(11) NOT NULL,
    giocatore_id INT(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (squadra_id) REFERENCES squadre(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (giocatore_id) REFERENCES giocatori(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabella delle partite
CREATE TABLE IF NOT EXISTS partite (
    id INT(11) NOT NULL AUTO_INCREMENT,
    squadra_casa_id INT(11) NOT NULL,
    squadra_ospite_id INT(11) NOT NULL,
    data_ora DATETIME NOT NULL,
    gol_casa INT(11) DEFAULT 0,
    gol_ospite INT(11) DEFAULT 0,
    PRIMARY KEY (id),
    FOREIGN KEY (squadra_casa_id) REFERENCES squadre(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (squadra_ospite_id) REFERENCES squadre(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabella dei punteggi
CREATE TABLE IF NOT EXISTS punteggi (
    id INT(11) NOT NULL AUTO_INCREMENT,
    squadra_id INT(11) NOT NULL,
    partita_id INT(11) NOT NULL,
    punteggio INT(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (squadra_id) REFERENCES squadre(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (partita_id) REFERENCES partite(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabella della classifica
CREATE TABLE IF NOT EXISTS classifica (
    id INT(11) NOT NULL AUTO_INCREMENT,
    squadra_id INT(11) NOT NULL,
    punteggio INT(11) NOT NULL,
    posizione INT(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (squadra_id) REFERENCES squadre(id) ON DELETE CASCADE ON UPDATE CASCADE
);
