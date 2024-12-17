@props([
    'value' => null,
     'type' => 'text',
     'placeholder' => null,
      'label' => null,
      'id' => Str::uuid(),
      'name' => '',
      'required' => false,
      'for' => null])

@if($errors->has($id))
    @foreach($errors->get($id) as $error)

    @endforeach()
    <div class="text-danger">{{ $error }}</div>
@endif

@if(filled($label))
    <div class="form-floating">
@endif
    @if($type == "textarea")
        <textarea name="{{$name}}" @if($required) required="required" @endif  @if($for) for="{{$for}}" @endif  type="{{$type}}" {{ $attributes->merge(['class' => $errors->has($id) ? 'form-control is-invalid' : 'form-control']) }} id="{{$id}}" @if(filled($placeholder))placeholder="{{$placeholder}}" @endif @if(filled($value))value="{{$value}}" @endif/>
    @else
        <input name="{{$name}}" @if($required) required="required" @endif  type="{{$type}}" {{ $attributes->merge(['class' => $errors->has($id) ? 'form-control is-invalid' : 'form-control']) }} id="{{$id}}" @if(filled($placeholder))placeholder="{{$placeholder}}" @endif @if(filled($value))value="{{$value}}" @endif/>
    @endif
    @if(filled($label))
    <label for="floatingInput">{{$label}}</label>
    </div>
@endif
