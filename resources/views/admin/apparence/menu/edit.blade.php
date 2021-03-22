@extends('omega::admin.default')

@section('page-header')
    {{ __('Menus') }}
@endsection

@section('actions')
@endsection


@php
    $overflow = 150;
@endphp

@section('content')

    {{ Form::oback() }}

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="dd" id="nestable" data-menu-id="{{ $menu->id }}">
                        @if($menu->json != '[]')

                            @php
                                function genHtmlAdmin($array) {
                                    if(!isset($array)){
                                    return '<ol class="dd-list">'.__('No element').'</ol>';
                                    }

                                    $html = '<ol class="dd-list">';
                                    $length = count($array);
                                    //foreach($array as $row)
                                    for ($i = 0; $i < $length; $i++)
                                    {
                                        $html .= '
                                            <li class="dd-item">
                                                <a class="remove" href="#">
                                                    <span class="glyphicon glyphicon-trash" style="float:right; position:absolute; right:5px; top:7px; cursor:pointer;"></span>
                                                </a>
                                                <a class="edit" data-url="'.$array[$i]['url'].'" data-title="'.$array[$i]['title'].'" data-isnewtab="' . (isset($array[$i]['isnewtab']) ? $array[$i]['isnewtab'] : 'false') . '" href="#">
                                                    <span class="glyphicon glyphicon-cog" style="float:right; position:absolute; right:25px; top:7px; cursor:pointer;"></span>
                                                </a>
                                                <div class="dd-handle">'.$array[$i]['title'].' ' .(isset($array[$i]['isnewtab']) && $array[$i]['isnewtab'] ? '<i class="fa fa-external-link"></i>' : ''). '</div>';
                                        if(array_key_exists('children', $array[$i]))
                                        {
                                            $html .= genHtmlAdmin($array[$i]['children']);
                                        }
                                        $html .= '</li>';
                                    }
                                    $html .= '</ol>';
                                    return $html;
                                    //array_key_exists ( mixed $key , array $array )
                                }
                            @endphp

                            {!! genHtmlAdmin(json_decode($menu->json, true)) !!}
                        @else

                            <ol class="dd-list">{{ __('No element') }}</ol>

                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            {{ __('All pages') }}
                        </div>
                        <div class="card-body">
                            <div style="height:{{ $overflow }}px;overflow:auto;" id="list-pages">
                                Loading ...
                            </div>
                            <br />
                            <p><input type="submit" data-action="add_page" class="btn btn-primary btn-block btn-add-element" value="{{ __('Add element') }}" /></p>
                            <p><input name="checkAll" id="chkAll" type="checkbox" /> <label for="chkAll">{{ __('Toggle all') }}</label></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            {{ __('External link') }}
                        </div>
                        <div class="card-body">
                            <div style="height:{{ $overflow }}px;overflow:auto;">
                                <input type="text" id="link" class="form-control" placeholder="http://" /><br />
                                <input type="text" id="title" class="form-control" placeholder="Title" />
                            </div><br />
                            <p><input type="submit" data-action="add_link" class="btn btn-primary btn-block btn-add-element" value="{{ __('Add element') }}" /></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            {{ __('Webparts') }}
                        </div>
                        <div class="card-body">
                            <div style="height:{{ $overflow }}px;overflow:auto;" id="list-webpart">
                                {{--
                                @foreach($webparts as $m)
                                    @foreach($m[1] as $action): }}
                                <div>
                                    <input name="module[]" type="checkbox" data-title="{{ $m[0] }} - {{ ucfirst($action) }}" data-url="{{ PController::Url($m[0], $action) }}" />
                                    <label >{{ $m[0] }} - {{ ucfirst($action) }}</label>
                                </div>
                                    @endforeach
                                @endforeach
                                --}}
                            </div><br />
                            <p><input type="submit" data-action="add_module" class="btn btn-primary btn-block btn-add-element" value="{{ __('Add element') }}" /></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['url' => route('omega.admin.appearance.menus.store'), 'method' => 'post']) }}

                    {{ Form::otext('name', null, ['label' => __('Title')]) }}
                    {{ Form::otextarea('description', null, ['label' => __('Description')]) }}
                    {{ Form::ocheckbox('is_main', null, ['label' => __('Is Main Menu')]) }}
                    {{ Form::oselect('member_group_id', $member_groups, null, ['label' => __('Member group')]) }}

                    {{ Form::osubmit() }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>


    <script>
        $(function(){
            function _serialize(ol) {
                var data;
                step  = function(level)
                {
                    var array = [ ],
                        items = level.children('li');
                    items.each(function() {

                        var li   = $(this),
                            item = $.extend({}, li.find('a.edit').first().data()),
                            sub  = li.children('ol');
                        if (sub.length) {
                            item.children = step(sub);
                        }
                        array.push(item);
                    });
                    return array;
                };
                data = step(ol);
                return data;
            }

            var $btnSave = $('#edit');
            var $selectLang = $('#langs');

            $btnSave.click(function(){
                var name = $('#name').val();
                var description = $('#description').val();
                var membergroup = $('#membergroup').val();
                var json = _serialize($('#nestable > ol'));
                var menu_id = $('#nestable').data('menu-id');
                var isMain = $('#isMain').is(':checked') ? 1 : 0;
                json = String(JSON.stringify(json));
                var lang = $('#lang').val();

                var url = route('menu.update', {id : menu_id});
                var args = {
                    name : name,
                    description : description,
                    json : json,
                    membergroup : membergroup,
                    isMain : isMain,
                    lang: lang
                };
                omega.ajax.query(url, args, omega.ajax.POST, function(data){
                    if(data.success){
                        omega.notice.success(undefined, __('Menu updated'));
                    }
                    else
                        omega.notice.error(undefined, __('Error while saving menu'));
                }, function(err){
                    omega.notice.error(undefined, err);
                }, {dataType: 'json'});
                return false;
            });

            $selectLang.change(function () {
                loadPages();
            });
            loadPages();
            function loadPages(){
                var menu_id = $('#nestable').data('menu-id');
                var langs = $('#lang').val();
                var url = route('menu.edit.pages', {id: menu_id, lang: langs});
                omega.ajax.query(url, {}, omega.ajax.GET, function(html){
                    $('#list-pages').empty().html(html);
                });
            }
        });
    </script>


@endsection

