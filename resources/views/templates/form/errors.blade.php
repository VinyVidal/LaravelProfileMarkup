{{--
    Template for error messages display
--}}

{{--                   PARAMETERS 
    array    @fields -> Array strings, each one being the field name which will notify error messages
    string   @class -> Class of the error message alert (totally custom)
    string   @bag -> Name of the error bag
--}}

@php
    $fields = $fields ?? [];
    $class = $class ?? 'alert alert-danger';
    $bag = $bag ?? 'default';
@endphp

@foreach ($fields as $f) 
    @error($f, $bag)
        <div class="{{ $class }}">
            {{ $message }}
        </div>
    @enderror
@endforeach