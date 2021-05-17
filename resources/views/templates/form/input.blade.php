{{--
    Basic input field template
--}}

{{--                   PARAMETERS 
  * string   @name -> Name of the html element
    string   @value -> Field preset value
    string   @type -> Determine the type attribute of the element, possible values are 'text' or 'email'
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
        $attributes['class'] = 'form-control '.$class;
    else
        $attributes['class'] = 'form-control';
    
    $type = $type ?? 'text';
@endphp

<div class="form-group">

    @if (isset($label))
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