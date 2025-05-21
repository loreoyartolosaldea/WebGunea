CREATE DATABASE IF NOT EXISTS alaikToMUGI;
USE alaikToMUGI;

CREATE TABLE IF NOT EXISTS Erabiltzailea 
(
    NAN VARCHAR(9) PRIMARY KEY,
    Izena VARCHAR(50),
    Abizena VARCHAR(50),
    Posta VARCHAR(100),
    Tel_zenb VARCHAR(20),
    Pasahitza VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS Gidaria 
(
    NAN VARCHAR(9) PRIMARY KEY,
    Izena VARCHAR(50),
    Abizena VARCHAR(50),
    Posta VARCHAR(100),
    Tel_zenb VARCHAR(20),
    Pasahitza VARCHAR(100),
    Kokapena VARCHAR(100),
    Lan_lekua VARCHAR(100),
    Matrikula VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS Kudeatzailea 
(
    NAN VARCHAR(9) PRIMARY KEY
);

CREATE TABLE IF NOT EXISTS Bidaia 
(
    Bidaia_id INT PRIMARY KEY AUTO_INCREMENT,
    Data DATE,
    Hasiera_ordua TIME,
    Pertsona_kopurua INT,
    Egoera VARCHAR(50),
    Erabiltzaile_NAN VARCHAR(9),
    Gidari_NAN VARCHAR(9),
    Hasiera VARCHAR(50),
    Helmuga VARCHAR(50),
    Amaiera_ordua TIME,
    FOREIGN KEY (Erabiltzaile_NAN) REFERENCES Erabiltzailea(NAN),
    FOREIGN KEY (Gidari_NAN) REFERENCES Gidaria(NAN)
);

CREATE TABLE IF NOT EXISTS Bidai_historiala 
(
    Bidaia_id INT PRIMARY KEY,
    Gidari_nan VARCHAR(9),
    Erabiltzaile_nan VARCHAR(9),
    Data DATE,
    Hasiera_ordua TIME,
    Pertsona_kopurua INT,
    Hasiera VARCHAR(50),
    Helmuga VARCHAR(50),
    Amaiera_ordua VARCHAR(50),
    FOREIGN KEY (Bidaia_id) REFERENCES Bidaia(Bidaia_id),
    FOREIGN KEY (Gidari_nan) REFERENCES Gidaria(NAN),
    FOREIGN KEY (Erabiltzaile_NAN) REFERENCES Erabiltzailea(NAN)
);


ALTER TABLE Gidaria
ADD Kudeatzailea_NAN VARCHAR(9),
ADD FOREIGN KEY (Kudeatzailea_NAN) REFERENCES Kudeatzailea(NAN);
