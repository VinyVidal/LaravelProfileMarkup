@php
    if(isset($class))
        $attributes['class'] = 'btn '.$class;
    else
        $attributes['class'] = 'btn btn-primary';
@endphp

{!! Form::submit($name, $attributes) !!}

@if (isset($sub))
<small class="form-text {{ $subClass ?? 'text-muted' }}">{{ $sub }}</small>
@endif