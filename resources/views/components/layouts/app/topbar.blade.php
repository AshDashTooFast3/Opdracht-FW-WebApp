<div class="flex flex-1 flex-col h-25 w-full gap-4 p-4 bg-white dark:bg-[#0D1528]">
    <p class="text-gray-400">Welkom Terug</p>
    <p>{{ $taak ?? $slot }}</p>
    <div class="absolute top-4 right-4 flex flex-row items-center gap-4 ">
        <a class="border border-gray-500 rounded-xl px-4 py-1" href="{{ route('taken.create') }}">Nieuwe taak</a>
        <x-layouts.app.userdropdown />
    </div>
    <!--hier komt welkomsbericht ,nieuwe taak toevoegen-->
</div>