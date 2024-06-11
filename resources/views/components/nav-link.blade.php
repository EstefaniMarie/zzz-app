@props(['active','route','icon'])

@php
    // open hover
    $classes = $active ?? false ? 'active' : '';
@endphp

<li {{ $attributes->merge(['class' => $classes]) }}>
    <a href="{{ $route }}">
        <i class="{{ $icon }}"></i>
        <span class="menu-title" data-i18n="">{{ $slot }}</span>
    </a>
</li>
