@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-2 rounded-xl text-sm font-medium text-beige-700 bg-beige-100 transition-all duration-200'
            : 'inline-flex items-center px-3 py-2 rounded-xl text-sm font-medium text-beige-500 hover:text-beige-700 hover:bg-beige-50 transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
