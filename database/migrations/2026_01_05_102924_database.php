<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE TABLE Taken (
            Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            GebruikerId BIGINT UNSIGNED NOT NULL,
            WeekNummer TINYINT NOT NULL,
            Titel VARCHAR(100) NOT NULL,
            Beschrijving VARCHAR(255) NOT NULL,
            Status ENUM('Open', 'Afgerond', 'In Behandeling') DEFAULT 'Open',
            Deadline DATETIME NOT NULL,
            IsActief BIT DEFAULT 1,
            Opmerking VARCHAR(225) DEFAULT NULL,
            DatumAangemaakt DATETIME(6) NOT NULL DEFAULT NOW(6),
            DatumGewijzigd DATETIME(6) NOT NULL DEFAULT NOW(6),
            FOREIGN KEY (GebruikerId) REFERENCES users(id) ON DELETE CASCADE
            );
        
            CREATE TABLE Labels (
            Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            Label VARCHAR(100) NOT NULL,
            IsActief BIT DEFAULT 1,
            Opmerking VARCHAR(225) DEFAULT NULL,
            DatumAangemaakt DATETIME(6) NOT NULL DEFAULT NOW(6),
            DatumGewijzigd DATETIME(6) NOT NULL DEFAULT NOW(6)
            );

            CREATE TABLE TaakLabelKoppelingen (
            Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            TaakId INT UNSIGNED NOT NULL,
            LabelId INT UNSIGNED NOT NULL,
            GebruikerId BIGINT UNSIGNED NOT NULL,
            IsActief BIT DEFAULT 1,
            Opmerking VARCHAR(225) DEFAULT NULL,
            DatumAangemaakt DATETIME(6) NOT NULL DEFAULT NOW(6),
            DatumGewijzigd DATETIME(6) NOT NULL DEFAULT NOW(6),
            FOREIGN KEY (TaakId) REFERENCES Taken(Id) ON DELETE CASCADE,
            FOREIGN KEY (LabelId) REFERENCES Labels(Id) ON DELETE CASCADE,
            FOREIGN KEY (GebruikerId) REFERENCES users(Id) ON DELETE CASCADE
            );

            CREATE TABLE WeekReflecties (
                Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                GebruikerId BIGINT UNSIGNED NOT NULL,
                TaakId INT UNSIGNED NOT NULL,
                WeekNummer INT NOT NULL,
                WatGeleerd VARCHAR(255) NULL,
                WatLastig VARCHAR(255) NULL,
                VolgendeStap VARCHAR(255) NULL,
                IsActief BIT DEFAULT 1,
                Opmerking VARCHAR(225) DEFAULT NULL,
                DatumAangemaakt DATETIME(6) NOT NULL DEFAULT NOW(6),
                DatumGewijzigd DATETIME(6) NOT NULL DEFAULT NOW(6),
                FOREIGN KEY (GebruikerId) REFERENCES users(Id)
            );
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Labels');
        Schema::dropIfExists('Taken');
        Schema::dropIfExists('WeekReflecties');
        Schema::dropIfExists('TaakLabelKoppelingen');
    }
};
