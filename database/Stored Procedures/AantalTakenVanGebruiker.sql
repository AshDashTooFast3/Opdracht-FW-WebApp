USE FW_TODO_APP;

DROP PROCEDURE IF EXISTS AantalTakenVanGebruiker;

DELIMITER //

CREATE PROCEDURE AantalTakenVanGebruiker(
    IN p_GebruikerId INT
)

    BEGIN

    SELECT
        SUM(Status = 'Afgerond') AS AantalAfgerond,
        SUM(Status = 'Open') AS AantalOpen
        FROM Taken
        WHERE GebruikerId = p_GebruikerId;
    END //

DELIMITER ;

