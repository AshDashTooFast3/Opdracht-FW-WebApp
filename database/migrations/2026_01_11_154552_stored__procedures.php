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
            SELECT t.id,
                t.WeekNummer,
                t.Titel,
                t.Beschrijving,
                t.Status
            FROM Taken t
            INNER JOIN TaakLabelKoppelingen tlk ON t.id = tlk.TaakId
            WHERE t.id = tlk.TaakId
            AND tlk.GebruikerId = p_GebruikerId
            AND tlk.IsActief = 1;
        END
        
        ');


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS AantalTakenVanGebruiker');
    }
};
