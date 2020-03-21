@php
    $attributes['id'] = $attributes['id'] ?? $name;
    $attributes['rows'] = $rows ?? 3;
    if(isset($class))
        $attributes['class'] = 'form-control '.$class;
    else
        $attributes['class'] = 'form-control';
    
@endphp

<div class="form-group">

    @if ($label)
        {!! Form::label($attributes['id'], $label) !!}
    @endif

        {!! Form::textarea($name, $value ?? null, $attributes ?? null) !!}

    @if (isset($sub))
    <small class="form-text {{ $subClass ?? 'text-muted' }}">{{ $sub }}</small>
    @endif
</div>