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

    public $timestamps = true;

    const CREATED_AT = 'DatumAangemaakt';

    const UPDATED_AT = 'DatumGewijzigd';
    protected $fillable = [
        'TaakId',
        'LabelId',
        'IsActief',
        'Opmerking',
        'DatumAangemaakt',
        'DatumGewijzigd',
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
