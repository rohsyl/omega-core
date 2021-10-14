<textarea id="{{ $uid }}" name="{{ $uid }}" class="codemirror-editor">{{ isset($value) ? $value : '' }}</textarea>
<script>
    @php $sluguid = \Illuminate\Support\Str::slug($uid, '_'); @endphp
    var textarea = document.getElementById('{{ $uid }}');
    var editor{{ $sluguid }} = CodeMirror.fromTextArea(textarea, {
        lineNumbers: true
    });
    $(textarea).data('codemirror', editor{{ $sluguid }});
</script>