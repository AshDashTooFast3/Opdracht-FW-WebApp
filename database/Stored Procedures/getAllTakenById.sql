USE FW_TODO_APP;

DROP PROCEDURE IF EXISTS getAllTakenById;

DELIMITER $$

CREATE PROCEDURE getAllTakenById(
    IN p_GebruikerId INT
)

BEGIN 
	SELECT t.Id,
		   t.Titel,
		   t.Beschrijving,
		   t.Status,
		   t.Deadline,
		   t.Type
	FROM Taken t
	INNER JOIN TaakLabelKoppelingen tlk ON t.Id = tlk.TaakId
	WHERE t.Id = tlk.TaakId
    AND tlk.GebruikerId = p_GebruikerId
    AND tlk.IsActief = 1;
END$$

DELIMITER ;

-- CALL getAllTakenById(1);