@if ($list)
    <li class="list__item">
        <a href="{{ url($link) }}"
            class="{{ $classLink }} {{ request()->is('$link') ? 'is-active' : '' }}">{{ $linkTitle }}</a>
    </li>
@else
    <a href="{{ url($link) }}"
        class="{{ $classLink }} {{ request()->is('$link') ? 'is-active' : '' }}">{{ $linkTitle }}</a>
@endif
<p class="text-white">
