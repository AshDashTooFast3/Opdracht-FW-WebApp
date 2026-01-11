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

        $aantallen = $this->taakModel->AantalTakenVanGebruiker($GebruikerId);

        $aantalAfgerondeTaken = $aantallen['afgerond'];
        $aantalOpenstaandeTaken = $aantallen['open'];
        $totaalTaken = $aantalAfgerondeTaken + $aantalOpenstaandeTaken;
        $percentage = $totaalTaken > 0 ? (int) round($aantalAfgerondeTaken / $totaalTaken * 100) : 0;


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
