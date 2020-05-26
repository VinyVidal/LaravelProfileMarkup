{{--
    Image file selector + image preview template
--}}

{{--                   PARAMETERS 
  * string   @name -> Name of the html element
    string   @placeholder -> Picture to be displayed by default
    array    @attributes -> Array of html element | ['attribute' => 'value']
    string   @label -> Field label text, activates label for the field
    string   @sub -> Subtitle text for the field
    string   @subClass -> Subtitle text css class
    string   @class -> CSS class of the picture
    
    *required
--}}

@php
    $attributes['id'] = 'photo';
    $attributes['accept'] = 'image/*';
    
@endphp

<div class="form-group">

    @if (isset($label))
        <p>{{ $label }}</p>
    @endif

    <div class="text-center">
        <img id="profile-picture" src="{{ $placeholder ?? asset('img/default-avatar.png') }}" alt="default-avatar" class="img-thumbnail {{ $class ?? null }}">
    </div>

    {!! Form::file($name, $attributes ?? null) !!}

    @if (isset($sub))
        <small class="form-text {{ $subClass ?? 'text-muted' }}">{{ $sub }}</small>
    @endif
</div>