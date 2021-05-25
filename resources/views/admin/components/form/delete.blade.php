@php $formClass = $attributes['form-class'] ?? 'd-inline' @endphp
{{ Form::open(['url' => $url, 'method' => 'DELETE', 'role'=>'form', 'class'=> 'destroy ' . $formClass , 'id'=>'delete']) }}
    <button type="submit" @if(isset($attributes['class'])) class="{{ $attributes['class'] }}" @endif /><i class="@if(isset($attributes['icon'])) {{ $attributes['icon'] }} @else fas fa-trash @endif "></i>  @if(isset($attributes['label'])) {{ $attributes['label'] }} @endif</button>
{{ Form::close() }}
