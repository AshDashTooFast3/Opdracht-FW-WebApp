USE FW_TODO_APP;

DROP PROCEDURE IF EXISTS getTakenVoorMorgenById;

DELIMITER $$

CREATE PROCEDURE getTakenVoorMorgenById(
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
    AND DATE(t.Deadline) = CURDATE() + INTERVAL 1 DAY;
END$$

DELIMITER ;

-- CALL getTakenVoorMorgenById(1);