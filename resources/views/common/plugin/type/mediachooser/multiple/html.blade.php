<div>
    <button class="btn btn-primary btn-sm" id="{{ $uid }}-media-chooser"><i class="fas fa-plus"></i> {{ __('Choose files') }}</button>
    <div id="{{ $uid }}-media-container">
    </div>
</div>
<script language="JavaScript">
    $(function(){
        var hasPreview = {{ $param['preview'] ? 'true' : 'false' }};
        var medias = @json($medias);
        var idDeleter = '{{ $uid }}-deleter';
        var $body = $( "body" );
        var $btnAdd = $('#{{ $uid }}-media-chooser');
        var $mediaContainer = $('#{{ $uid }}-media-container');

        initList(medias);

        $body.delegate( '.'+idDeleter, 'click', function() {
            var $this = $(this);
            var modalId = omega.modal.confirm('Do you really want to delete this ?',function(yes){
                if(yes){
                    var i = $this.data('index');
                    $('input[name="{{ $uid }}-media-delete[' + i + ']').val(1);
                    $this.parent().parent().hide();
                    omega.modal.hide(modalId);
                }
            });
            return false;
        });


        $btnAdd.rsMediaChooser({
            multiple: true,
            allowedMedia: @json($param['type']),
            doneFunction: function (data) {

                console.log(data);

                // has selected more than one media
                if($.isArray(data))
                {
                    for(var i = 0; i < data.length; i++)
                    {
                        addMedia(data[i]);
                    }
                }
                else
                {
                    addMedia(data);
                }
            }
        });

        function initList(medias){
            for(var i = 0; i < medias.length; i++){
                addMedia(medias[i]);
            }
        }

        function addMedia(media) {
            var i = countItem();
            var type = media.type;
            var title = media.title;
            var name = media.name;
            var description = media.description;
            var headingText = title !== undefined && title !== '' && title != null ? title : name;

            var logo = '';
            if(media.type === 'video_ext'){
                logo = '<i class="fa fa-play"></i> ';
            }

            var html = '<div class="media {{ $uid }}-media">';
            html += getPreview(media);
            html += '<div class="media-body">';
            html += '<button class="btn btn-outline-danger btn-sm {{ $uid }}-deleter" data-index="'+i+'"><i class="fas fa-trash"></i></button>';
            html += '<p class="media-heading font-weight-bold" id="{{ $uid }}-media-name">' + logo + headingText + '</p>';
            html += '<div id="{{ $uid }}-media-description">';
            if(description !== undefined && description !== '' && description != null) {
                html += '<p>' + description + '</p>';
            }
            html += '</div>'; // end.media-description


            html += '<input type="hidden" name="{{ $uid }}-media-id['+i+']" value="'+media.id+'">' +
                '<input type="hidden" name="{{ $uid }}-media-type['+i+']" value="'+type+'">' +
                '<input type="hidden" name="{{ $uid }}-media-order['+i+']" value="'+i+'">' +
                '<input type="hidden" name="{{ $uid }}-media-delete['+i+']" value="0">';

            html += '</div>'; // end.media-body
            html += '</div>'; // end.media

            $mediaContainer.append(html);
        }


        function getPreview(media){
            var html = '<div class="mr-3" id="{{ $uid }}-media-preview">';
            if(hasPreview){
                if(media.type === 'picture'){
                    if(media.thumbnail !== undefined) {
                        html += '<img class="media-object" src="' + media.thumbnail + '" alt="Thumbnail" width="120px"/>';
                    }
                    else {
                        html += '<i class="media-object fa fa-3x fa-picture-o"></i>';
                    }
                }
                else if(media.type === 'folder'){
                    html += '<i class="media-object fa fa-3x fa-folder"></i>';
                }
                else if(media.type === 'music'){
                    html += '<i class="media-object fa fa-3x fa-music"></i>';
                }
                else if(media.type === 'video'){
                    html += '<i class="media-object fa fa-3x fa-file-video-o"></i>';
                }
                else if(media.type === 'video_ext'){
                    if(media.thumbnail !== undefined){
                        html += '<img class="media-object" src="'+media.thumbnail+'" alt="Thumbnail" width="120px"/>';
                    }
                    else{
                        html += '<i class="media-object fa fa-3x fa-play"></i>';
                    }
                }
                else{
                    html += '<i class="media-object fa fa-3x fa-file"></i>';
                }
            }
            html += '</div>';
            return html;
        }

        function countItem()
        {
            return $mediaContainer.children().length;
        }



        createSortable();
        function createSortable(){
            var sortable = document.getElementById('{{ $uid }}-media-container');
            Sortable.create(sortable, {
                group: 'sort-{{ $uid }}',
                animation: 150,
                //handle: '.glyphicon-move',
                ghostClass: 'sortable-ghost',  // Class name for the drop placeholder
                draggable: '.{{ $uid }}-media',  // Specifies which items inside the element should be draggable
                // Changed sorting within list
                onEnd: function (/**Event*/evt) {
                    $('#{{ $uid }}-media-container .{{ $uid }}-media').each(function(i) {
                        var $inputOrder = $(this).find('input[name^="{{ $uid }}-media-order"]');
                        $inputOrder.val(i);
                    });
                },


            });
        }


    });
</script>
<style>
    #{{ $uid }}-media-container{
        margin-top: 15px;
    }
    #{{ $uid }}-media-container .{{ $uid }}-media{
        border-bottom: 1px solid #ddd;
        padding : 10px;
        cursor : move;
        margin-top : 0;
    }

    #{{ $uid }}-media-container .{{ $uid }}-media .media-body{
        padding-top : 10px;
    }

    #{{ $uid }}-media-container .media-object{
        min-width: 120px;
        text-align: center;
    }
    #{{ $uid }}-media-container .{{ $uid }}-deleter{
        float:right;
    }

    .{{ $uid }}-sortable-placeholder{
        height : 100px;
        background-color : #9bc373;
    }
</style>