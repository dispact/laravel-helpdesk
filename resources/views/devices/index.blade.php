<x-app-layout>
    {{-- <div class="ml-5" style="max-width: 95%">
        @livewire('devices-table', [
            'params'=>'Add Device', 
            'exportable' => true,
            'hideable' => 'select'
        ])
    </div> --}}
    @livewire('device.management')
    @livewire('device.create-modal')
    @livewire('device.edit-modal')
</x-app-layout>