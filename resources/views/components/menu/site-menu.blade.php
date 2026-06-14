@foreach($items as $item)
    <a {{ $item['attributes'] }}>{{ $item['label'] }}</a>
@endforeach
