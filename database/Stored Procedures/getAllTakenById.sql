USE FW_TODO_APP;

DROP PROCEDURE IF EXISTS getAllTakenById;

DELIMITER $$

CREATE PROCEDURE getAllTakenById(
    IN p_GebruikerId INT
)

BEGIN 
	SELECT t.id,
		   t.WeekNummer,
		   t.Titel,
		   t.Beschrijving,
		   t.Status,
		   t.Deadline
	FROM Taken t
	INNER JOIN TaakLabelKoppelingen tlk ON t.id = tlk.TaakId
	WHERE t.id = tlk.TaakId
    AND tlk.GebruikerId = p_GebruikerId
    AND tlk.IsActief = 1;
END$$-

DELIMITER ;

-- CALL getAllTakenById(1);