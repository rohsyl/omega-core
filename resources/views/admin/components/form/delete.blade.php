{{ Form::open(['url' => $url, 'method' => 'DELETE', 'role'=>'form', 'class'=> 'destroy d-inline', 'id'=>'delete']) }}
    <button type="submit" @if(isset($attributes['class'])) class="{{ $attributes['class'] }}" @endif /><i class="fas fa-trash"></i>  @if(isset($attributes['label'])) {{ $attributes['label'] }} @endif</button>
{{ Form::close() }}
