<?php

namespace App\Http\Controllers;

use App\Models\Taken;
use Illuminate\Http\Request;

class TakenController extends Controller
{
    private $takenModel;

    public function __construct()
    {
        $this->takenModel = new Taken;
    }

    public function create()
    {
        return view('taken.create', [
            'titel' => 'Nieuwe Taak Aanmaken',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titel' => 'required|string|max:255',
            'beschrijving' => 'required|string',
            'deadline' => 'required|date',
        ]);

        Taken::create([
            'GebruikerId' => auth()->user()->id,
            'Titel' => $validated['titel'],
            'Beschrijving' => $validated['beschrijving'],
            'WeekNummer' => now()->weekOfYear,
            'Deadline' => $validated['deadline'],
            'Status' => 'Openstaand',
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
