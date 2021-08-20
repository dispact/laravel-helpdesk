<x-filters.dropdown>
    
    <x-slot name="label">
        Staff
    </x-slot>

    @php
        if(empty(request()->except('staff')))
            $link = '?' . http_build_query(request()->except('staff'));
        else 
            $link = '?' . http_build_query(request()->except('staff')) . '&';

        if(isset($currentStaff) && $currentStaff != '') {
            $title = $currentStaff->user->name;
        } elseif (request('staff') == 'all') {
            $title = 'All';
        } else {
            $title = 'Me';
        }
    @endphp

    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <x-filters.dropdown-item href="{{ $link }}staff=all" 
        :active="request('staff') === 'all'"
    >
        All
    </x-filters.dropdown-item>

    @foreach($staff as $staff)
        <x-filters.dropdown-item 
            href="{{ $link }}staff={{ $staff->id }}"
            :active="($staff->id == auth()->user()->id && request('staff') == null) || (request('staff') == $staff->id)"
        >
            {{ ucwords($staff->user->name) }}
        </x-filters.dropdown-item>
    @endforeach

</x-filters.dropdown>