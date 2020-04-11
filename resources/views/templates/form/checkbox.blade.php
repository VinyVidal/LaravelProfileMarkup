@php
    $attributes['id'] = $attributes['id'] ?? $name;
    if(isset($class))
        $attributes['class'] = 'form-check-input '.$class;
    else
        $attributes['class'] = 'form-check-input';
    
@endphp

<div class="form-group form-check">

    {!! Form::checkbox($name, $value ?? null, $checked, $attributes ?? null) !!}

    @if (isset($label))
        <label class="form-check-label" for="{{ $attributes['id'] }}">{{ $label }}</label>        
    @endif

    @if (isset($sub))
        <small class="form-text {{ $subClass ?? 'text-muted' }}">{{ $sub }}</small>
    @endif

    
</div>