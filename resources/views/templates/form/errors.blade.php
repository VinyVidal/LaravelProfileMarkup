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