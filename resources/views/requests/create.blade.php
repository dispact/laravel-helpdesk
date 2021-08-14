<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <span class="ml-6">Submit a Ticket</span>
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-6">
        <x-forms.ticket :categories="$categories" :buildings="$buildings" />
    </div>
</x-app-layout>