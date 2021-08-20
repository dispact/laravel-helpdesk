<x-filters.dropdown>
    
    <x-slot name="label">
        Building
    </x-slot>

    @php
        if(empty(request()->except('building')))
            $link = '';
        else 
            $link = '?' . http_build_query(request()->except('building')) . '&';

        if(isset($currentBuilding) && $currentBuilding != '') {
            $title = $currentBuilding->name;
        } elseif (request('building') == 'all') {
            $title = 'All';
        } else {
            $title = $currentStaffBuilding->name;
        }
    @endphp

    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <x-filters.dropdown-item href="{{ $link }}?building=all" 
        :active="request('building') === 'all'"
    >
        All
    </x-filters.dropdown-item>

    @foreach($buildings as $building)
        <x-filters.dropdown-item 
            href="{{ $link }}?building={{ $building->id }}"
            :active="($building->id == $currentStaffBuilding->id && request('building') == null) || (request('building') == $building->id)"
        >
            {{ ucwords($building->name) }}
        </x-filters.dropdown-item>
    @endforeach

</x-filters.dropdown>