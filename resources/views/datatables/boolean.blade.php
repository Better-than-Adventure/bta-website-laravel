@props(['value'])
@if($value)
<span class="badge bg-success">true</span>
@else
<span class="badge bg-danger">false</span>
@endif
