<?php

namespace App\Http\Controllers;

use App\Models\Taken;

class PriveController extends Controller
{
    private $taakModel;

    public function __construct()
    {
        $this->taakModel = new Taken;
    }

    public function index()
    {
        $GebruikerId = auth()->id();

        $taken = collect($this->taakModel->getAllTakenById($GebruikerId))->where('Type', 'prive');

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

        return view('prive',
            [
                'titel' => 'Hier zijn jouw prive taken',
                'taken' => $taken,
                'aantalAfgerondeTaken' => $aantalAfgerondeTaken,
                'aantalOpenstaandeTaken' => $aantalOpenstaandeTaken,
                'percentage' => $percentage,
            ]
        );
    }
}
