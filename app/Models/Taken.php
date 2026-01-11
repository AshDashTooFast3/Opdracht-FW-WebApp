<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

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
}
