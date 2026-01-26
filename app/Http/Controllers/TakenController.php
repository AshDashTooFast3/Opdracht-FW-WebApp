<?php

namespace App\Http\Controllers;

use App\Models\TaakLabelKoppelingen;
use App\Models\Taken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TakenController extends Controller
{
    private $takenModel;

    private $takenLabelsKoppel;

    public function __construct()
    {
        $this->takenModel = new Taken;
        $this->takenLabelsKoppel = new TaakLabelKoppelingen;
    }

    public function checkTaak(Request $request)
    {
        session(['url.intended' => url()->previous()]);

        $taak = Taken::findOrFail($request->taak_id);

        // Toggle status
        $taak->Status = $taak->Status === 'Afgerond'
            ? 'Open'
            : 'Afgerond';

        $taak->save();

        return redirect()->intended('/');
    }

    public function create()
    {
        session(['url.intended' => url()->previous()]);

        return view('taken.create', [
            'titel' => 'Nieuwe Taak Aanmaken',
        ]);
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;

        $validated = $request->validate([
            'titel' => 'required|string|max:255',
            'beschrijving' => 'required|string',
            'deadline' => 'required|date',
        ]);

        $taak = Taken::create([
            'id' => (string) Str::uuid(),
            'GebruikerId' => $userId,
            'Titel' => $validated['titel'],
            'Beschrijving' => $validated['beschrijving'],
            'Deadline' => $validated['deadline'],
            'Status' => 'Open',
            'IsActief' => true,
        ]);

        TaakLabelKoppelingen::create([
            'TaakId' => $taak->Id,
            'LabelId' => 1,
            'GebruikerId' => $userId,
            'IsActief' => true,
        ]);

        return redirect()->intended('/')->with('success', 'Taak succesvol aangemaakt!');
    }

    public function edit($Id)
    {
        session(key: ['url.intended' => url()->previous()]);

        $taak = $this->takenModel->find($Id);

        return view('taken.edit', [
            'titel' => 'Taak Bewerken',
            'taak' => $taak,
        ]);
    }

    public function update(Request $request, $Id)
    {
        $validated = $request->validate([
            'titel' => 'required|string|max:255',
            'beschrijving' => 'required|string',
            'deadline' => 'required|date',
            'status' => 'required|string|',
        ]);

        $data = [
            'Titel' => $validated['titel'],
            'Beschrijving' => $validated['beschrijving'],
            'Deadline' => $validated['deadline'],
            'Status' => $validated['status'],
        ];

        $update = $this->takenModel->updateTaakById($Id, $data);

        if ($update === true) {
            return redirect()->intended('/')->with('success', 'Taak succesvol bijgewerkt!');
        } else {
            return redirect()->intended('/')->with('error', 'Er is een fout opgetreden bij het bijwerken van de taak. Probeer het later opnieuw.');
        }
    }

    public function destroy($Id)
    {
        session(key: ['url.intended' => url()->previous()]);

        $delete = $this->takenModel->DeleteTaakById($Id);

        if ($delete === true) {
            return redirect()->intended('/')->with('success', 'Taak succesvol verwijderd!');
        } else {
            return redirect()->intended('/')->with('error', 'Er is een fout opgetreden bij het verwijderen van de taak. Probeer het later opnieuw.');
        }
    }
}
