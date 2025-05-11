@props([
    'value' => null,
      'label',
      'name',
      'id',
      'required' => false,
      'checked' => false])

<div class="mt-1">
    <label class="form-check-label">
        <input @if($required) required="required" @endif name="{{$name}}" type="checkbox" {{ $attributes->merge(['class' => 'form-check-input']) }} id="{{$id}}" value="{{$value}}" @if(filled($checked))checked @endif/>
    {{$label}}
    </label>
</div>
@if($errors->get($id))
    <div class="text-danger">{{ $error }}</div>
@endif
