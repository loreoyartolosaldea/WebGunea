USE alaiktomugi;

DROP TRIGGER IF EXISTS pasa_historialera;

DELIMITER //

CREATE TRIGGER pasa_historialera
AFTER UPDATE ON Bidaia
FOR EACH ROW
BEGIN
    IF NEW.egoera = 'eginda' AND OLD.egoera <> 'eginda' THEN
        INSERT IGNORE INTO bidai_historiala 
        (
            Bidaia_id,
            Gidari_nan,
            Erabiltzaile_nan,
            Data,
            Hasiera_ordua,
            Pertsona_kopurua,
            Hasiera,
            Helmuga,
            Egoera,
            Amaiera_ordua
        ) VALUES 
        (
            NEW.Bidaia_id,
            NEW.Gidari_nan,
            NEW.Erabiltzaile_NAN,
            NEW.Data,
            NEW.Hasiera_ordua,
            NEW.Pertsona_kopurua,
            NEW.Hasiera,
            NEW.Helmuga,
            NEW.Egoera,
            NEW.Amaiera_ordua
        );
    END IF;
END;
//

DELIMITER ;
