<x-dropdown>
    
    <x-slot name="label">
        Status
    </x-slot>

    <x-slot name="title">     
        @php
            $dropdownTitle = '';
            if (isset($currentStatus)) {
                if ($currentStatus->count() > 1 && $currentStatus->count() != 3) {
                    foreach($currentStatus as $key => $status)
                        if ($key == $currentStatus->count() - 1)
                            $dropdownTitle .= $status->name;
                        else
                            $dropdownTitle .= $status->name . ' & ';
                } else if ($currentStatus->count() === 3)
                    $dropdownTitle = 'All';
                else
                    $dropdownTitle = $currentStatus[0]->name;
            } else {
                $dropdownTitle = 'Open & Pending';
            }
        @endphp
        {{ $dropdownTitle }}
    </x-slot>

    @php
        if(empty(request()->except('status')))
            $link = '?' . http_build_query(request()->except('status'));
        else 
            $link = '?' . http_build_query(request()->except('status')) . '&';
    @endphp

    <x-dropdown-item href="{{ $link }}status=1,2,3" 
        :active="request('status') === null"
    >
        All
    </x-dropdown-item>

    @foreach($statuses as $status)
        <x-dropdown-item 
            href="{{ $link }}status={{ $status->id }}"
            :active="request('status') == $status->id"
        >
            {{ ucwords($status->name) }}
        </x-dropdown-item>
    @endforeach

</x-dropdown>