@props([
    'sizes'  => [],
    'src',
    'alt'    => '',
    'class'  => 'content_page__img-main',
    'dir'    => 'content',
    'method' => 'cover',
])

@php
    $all     = collect($sizes);
    $main    = $all->last();
    $sources = $all->slice(0, -1);
    [$mainW, $mainH] = explode('x', $main);
@endphp

<picture>
    @foreach($sources as $size)
        @php
            [$w] = explode('x', $size);
            $srcset = intervention($size, $src, $dir, $method);
        @endphp
        @if($srcset)
        <source media="(max-width: {{ $w }}px)"
                srcset="{{ asset($srcset) }}">
        @endif
    @endforeach
    @php $mainSrc = intervention($main, $src, $dir, $method); @endphp
    <img loading="lazy"
         class="{{ $class }}"
         {{ $attributes }}
         src="{{ $mainSrc ? asset($mainSrc) : '' }}"
         alt="{{ $alt }}"
         width="{{ $mainW }}"
         height="{{ $mainH }}">
</picture>
