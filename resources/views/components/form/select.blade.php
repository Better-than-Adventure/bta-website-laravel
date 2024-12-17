@props(['label', 'id'])

@if(filled($label))
<div class="form-floating mb-3">
@endif
    <select {{ $attributes->merge(['class' => 'form-select']) }} id="{{$id}}">
        {{ $slot }}
    </select>
@if(filled($label))
</div>
@endif
@if($errors->get($id))
    <div class="text-danger">{{ $error }}</div>
@endif
