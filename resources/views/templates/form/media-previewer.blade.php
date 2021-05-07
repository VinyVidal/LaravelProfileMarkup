{{--
    Media preview to be used in junction with file.blade.php template
    After a media file is chosen, this preview will render the selected image in the page
--}}

{{--                   PARAMETERS 
  * string   @fileInputId -> The exact ID of related file input
    string   @label -> Input label text, activates label for the field
    string   @defaultvalue -> default image src
    string   @sub -> Subtitle text for the input
    string   @subClass -> Subtitle text css class
    string   @class -> CSS class of the file input
    
    *required
--}}

@php
    $id = $fileInputId.'Preview';
@endphp

@if (isset($label))
    <p>{{ $label }}</p>
@endif

    <div class="preview-container @if(isset($defaultValue)) d-block @endif text-center">
        <img src="{{ $defaultValue ?? '' }}" id="{{ $id }}" role="media-previewer" class="preview {{ $class ?? null }}"}}>
        <button type="button" class="close" aria-label="Close" title="Remover mídia">
            <span class="preview-close text-body" aria-hidden="true" id="{{ $id.'Close' }}">&times;</span>
        </button>
    </div>

@if (isset($sub))
    <small class="form-text {{ $subClass ?? 'text-muted' }}">{{ $sub }}</small>
@endif