{{--
    File input template
    May have a customized button (use @customButton) - Requires file-input.js script
    May have a media (image/video) previewer (include media-preview.blade.php) - Requires media-previewer.js script
--}}

{{--                   PARAMETERS 
  * string   @name -> Name of the html element
  * string   @id -> ID of the html element
    array    @customButton -> Set of attributes for a custom button to select a file. @id will be used for a <div> element
             * string   @customButton['id'] -> 
               string   @customButton['value'] -> 
    array    @attributes -> Array of html element | ['attribute' => 'value']
    string   @label -> Input label text, activates label for the field
    string   @sub -> Subtitle text for the input
    string   @subClass -> Subtitle text css class
    string   @class -> CSS class of the file input
    
    *required
--}}

@php
    if(isset($customButton))
    {
        $attributes['class'] = 'hidden';
        $attributes['id'] = $id.'Input';
        $customButton['id'] = $id;
    }
    else {
        $attributes['class'] = $class ?? null;
        $attributes['id'] = $id;
    }
    $attributes['role'] = 'file-input';
    
@endphp


@if (isset($label))
    <p>{{ $label }}</p>
@endif

@if (isset($customButton))
    <div class="text-center">
        <div id="{{ $customButton['id'] }}" role="file-button" class="{{ $customButton['class'] ?? null }}">{!! $customButton['value'] ?? null !!}</div>
    </div>
@endif

{!! Form::file($name, $attributes ?? null) !!}

@if (isset($sub))
    <small class="form-text {{ $subClass ?? 'text-muted' }}">{{ $sub }}</small>
@endif