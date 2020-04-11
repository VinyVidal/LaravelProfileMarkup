@php
    $attributes['id'] = $attributes['id'] ?? $name;
    if(isset($class))
        $attributes['class'] = 'form-control '.$class;
    else
        $attributes['class'] = 'form-control';
    
    $type = $type ?? 'text';
@endphp

<div class="form-group">

    @if ($label)
        {!! Form::label($attributes['id'], $label) !!}
    @endif

    @if ($type == 'email')
        {!! Form::email($name, $value ?? null, $attributes ?? null) !!}
    @else
        {!! Form::text($name, $value ?? null, $attributes ?? null) !!}
    @endif

    @if (isset($sub))
        <small class="form-text {{ $subClass ?? 'text-muted' }}">{{ $sub }}</small>
    @endif
    
</div>