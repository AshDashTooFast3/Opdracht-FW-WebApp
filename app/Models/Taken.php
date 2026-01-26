<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Taken extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'Taken';

    protected $primaryKey = 'Id';

    public $timestamps = true;

    const CREATED_AT = 'DatumAangemaakt';

    const UPDATED_AT = 'DatumGewijzigd';

    protected $fillable = [
        'GebruikerId',
        'WeekNummer',
        'Titel',
        'Beschrijving',
        'Status',
        'Type',
        'Deadline',
        'IsActief',
        'Opmerking',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];

    public function gebruiker()
    {
        return $this->belongsTo(User::class, 'GebruikerId');
    }

    //taken voor vandaag ophalen van een gebruiker
    public function getTakenVoorVandaagById (int $GebruikerId): array
    {
        try {
            if (empty($GebruikerId)) {
                Log::warning('Ongeldig gebruiker Id opgegeven', ['GebruikerId' => $GebruikerId]);

                return [];
            }
            $result = DB::select(
                'CALL getTakenVoorVandaagById(?)',
                [$GebruikerId]
            );

            Log::info("Taken voor vandaag voor gebruiker Id {$GebruikerId} succesvol opgehaald.");

            return $result;
        } catch (\Exception $e) {
            Log::error("Fout bij het ophalen van taken voor vandaag voor gebruiker Id {$GebruikerId}: {$e->getMessage()}");

            return [];
        }
    }

    //taken voor morgen ophalen van een gebruiker
    public function getTakenVoorMorgenById(int $GebruikerId): array
    {
        try {
            if (empty($GebruikerId)) {
                Log::warning('Ongeldig gebruiker Id opgegeven', ['GebruikerId' => $GebruikerId]);
                return [];
            }
            $result = DB::select(
                'CALL getTakenVoorMorgenById(?)',
                [$GebruikerId]
            );
            Log::info("Taken voor morgen voor gebruiker Id {$GebruikerId} succesvol opgehaald.");
            return $result;
        } catch (\Exception $e) {
            Log::error("Fout bij het ophalen van taken voor morgen voor gebruiker Id {$GebruikerId}: {$e->getMessage()}");
            return [];
        }
    }

    //alle taken ophalen van een gebruiker
    public function getAllTakenById(int $GebruikerId): array
    {
        try {
            if (empty($GebruikerId)) {
                Log::warning('Ongeldig gebruiker Id opgegeven', ['GebruikerId' => $GebruikerId]);

                return [];
            }
            $result = DB::select(
                'CALL getAllTakenById(?)',
                [$GebruikerId]
            );

            Log::info("Taken voor gebruiker Id {$GebruikerId} succesvol opgehaald.");

            return $result;
        } catch (\Exception $e) {
            Log::error("Fout bij het ophalen van taken voor gebruiker Id {$GebruikerId}: {$e->getMessage()}");

            return [];
        }
    }

    public function updateTaakById(int $Id, array $data): bool
    {
        try {
            if (empty($Id) || empty($data)) {
                Log::warning('Ongeldig taak Id of data opgegeven voor update', ['TaakId' => $Id, 'Data' => $data]);

                return false;
            }

            $result = DB::statement(
                'CALL UpdateTaakById(?, ?, ?, ?, ?, ?)',
                [
                    $Id,
                    $data['Titel'],
                    $data['Beschrijving'],
                    $data['Deadline'],
                    $data['Status'],
                    $data['Type'] ?? NULL,
                ]
            );

            if ($result) {
                Log::info("Taak Id {$Id} succesvol bijgewerkt.");

                return true;
            } else {
                Log::warning("Geen wijzigingen aangebracht voor taak Id {$Id}.");

                return false;
            }
        } catch (\Exception $e) {
            Log::error("Fout bij het bijwerken van taak Id {$Id}: {$e->getMessage()}");

            return false;
        }
    }

    public static function DeleteTaakById(int $Id): bool
    {
        try {
            if (empty($Id)) {
                Log::warning('Ongeldig taak Id opgegeven voor verwijdering', ['TaakId' => $Id]);

                return false;
            }
            DB::statement('CALL sp_DeleteTaakById(?)', [$Id]);

            Log::info("Taak Id {$Id} succesvol verwijderd.");

            return true;
        } catch (\Exception $e) {
            Log::error("Fout bij het verwijderen van taak Id {$Id}: {$e->getMessage()}");

            return false;
        }
    }
}
