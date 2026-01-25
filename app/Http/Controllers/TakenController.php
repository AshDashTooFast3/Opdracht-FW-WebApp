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

    public function create()
    {
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
            'WeekNummer' => now()->weekOfYear,
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

        return redirect()->route('dashboard')->with('success', 'Taak succesvol aangemaakt!');
    }

    public function edit($Id)
    {
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
            return redirect()->route('dashboard')->with('success', 'Taak succesvol bijgewerkt!');
        }
        else {
            return redirect()->route('dashboard')->with('error', 'Er is een fout opgetreden bij het bijwerken van de taak. Probeer het later opnieuw.');
        }
    }

    public function destroy($Id)
    {
        $delete = $this->takenModel->DeleteTaakById($Id);

        if ($delete === true) {
            return redirect()->route('dashboard')->with('success', 'Taak succesvol verwijderd!');
        }
        else {
            return redirect()->route('dashboard')->with('error', 'Er is een fout opgetreden bij het verwijderen van de taak. Probeer het later opnieuw.');
        }
    }
}
