USE FW_TODO_APP;

DROP PROCEDURE IF EXISTS getTakenVoorVandaagById;

DELIMITER $$

CREATE PROCEDURE getTakenVoorVandaagById(
    IN p_GebruikerId INT
)
BEGIN 
    SELECT t.Id,
           t.Titel,
           t.Beschrijving,
           t.Status,
           t.Deadline
    FROM Taken t
    INNER JOIN TaakLabelKoppelingen tlk ON t.Id = tlk.TaakId
    WHERE tlk.GebruikerId = p_GebruikerId
    AND tlk.IsActief = 1
    AND DATE(t.Deadline) = CURDATE();
END$$

DELIMITER ;

CALL getTakenVoorVandaagById(1);