<x-layouts.app.topbar :taak="auth()->user()->name" />

<x-layouts.app :title="__('Vandaag')">

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="flex flex-row gap-4 flex-wrap">

            {{-- AFGeronde taken --}}
            <div class="bg-gray-900 rounded-xl flex-1 min-w-[200px] aspect-[3/1]">
                <h5 class="font-semibold m-4 text-2xl text-gray-300">
                    Afgeronde taken:
                </h5>
                <div class="font-semibold m-4">
                    <p class="text-3xl"">{{ $aantalAfgerondeTaken }} Taken</p>
                    <br>
                    @if ($aantalAfgerondeTaken === 0)
                        <br>
                        <em class="text-green-200">
                            Je hebt nog geen taken afgerond!
                        </em>
                    @elseif ($percentage === 100)
                        <br>
                        <em class=" text-green-600">
                            Geweldig werk! Je hebt alle taken afgerond!
                        </em>
                    @else
                        <br>
                        <em class=" text-green-400">
                        Lekker bezig! Ga zo door!
                        </em>
                    
                    @endif
                </div>
            </div>

            {{-- Openstaande taken --}}
            <div class="bg-gray-900 rounded-xl flex-1 min-w-[200px] aspect-[3/1]">
                <h5 class="font-semibold m-4 text-2xl text-gray-300">
                    Taken die nog moeten gedaan worden:
                </h5>
                <div class="font-semibold m-4">
                    <p class="text-3xl">{{ $aantalOpenstaandeTaken }} Taken</p>
                    <br>
                    @if ($aantalOpenstaandeTaken === 0)
                        <br>
                        <em class="text-green-200">
                            Je bent klaar met al jouw taken!
                        </em>
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
            <div class="bg-gray-900 rounded-xl flex-1 min-w-[200px] aspect-[3/1]">
                <h5 class="font-semibold m-4 text-2xl text-gray-300">
                    Uw voortgang van het project:
                </h5>

                <div class="font-semibold m-4">
                    <p class="text-3xl">{{ $percentage }} %</p>
                    <br>

                    @if ($percentage == 100)
                    <br>
                        <em class="text-blue-600">
                            U bent klaar met dit project!
                        </em>
                    @elseif ($percentage > 0)
                    <br>
                        <em class="text-blue-400">
                            Goed bezig! Ga zo door!
                        </em>
                    @else
                    <br>
                        <em class="text-blue-200">
                            laten we staren met werken aan dit project!
                        </em>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex flex-row gap-4 flex-wrap">
            <div class="bg-gray-900 flex-[2] min-w-[300px] aspect-[2/1] p-2">
                <p class="text-2xl font-semibold m-4">Taken voor dit project:</p>
                <hr class="text-gray-600">
                <div class="font-semibold m-4">
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-3 rounded mb-4">
                            {{ session('success') }}
                            <meta http-equiv="refresh" content="2;url={{ route('dashboard') }}">
                        </div>
                    @elseif (session('error'))
                        <div class="bg-red-500 text-white p-3 rounded mb-4">
                            {{ session('error') }}
                            <meta http-equiv="refresh" content="2;url={{ route('dashboard') }}">
                        </div>
                    @endif
                    @foreach ($taken as $taak)
                        <form action="{{ route('checkTaak') }}" method="POST" class="taak-form">
                            @csrf
                            <input type="hidden" name="taak_id" value="{{ $taak->Id }}">

                            <div @class([
        'flex items-start gap-3 p-3 rounded-lg border transition-all hover:bg-gray-900 mb-3',
        'bg-green-500 border-green-600' => $taak->Status === 'Afgerond',
        'bg-gray-800 border-gray-600' => $taak->Status !== 'Afgerond'
    ])>
                                <input type="checkbox" class="mt-1 cursor-pointer" onchange="this.form.submit()" 
                                    {{ $taak->Status === 'Afgerond' ? 'checked' : '' }}>

                                <div class="flex-1">
                                    <span @class(['font-semibold text-xl', 'line-through' => $taak->Status === 'Afgerond'])>
                                        {{ $taak->Titel }}
                                    </span>
                                    <p @class(['text-s text-white mt-1', 'line-through' => $taak->Status === 'Afgerond'])>
                                        {{ $taak->Beschrijving }}
                                    </p>
                                </div>
                                <div>
                                    <button type="submit" formaction="{{ route('taak.destroy', ['Id' => $taak->Id]) }}" 
                                        class="text-red-500 hover:text-red-700 font-semibold">
                                        <i class="bi bi-trash-fill cursor-pointer"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>

            {{-- Deadlines --}}
            <div class="bg-gray-900 flex-1 min-w-[150px] aspect-[2/1] p-2 rounded-xl">
                <p class="text-2xl font-semibold m-4">Deadline:</p>
                <hr class="text-gray-600">
                <div class="font-semibold m-4">
                    @if ($taken->where('Status', '!=', 'Afgerond')->count() > 0)
                        @foreach ($taken as $taak)
                            @if ($taak->Status !== 'Afgerond')
                                <div class="mb-3 bg-gray-800 p-2 rounded-lg">
                                    <p class="text-xl">
                                        {{ $taak->Titel }} <br> 
                                    </p>
                                    <p class="text-red-400">
                                        Deadline:
                                        <br>
                                        {{ \Carbon\Carbon::parse($taak->Deadline)->format('d-m-Y') }}
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <em class="text-green-400">Geen openstaande deadlines</em>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>