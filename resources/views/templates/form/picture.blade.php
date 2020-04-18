@php
    $attributes['id'] = 'photo';
    $attributes['accept'] = 'image/*';
    
@endphp

<div class="form-group">

    @if ($label)
        <p>{{ $label }}</p>
    @endif

    <div class="text-center">
        <img id="profile-picture" src="{{ $placeholder ?? asset('img/default-avatar.png') }}" alt="default-avatar" class="img-thumbnail size-m {{ $class ?? null }}">
    </div>

    {!! Form::file($name, $attributes ?? null) !!}

    @if (isset($sub))
        <small class="form-text {{ $subClass ?? 'text-muted' }}">{{ $sub }}</small>
    @endif
</div>