<button type="button" class="btn btn-block btn-primary d-md-none mb-10" data-toggle="class-toggle"
        data-target=".js-tasks-nav" data-class="d-none d-md-block"> {{ $label ?? 'Menu' }}
</button>
<div class="js-tasks-nav d-none d-md-block">
    {{ $slot }}
</div>
