@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 dark:text-green-500']) }}>
        {{ $status }}
    </div>
@endif
