<x-app-layout>
    <div class="antialiased h-screen">
        <x-slot name="styles">
            @livewireStyles
        </x-slot>
        
        <div class="ml-5" style="max-width: 95%">
            @livewire('device-model-table', [
                'params'=>'Add Device Model', 
                'exportable' => true,
                'hideable' => 'select'
            ])
        </div>
    </div>
    @livewireScripts
</x-app-layout>