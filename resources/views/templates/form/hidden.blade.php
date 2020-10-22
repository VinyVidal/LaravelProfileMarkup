{{--
    Hidden input field template
--}}

{{--                   PARAMETERS 
  * string   @name -> Name of the html element
    string   @value -> Field preset value
    array    @attributes -> Array of html element | ['attribute' => 'value']
    string   @class -> Html element class
    
    *required
--}}

@php
    $attributes['id'] = $attributes['id'] ?? $name;
    if(isset($class))
        $attributes['class'] = 'form-control '.$class;
    else
        $attributes['class'] = 'form-control';
    
@endphp

<div class="form-group">
    {!! Form::hidden($name, $value ?? null, $attributes ?? null) !!}
</div>