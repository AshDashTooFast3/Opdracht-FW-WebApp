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
