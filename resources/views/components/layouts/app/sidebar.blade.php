<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-[#020617] text-lg">
    <flux:sidebar sticky stashable
        class="border-e border-zinc-200 bg-[#0D1528] dark:border-zinc-700 dark:bg-[#0D1528] ">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route(name: 'alles') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:ignore>
            <x-app-logo />
        </a>


        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Platform')" class="grid">
            <div class="mb-2">
                <flux:navlist.item :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:ignore class="text-xl">
                {{ __('Vandaag') }}
                </flux:navlist.item>
            </div>
            <div class="mb-2">
                <flux:navlist.item :href="route('morgen')" :current="request()->routeIs('morgen')" wire:ignore class="text-xl">
                {{ __('Morgen') }}
                </flux:navlist.item>
            </div>
            <div class="mb-2">
                <flux:navlist.item :href="route('alles')" :current="request()->routeIs('alles')" wire:ignore class="text-xl">
                {{ __('Alles') }}
                </flux:navlist.item>
            </div>
            </flux:navlist.group>
        </flux:navlist>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Categorieën')" class="grid">
            <div class="mb-2">
                <flux:navlist.item :href="route('school')" :current="request()->routeIs('school')" wire:ignore class="text-xl">
                {{ __('School') }}
                </flux:navlist.item>
            </div>
            <div class="mb-2">
                <flux:navlist.item :href="route('werk')" :current="request()->routeIs('werk')" wire:ignore class="text-xl">
                {{ __('Werk') }}
                </flux:navlist.item>
            </div>
            <div class="mb-2">
                <flux:navlist.item :href="route('side-projecten')" :current="request()->routeIs('side-projecten')"
                wire:ignore class="text-xl">{{ __('Side Projecten') }}</flux:navlist.item>
            </div>
            <div class="mb-2">
                <flux:navlist.item :href="route('prive')" :current="request()->routeIs('prive')" wire:ignore class="text-xl">
                {{ __('Prive') }}
                </flux:navlist.item>
            </div>
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />
    </flux:sidebar>

    <flux:header class="lg:hidden">
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>

</html>