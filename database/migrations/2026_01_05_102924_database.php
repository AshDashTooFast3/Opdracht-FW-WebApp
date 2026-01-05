<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Taken', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->increments('Id');
            $table->unsignedBigInteger('GebruikerId');
            $table->tinyInteger('WeekNummer');
            $table->string('Titel', 100);
            $table->string('Beschrijving', 255);
            $table->enum('Status', ['Open', 'Afgerond'])->default('Open');
            $table->boolean('IsActief')->default(1);
            $table->string('Opmerking', 225)->nullable();
            $table->dateTime('DatumAangemaakt', 6)->default(DB::raw('CURRENT_TIMESTAMP(6)'));
            $table->dateTime('DatumGewijzigd', 6)->default(DB::raw('CURRENT_TIMESTAMP(6)'));
            $table->foreign('GebruikerId')->references('id')->on('users');
        });

        

        Schema::create('Labels', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Label', 100);
        });

        Schema::create('TaakLabelKoppeling', function (Blueprint $table) {
            $table->increments('Id');
            $table->unsignedInteger('TaakId');
            $table->unsignedInteger('LabelId');
            $table->foreign('TaakId')->references('Id')->on('Taken');
            $table->foreign('LabelId')->references('Id')->on('Labels');
        });

        Schema::create('WeekReflecties', function (Blueprint $table) {
            $table->increments('Id');
            $table->unsignedBigInteger('GebruikerId');
            $table->integer('WeekNummer');
            $table->string('WatGeleerd', 255)->nullable();
            $table->string('WatLastig', 255)->nullable();
            $table->string('VolgendeStap', 255)->nullable();
            $table->foreign('GebruikerId')->references('id')->on('users');
        });

    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('WeekReflecties');
        Schema::dropIfExists('TaakLabelKoppeling');
        Schema::dropIfExists('Labels');
        Schema::dropIfExists('Taken');
    }
};
