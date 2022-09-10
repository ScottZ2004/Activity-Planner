@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 text-lg font-large leading-5 text-white font-sans'
            : 'inline-flex items-center px-1 pt-1 text-lg font-large leading-5 text-white font-sans';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
