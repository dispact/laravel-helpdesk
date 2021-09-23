
<x-slot name="header">
	<div class="flex items-center">

		@if(auth()->user()->is_staff())
		<x-buttons.back link="{{ route('tickets.index') }}"/>
		@else
		<x-buttons.back link="{{ route('requests.index') }}"/>
		@endif

		<span class="ml-6">{{ $ticket->title }}</span>
	</div>
</x-slot>

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-6 ml-3 mr-3 md:mr-0">
	
	<div class="flex flex-inline space-x-2 mb-2">
		<x-filters.status-dropdown wire:model="status"/>
		<x-filters.category-dropdown wire:model="category"/>
		<x-filters.building-dropdown wire:model="building"/>
	</div>
	
	@livewire('tickets.chat', ['ticketId' => $ticket->id])

</div>
