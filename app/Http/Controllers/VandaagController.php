<?php

namespace App\Http\Controllers;

use App\Models\Taken;

class VandaagController extends Controller
{
    private $taakModel;

    public function __construct()
    {
        $this->taakModel = new Taken;
    }

    public function index()
    {
        $GebruikerId = auth()->id();

        $taken = $this->taakModel->getAllTakenById($GebruikerId);

        // Initialize aantallen as array of objects
        $aantallen = [
            (object) ['AantalAfgerond' => 0],
            (object) ['AantalOpen' => 0],
        ];

        // Loop over all taken
        foreach ($taken as $taak) {
            if (isset($taak->Status) && $taak->Status === 'Afgerond') {
                $aantallen[0]->AantalAfgerond += 1;
            } else {
                $aantallen[1]->AantalOpen += 1;
            }
        }

        // Aantal afgeronde taken
        $aantalAfgerondeTaken = $aantallen[0]->AantalAfgerond ?? 0;
        // Aantal openstaande taken
        $aantalOpenstaandeTaken = $aantallen[1]->AantalOpen ?? 0;
        // Totaal aantal taken
        $totaalTaken = $aantalAfgerondeTaken + $aantalOpenstaandeTaken;
        // Bereken het percentage afgeronde taken
        $percentage = $totaalTaken > 0 ? (int) round($aantalAfgerondeTaken / $totaalTaken * 100) : 0;

        // debug:

        return view('dashboard',
            [
                'taak' => 'Jouw taken voor vandaag',
                'aantalAfgerondeTaken' => $aantalAfgerondeTaken,
                'aantalOpenstaandeTaken' => $aantalOpenstaandeTaken,
                'percentage' => $percentage,
            ]
        );
    }
}
