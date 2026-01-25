DROP PROCEDURE IF EXISTS UpdateTaakById;

DELIMITER $$

CREATE PROCEDURE UpdateTaakById(
    IN p_Id INT,
    IN p_Titel VARCHAR(255),
    IN p_Beschrijving TEXT,
    IN p_Deadline DATETIME,
    IN p_Status VARCHAR(50)
)

BEGIN

    UPDATE Taken
    SET Titel = p_Titel,
        Beschrijving = p_Beschrijving,
        Status = p_Status,
        Deadline = p_Deadline
    WHERE Id = p_Id;

END$$

DELIMITER ;

-- CALL UpdateTaakById(1, 'Nieuwe Titel', 'Nieuwe Beschrijving', 'In Progress', '2024-12-31 23:59:59');