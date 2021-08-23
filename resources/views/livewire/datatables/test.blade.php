@php
    dd(json_decode(json_encode($row), true));
    $key = array_key_first(json_decode(json_encode($row), true));
@endphp
<div id="{{ array_key_first(json_decode(json_encode($row), true)) }}">{{ $value }}</div>