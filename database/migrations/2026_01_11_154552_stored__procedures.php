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
                t.WeekNummer,
                t.Titel,
                t.Beschrijving,
                t.Status,
                t.Deadline
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS AantalTakenVanGebruiker');
        DB::unprepared('DROP PROCEDURE IF EXISTS getAllTakenById');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_DeleteTaakById');
    }
};
