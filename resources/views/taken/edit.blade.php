<x-layouts.app.topbar :taak="auth()->user()->name" />

<x-layouts.app :title="__('Vandaag')">

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl text-white">

        <div class="flex flex-col gap-6 bg-gray-800 p-6 rounded-lg">
            <h2 class="font-semibold text-2xl text-gray-300">Taak Bewerken</h2>

            <form class="space-y-4" action="{{ route('taken.update', $taak->Id) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="titel" class="block text-sm font-medium text-gray-300 mb-2">Titel</label>
                    <input type="text" id="titel" name="titel" value="{{ old('titel', $taak->Titel) }}"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 @error('titel') border-red-500 @enderror"
                        placeholder="Titel van de taak">
                    @error('titel') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="beschrijving" class="block text-sm font-medium text-gray-300 mb-2">Beschrijving</label>
                    <input type="text" id="beschrijving" name="beschrijving"
                        value="{{ old('beschrijving', $taak->Beschrijving) }}"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 @error('beschrijving') border-red-500 @enderror"
                        placeholder="Beschrijving van de taak">
                    @error('beschrijving') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="deadline" class="block text-sm font-medium text-gray-300 mb-2">Deadline</label>
                    <input type="date" id="deadline" name="deadline"
                        value="{{ old('deadline', \Carbon\Carbon::parse($taak->Deadline)->format('Y-m-d')) }}"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 @error('deadline') border-red-500 @enderror">
                    @error('deadline') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-300 mb-2">Status</label>
                    <select id="status" name="status"
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-blue-500 @error('status') border-red-500 @enderror"
                        autofocus>
                        <option value="open" {{ old('status', $taak->Status) === 'Open' ? 'selected' : '' }}>Open</option>
                        <option value="in_behandeling" {{ old('status', $taak->Status) === 'In Behandeling' ? 'selected' : '' }}>In Behandeling</option>
                        <option value="afgerond" {{ old('status', $taak->Status) === 'Afgerond' ? 'selected' : '' }}>Afgerond</option>
                    </select>
                    @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg cursor-pointer transition">Verstuur
                    </button>
                    <a href="{{ route('dashboard') }}"
                        class="ml-4 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg cursor-pointer transition">Annuleren
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>