USE alaiktomugi;

SELECT 
    bh.*,  -- Historialeko taulako eremu guztiak
    g.Izena AS Gidari_Izena,
    g.Abizena AS Gidari_Abizena,
    e.Izena AS Erabiltzaile_Izena,
    e.Abizena AS Erabiltzaile_Abizena
FROM 
    bidai_historiala bh
INNER JOIN 
    gidaria g ON bh.Gidari_nan = g.NAN
INNER JOIN 
    erabiltzailea e ON bh.Erabiltzaile_nan = e.NAN;
