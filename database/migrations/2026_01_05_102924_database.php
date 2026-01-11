<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Taken', function (Blueprint $table) {
            $table->Id(); 
            $table->foreignId('GebruikerId')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->integer('WeekNummer');
            $table->string('Titel');
            $table->string('Beschrijving');
            $table->enum('Status', ['Open', 'Afgerond'])->default('Open');
            $table->boolean('IsActief')->default(true);
            $table->string('Opmerking')->nullable();
            $table->timestamps();
        });

        Schema::create('Labels', function (Blueprint $table) {
            $table->Id(); 

            $table->string('Label', 100);
            $table->boolean('IsActief')->default(true);
            $table->string('Opmerking')->nullable();
            $table->timestamps();
        });

        Schema::create('TaakLabelKoppelingen', function (Blueprint $table) {
            $table->Id();
            $table->foreignId('TaakId')
                ->constrained('Taken')
                ->cascadeOnDelete();
            $table->foreignId('LabelId')
                ->constrained('Labels')
                ->cascadeOnDelete();
            $table->boolean('IsActief')->default(true);
            $table->string('Opmerking')->nullable();
            $table->timestamps();
        });

        Schema::create('WeekReflecties', function (Blueprint $table) {
            $table->Id(); 
            $table->foreignId('GebruikerId')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('TaakId')
                ->constrained('Taken')
                ->cascadeOnDelete();
            $table->text('ReflectieTekst');
            $table->boolean('IsActief')->default(true);
            $table->string('Opmerking')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Labels');
        Schema::dropIfExists('Taken');
        Schema::dropIfExists('WeekReflecties');
        Schema::dropIfExists('TaakLabelKoppeling');
    }
};
