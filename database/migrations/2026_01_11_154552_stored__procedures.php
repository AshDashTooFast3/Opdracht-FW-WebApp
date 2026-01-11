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
                    SUM(Status = "Afgerond") AS AantalAfgerond,
                    SUM(Status = "Open") AS AantalOpen
                FROM Taken
                WHERE GebruikerId = p_GebruikerId;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        DB::unprepared('DROP PROCEDURE IF EXISTS AantalTakenVanGebruiker');
    }
};
