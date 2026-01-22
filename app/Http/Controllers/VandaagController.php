<?php

namespace App\Http\Controllers;

use App\Models\Taken;
use Illuminate\Http\Request;

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

        return view('dashboard',
            [
                'titel' => 'Jouw taken voor vandaag',
                'taken' => $taken,
                'aantalAfgerondeTaken' => $aantalAfgerondeTaken,
                'aantalOpenstaandeTaken' => $aantalOpenstaandeTaken,
                'percentage' => $percentage,
            ]
        );
    }

    public function checkTaak(Request $request)
    {
        $taak = Taken::findOrFail($request->taak_id);

        // Toggle status
        $taak->Status = $taak->Status === 'Afgerond'
            ? 'Open'
            : 'Afgerond';

        $taak->save();

        return redirect()->route('dashboard');
    }
}
