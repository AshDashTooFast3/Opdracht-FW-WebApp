<x-layouts.app :title="__('Vandaag')" class="!p-0">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl !p-0">
        <div class="border h-20 w-full">
            <x-placeholder-pattern class="" />
        </div>
        <div class="flex flex-row gap-4 flex-wrap">
            <div class="border flex-1 min-w-[200px] aspect-[3/1]">
                <x-placeholder-pattern />
            </div>
            <div class="border flex-1 min-w-[200px] aspect-[3/1]">
                <x-placeholder-pattern />
            </div>
            <div class="border flex-1 min-w-[200px] aspect-[3/1]">
                <x-placeholder-pattern />
            </div>
        </div>
        <div class="flex flex-row gap-4 flex-wrap">
            <div class="border flex-[2] min-w-[300px] aspect-[2/1]">
                <x-placeholder-pattern />
            </div>
            <div class="border flex-1 min-w-[150px] aspect-[2/1]">
                <x-placeholder-pattern />
            </div>
        </div>
    </div>
</x-layouts.app>