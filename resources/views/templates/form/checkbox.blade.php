{{-- 
  * string   @name -> Name of the html element
    string   @value -> Checkbox internal value
    bool     @checked -> Whether the checkbox is checked or unchecked
    array    @attributes -> Array of html element | ['attribute' => 'value']
    string   @label -> Field label text, activates label for the field
    string   @sub -> Subtitle text for the field
    string   @subClass -> Subtitle text css class
    string   @class -> Html element class
    
    *required
--}}

@php
    $attributes['id'] = $attributes['id'] ?? $name;
    if(isset($class))
        $attributes['class'] = 'form-check-input '.$class;
    else
        $attributes['class'] = 'form-check-input';
    
@endphp

<div class="form-group form-check">

    {!! Form::checkbox($name, $value ?? null, $checked ?? false, $attributes ?? null) !!}

    @if (isset($label))
        <label class="form-check-label" for="{{ $attributes['id'] }}">{{ $label }}</label>        
    @endif

    @if (isset($sub))
        <small class="form-text {{ $subClass ?? 'text-muted' }}">{{ $sub }}</small>
    @endif

    
</div>