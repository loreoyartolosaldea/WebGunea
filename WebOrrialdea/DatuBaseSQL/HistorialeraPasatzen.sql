USE alaiktomugi;
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
            Ordua,
            Pertsona_kopurua,
            Hasiera,
            Helmuga,
            Egoera
        ) VALUES 
        (
            NEW.Bidaia_id,
            NEW.Gidari_nan,
            NEW.Erabiltzaile_NAN,
            NEW.Data,
            NEW.Ordua,
            NEW.pertsona_kopurua,
            NEW.hasiera,
            NEW.helmuga,
            NEW.egoera
        );
    END IF;
END;
//

DELIMITER ;
