@props(['active', 'title', 'icon'])

@php
    // open hover
    $classes = $active ?? false ? 'active' : '';
@endphp

<li class="nav-item {{ $classes }}">
    <a href="#">
        <i class="{{ $icon }}"></i>
        <span class="menu-title" data-i18n="">{{ $title }}</span>
    </a>
    <ul class="menu-content">
        {{ $slot }}
    </ul>
</li>
