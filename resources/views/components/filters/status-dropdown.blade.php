<x-filters.dropdown>
    
    <x-slot name="label">
        Status
    </x-slot>

    <x-slot name="title">     
        @php
            $dropdownTitle = '';
            if (isset($currentStatus)) {
                if ($currentStatus->count() > 1 && $currentStatus->count() != $statuses->count()) {
                    foreach($currentStatus as $key => $status)
                        if ($key == $currentStatus->count() - 1)
                            $dropdownTitle .= $status->name;
                        else
                            $dropdownTitle .= $status->name . ' & ';
                } else if ($currentStatus->count() === $statuses->count())
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

        $all = '';
        foreach($statuses as $v)
            if ($v == $statuses->last())
                $all .= $v->id;
            else
                $all .= $v->id . ',';
        
    @endphp

    <x-filters.dropdown-item href="{{ $link }}status={{ $all }}" 
        :active="request('status') === $all"
    >
        All
    </x-filters.dropdown-item>

    <x-filters.dropdown-item href="{{ $link }}" 
        :active="request('status') === null"
    >
        Open & Pending
    </x-filters.dropdown-item>

    @foreach($statuses as $status)
        <x-filters.dropdown-item 
            href="{{ $link }}status={{ $status->id }}"
            :active="request('status') == $status->id"
        >
            {{ ucwords($status->name) }}
        </x-filters.dropdown-item>
    @endforeach

</x-filters.dropdown>