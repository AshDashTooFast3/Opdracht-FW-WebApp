<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class TaakLabelKoppelingen extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'TaakLabelKoppelingen';

    protected $primaryKey = 'Id';

    protected $fillable = [
        'TaakId',
        'LabelId',
    ];

    public function taak()
    {
        return $this->belongsTo(Taken::class, 'TaakId');
    }
    public function label()
    {
        return $this->belongsTo(Labels::class, 'LabelId');
    }
}
