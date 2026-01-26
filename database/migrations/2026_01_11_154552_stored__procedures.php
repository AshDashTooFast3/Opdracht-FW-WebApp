<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

// These use directives are unnecessary and can be removed

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        DB::unprepared(' 
        DROP PROCEDURE IF EXISTS AantalTakenVanGebruiker;       
        CREATE PROCEDURE AantalTakenVanGebruiker(
            IN p_GebruikerId INT
        )
        BEGIN
            SELECT
                COALESCE(SUM(UPPER(TRIM(Status)) = "Afgerond"), 0) AS AantalAfgerond,
                COALESCE(SUM(UPPER(TRIM(Status)) = "Open"), 0) AS AantalOpen
            FROM Taken
            WHERE GebruikerId = p_GebruikerId;
        END
    ');

        DB::unprepared('
        DROP PROCEDURE IF EXISTS getAllTakenById;
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
        END
        
        ');

        DB::unprepared('
        DROP PROCEDURE IF EXISTS sp_DeleteTaakById;

        CREATE PROCEDURE sp_DeleteTaakById (
            IN TaakId INT
        )

        BEGIN

            DELETE FROM Taken t 
            WHERE Id = TaakId;
            
        END
    
        ');

        DB::unprepared('
        DROP PROCEDURE IF EXISTS UpdateTaakById;

        CREATE PROCEDURE UpdateTaakById(
            IN p_Id INT,
            IN p_Titel VARCHAR(255),
            IN p_Beschrijving VARCHAR(255),
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

        END;

        ');

        DB::unprepared('
        DROP PROCEDURE IF EXISTS getTakenVoorVandaagById;
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
        END
        ');

        DB::unprepared('
        DROP PROCEDURE IF EXISTS getTakenVoorMorgenById;
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
         END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS AantalTakenVanGebruiker');
        DB::unprepared('DROP PROCEDURE IF EXISTS getAllTakenById');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_DeleteTaakById');
        DB::unprepared('DROP PROCEDURE IF EXISTS UpdateTaakById');
    }
};
