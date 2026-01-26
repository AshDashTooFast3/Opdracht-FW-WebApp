<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taken;

class MorgenController extends Controller
{
     private $taakModel;
    public function __construct()
    {
        $this->taakModel = new Taken();
    }

    public function index()
    {
        $GebruikerId = auth()->id();

        $taken = collect($this->taakModel->getTakenVoorMorgenById($GebruikerId));

        $aantalAfgerondeTaken = 0;
        $aantalOpenstaandeTaken = 0;

        // Tel afgeronde en openstaande taken
        foreach ($taken as $taak) {
            if ($taak->Status === 'Afgerond') {
                $aantalAfgerondeTaken++;
            } else {
                $aantalOpenstaandeTaken++;
            }
        }

        // Totaal aantal taken
        $totaalTaken = $aantalAfgerondeTaken + $aantalOpenstaandeTaken;
        // Bereken het percentage afgeronde taken
        $percentage = $totaalTaken > 0 ? (int) round($aantalAfgerondeTaken / $totaalTaken * 100) : 0;

        // debug:

        return view('morgen',
            [
                'titel' => 'Jouw taken voor morgen',
                'taken' => $taken,
                'aantalAfgerondeTaken' => $aantalAfgerondeTaken,
                'aantalOpenstaandeTaken' => $aantalOpenstaandeTaken,
                'percentage' => $percentage,
            ]
        );
    }
}
