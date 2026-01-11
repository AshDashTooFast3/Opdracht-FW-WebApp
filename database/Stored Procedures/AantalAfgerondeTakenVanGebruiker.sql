USE FW_TODO_APP;

DROP PROCEDURE IF EXISTS AantalAfgerondeTakenVanGebruiker;

DELIMITER //
CREATE PROCEDURE AantalAfgerondeTakenVanGebruiker(
    IN p_GebruikerId INT
)

    BEGIN

    SELECT COUNT(*) AS AantalAfgerondeTaken
    FROM Taken
    WHERE GebruikerId = p_GebruikerId 
    AND Status = 'Afgerond';

    END //

DELIMITER ;

