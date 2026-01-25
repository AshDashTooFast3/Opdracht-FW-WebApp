DROP PROCEDURE IF EXISTS sp_DeleteTaakById;

DELIMITER $$

CREATE PROCEDURE sp_DeleteTaakById (
    IN TaakId INT
)
BEGIN
    DELETE FROM Taken
    WHERE Id = TaakId;
END$$

DELIMITER ;

-- CALL sp_DeleteTaakById(1);