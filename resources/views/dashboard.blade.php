<x-layouts.app.topbar :taak="$taak"/>

<x-layouts.app :title="__('Vandaag')">

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl ">
        <div class="flex flex-row gap-4 flex-wrap">
            <div class="border rounded-xl flex-1 min-w-[200px] aspect-[3/1]">
                <!--hier komt afgeronde taken-->
            </div>
            <div class="border rounded-xl flex-1 min-w-[200px] aspect-[3/1]">
                <!--hier komt openstaande taken-->
            </div>
            <div class="border rounded-xl flex-1 min-w-[200px] aspect-[3/1]">
                <!--hier komt voortgang met project-->
            </div>
        </div>
        <div class="flex flex-row gap-4 flex-wrap">
            <div class="border flex-[2] min-w-[300px] aspect-[2/1]">
                <!-- hier komt de agenda van vandaag -->
            </div>

            <div class="border flex-1 min-w-[150px] aspect-[2/1] p-2">
                <p class="text-lg font-semibold">Reflectie van deze week</p>
                <br>
                <p>Wat heb je geleerd?</p>
                <!-- vind een manier hoe je tekst kan schrijven hier en ook hier plaatst -->
                <br>
                <p>Wat vond je lastig?</p>
                <!-- vind een manier hoe je tekst kan schrijven hier en ook hier plaatst -->
                <br>
                <p>Volgende stap:</p>
                <!-- vind een manier hoe je tekst kan schrijven hier en ook hier plaatst -->
            </div>
        </div>
    </div>
</x-layouts.app>