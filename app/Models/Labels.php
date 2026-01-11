<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Labels extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'Labels';

    protected $primaryKey = 'Id';

    public $timestamps = true;

    protected $fillable = [
        'Label',
        'IsActief',
        'Opmerking',
    ];
}
