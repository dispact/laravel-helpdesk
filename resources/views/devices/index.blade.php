<x-app-layout>
    <div class="antialiased h-screen">
        <x-slot name="styles">
            @livewireStyles
        </x-slot>
        
        <div class="ml-5" style="max-width: 95%">
            @livewire('devices-table', [
                'params'=>'Add Device', 
                'exportable' => true,
                'hideable' => 'select'
            ])
        </div>
    </div>
    <x-modals.create.device/>
    <x-modals.edit.device/>
    @livewireScripts
</x-app-layout>