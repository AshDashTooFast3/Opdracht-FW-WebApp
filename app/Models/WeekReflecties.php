<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class WeekReflecties extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'WeekReflecties';

    protected $primaryKey = 'Id';

    public $timestamps = true;

    protected $fillable = [
        'GebruikerId',
        'TaakId',
        'ReflectieTekst',
        'IsActief',
        'Opmerking',
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
