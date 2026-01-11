<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Taken extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'Taken';

    protected $primaryKey = 'Id';

    public $timestamps = true;

    protected $fillable = [
        'GebruikerId',
        'WeekNummer',
        'Titel',
        'Beschrijving',
        'Status',
        'IsActief',
        'Opmerking',
    ];

    public function gebruiker()
    {
        return $this->belongsTo(User::class, 'GebruikerId');
    }

    public function AantalTakenVanGebruiker(int $GebruikerId): array
    {
        $result = DB::select(
            'CALL AantalTakenVanGebruiker(?)',
            [$GebruikerId]
        );
        dd($result);

        return [
            'afgerond' => (int) ($result[0]->AantalAfgerond ?? 0),
            'open' => (int) ($result[0]->AantalOpen ?? 0),
        ];
    }
}
