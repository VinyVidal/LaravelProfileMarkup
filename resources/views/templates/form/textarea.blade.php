{{--
    Textarea input field template
--}}

{{--                   PARAMETERS 
  * string   @name -> Name of the html element
    string   @value -> Field preset value
    array    @attributes -> Array of html element | ['attribute' => 'value']
    string   @label -> Field label text, activates label for the field
    string   @sub -> Subtitle text for the field
    string   @subClass -> Subtitle text css class
    string   @class -> Html element class
    
    *required
--}}

@php
    $attributes['id'] = $attributes['id'] ?? $name;
    $attributes['rows'] = $rows ?? 3;
    if(isset($class))
        $attributes['class'] = 'form-control '.$class;
    else
        $attributes['class'] = 'form-control';
    
@endphp

<div class="form-group">

    @if (isset($label))
        {!! Form::label($attributes['id'], $label) !!}
    @endif

        {!! Form::textarea($name, $value ?? null, $attributes ?? null) !!}

    @if (isset($sub))
    <small class="form-text {{ $subClass ?? 'text-muted' }}">{{ $sub }}</small>
    @endif
</div>