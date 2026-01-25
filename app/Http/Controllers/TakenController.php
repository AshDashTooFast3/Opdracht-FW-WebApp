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

    public function edit($id)
    {
        // Retrieve the task and return the edit view
    }

    public function update(Request $request, $id)
    {
        // Validate and update the task
    }

    public function destroy($id)
    {
        // Delete the task
    }
}
