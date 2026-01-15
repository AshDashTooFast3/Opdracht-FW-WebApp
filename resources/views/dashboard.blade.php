<x-layouts.app.topbar :taak="$taak" />

<x-layouts.app :title="__('Vandaag')">

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="flex flex-row gap-4 flex-wrap">

            {{-- AFGeronde taken --}}
            <div class="border rounded-xl flex-1 min-w-[200px] aspect-[3/1]">
                <h5 class="font-semibold m-4 text-green-400 text-2xl">
                    Taken die nog moeten gedaan worden:
                </h5>
                <div class="font-semibold m-4">
                    <p class="text-3xl">{{ $aantalAfgerondeTaken }} Taken</p>
                    <br>
                    @if ($aantalAfgerondeTaken === 0)
                        <em>Je bent klaar met al jouw taken!</em>
                    @elseif ($aantalAfgerondeTaken === 1)
                        <br>
                        <em class="text-green-400">
                            Zorg dat je deze taak afmaakt!
                        </em>
                    @else
                        <br>
                        <em class="text-green-400">
                            Zorg dat je deze taken afmaakt!
                        </em>
                    @endif
                </div>
            </div>

            {{-- Openstaande taken --}}
            <div class="border rounded-xl flex-1 min-w-[200px] aspect-[3/1]">
                <h5 class="font-semibold m-4 text-yellow-400 text-2xl">
                    Taken die nog moeten gedaan worden:
                </h5>
                <div class="font-semibold m-4">
                    <p class="text-3xl">{{ $aantalOpenstaandeTaken }} Taken</p>
                    <br>
                    @if ($aantalOpenstaandeTaken === 0)
                        <em>Je bent klaar met al jouw taken!</em>
                    @elseif ($aantalOpenstaandeTaken === 1)
                        <br>
                        <em class="text-yellow-400">
                            Zorg dat je deze taak afmaakt!
                        </em>
                    @else
                        <br>
                        <em class="text-yellow-400">
                            Zorg dat je deze taken afmaakt!
                        </em>
                    @endif
                </div>
            </div>

            {{-- Voortgang --}}
            <div class="border rounded-xl flex-1 min-w-[200px] aspect-[3/1]">
                <h5 class="font-semibold m-4 text-2xl text-blue-400">
                    Uw voortgang van het project:
                </h5>

                <div class="font-semibold m-4">
                    <p class="text-3xl">{{ $percentage }} %</p>
                    <br>

                    @if ($percentage == 100)
                        <em class="text-blue-600">
                            U bent klaar met dit project!
                        </em>
                    @elseif ($percentage > 0)
                        <em class="text-blue-400">
                            Goed bezig! Ga zo door!
                        </em>
                    @else
                        <em class="text-blue-200">
                            laten we staren met werken aan dit project!
                        </em>
                    @endif
                </div>
            </div>

        </div>

        <div class="flex flex-row gap-4 flex-wrap">

            <div class="border flex-[2] min-w-[300px] aspect-[2/1]">
                <p class="text-2xl font-semibold m-4">Taken voor dit project:</p>
                <hr>
            </div>
            {{-- <div class="font-semibold m-4">
                <select name="taken_voor_dit_project" id="taken_voor_dit_project">
                    @foreach ($takenVoorDitProject as $taak)
                        <option value="{{ $taak->id }}">{{ $taak->titel }} - {{ $taak->beschrijving }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="border flex-1 min-w-[150px] aspect-[2/1] p-2">
                <p class="text-lg font-semibold">Reflectie van deze week</p>
                <br>

                <p>Wat heb je geleerd?</p>
                <br>

                <p>Wat vond je lastig?</p>
                <br>

                <p>Volgende stap:</p>
            </div>

        </div>

    </div>

</x-layouts.app>