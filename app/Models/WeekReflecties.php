<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class WeekReflecties extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'WeekReflecties';

    protected $primaryKey = 'Id';

    public $timestamps = true;

    const CREATED_AT = 'DatumAangemaakt';

    const UPDATED_AT = 'DatumGewijzigd';

    protected $fillable = [
        'GebruikerId',
        'TaakId',
        'WeekNummer',
        'WatGeleerd',
        'WatLastig',
        'VolgendeStap',
        'IsActief',
        'Opmerking',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];

    public function gebruiker()
    {
        return $this->belongsTo(User::class, 'GebruikerId');
    }

    public function taak()
    {
        return $this->belongsTo(Taken::class, 'TaakId');
    }
}
