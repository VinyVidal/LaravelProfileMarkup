{{--
    Form submit button template
--}}

{{--                   PARAMETERS 
  * string   @name -> Name of the html element
    array    @attributes -> Array of html element | ['attribute' => 'value']
    string   @sub -> Subtitle text for the field
    string   @subClass -> Subtitle text css class
    string   @class -> Html element class
    
    *required
--}}

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