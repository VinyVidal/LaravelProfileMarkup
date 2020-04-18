{{--
    Template for error messages display
--}}

{{--                   PARAMETERS 
    array    @fields -> Array strings, each one being the field name which will notify error messages
    string   @class -> Class of the error message alert (totally custom)
    
--}}

@php
    $fields = $fields ?? [];
    $class = $class ?? 'alert alert-danger';
@endphp

@foreach ($fields as $f) 
    @error($f)
        <div class="{{ $class }}">
            {{ $message }}
        </div>
    @enderror
@endforeach