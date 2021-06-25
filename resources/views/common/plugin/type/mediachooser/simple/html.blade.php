@php
    use rohsyl\OmegaCore\Models\Media;

    $id = isset($value) && !empty($value) ? $value : null;
    $media = new Media();
    $name = '';
    $title = '';
    $description = '';
    if(isset($id) && !empty($id))
    {
        $media = Media::find($id);
        if(isset($media)){
            $name = $media->name;
            $title = $media->title;
            $description = $media->description;
        }
    }
    $allowedType = json_encode($param['type']);
@endphp

<div class="media {{ $uid }}-media">
    @if($param['preview'])
        <div class="mr-3" id="{{ $uid }}-media-preview">
            @if(isset($media) && isset($media->id))
                @if($media->media_type == Media::MT_PICTURE)
                    <img class="media-object" src="{{ $media->getThumbnail(120, 85) }}" alt="Thumbnail" width="120px"/>
                @elseif($media->media_type == Media::MT_FOLDER)
                    <i class="media-object fa fa-3x fa-folder"></i>
                @elseif($media->media_type == Media::MT_MUSIC)
                    <i class="media-object fa fa-3x fa-music"></i>
                @elseif($media->media_type == Media::MT_VIDEO)
                    <i class="media-object fa fa-3x fa-video"></i>
                @elseif($media->media_type == Media::MT_DOCUMENT || $media->media_type == Media::MT_OTHER)
                    <i class="media-object fa fa-3x fa-file"></i>
                @elseif($media->media_type == Media::MT_VIDEO_EXT)
                    @php
                        $thumbnail = '';
                        if(isset($id)){
                            /*$media = new \Omega\Utils\Entity\VideoExternal($media);
                            $thumbnail = $media->getVideoThumbnail();*/
                        }
                    @endphp
                    @if(!empty($thumbnail))
                        <img class="media-object" src="{{ $thumbnail }}" alt="Thumbnail" width="120px"/>
                    @else
                        <span class="media-object">No thumbnail</span>
                    @endif
                @endif
            @else
                <i class="media-object fa fa-3x fa-file"></i>
            @endif
        </div>
    @endif
    <div class="media-body">
        <p class="media-heading font-weight-bold" id="{{ $uid }}-media-name">
            {{ isset($title) && !empty($title) ? $title : $name }}
        </p>

        <div id="{{ $uid }}-media-description">
            @if(isset($description) && !empty($description))
                <p>{{ $description }}</p>
            @endif
        </div>

        <button class="btn btn-primary btn-sm" id="{{ $uid }}-chooser">Choose</button>
        <button class="btn btn-outline-danger btn-sm" id="{{ $uid }}-deleter">Delete</button>
        <input value="{{ $id }}" id="{{ $uid }}-media-id" name="{{ $uid }}-media-id" type="hidden">
    </div>
</div>
<script>
    $(function() {
        $("#{{ $uid }}-chooser").rsMediaChooser({
            multiple: false,
            allowedMedia: {!! $allowedType !!},
            doneFunction: function (data) {
                console.log(data);
                var t = data.media_type;
                var title = data.title;
                var name = data.name;
                var description = data.description;
                $("#{{ $uid }}-media-id").val(data.id);
                $("#{{ $uid }}-media-name").html(title !== undefined && title !== '' && title != null ? title : name);

                $("#{{ $uid }}-media-description").empty();
                if(description !== undefined && description !== '' && description != null){
                    $("#{{ $uid }}-media-description").html('<p>' + description + '</p>');
                }

                @if($param['preview'])
                var html = '<i class="media-object fa-3x ' + data.icon + '"></i>';
                if(data.media_type) {
                    html = '<img class="media-object" src="' + data.url + '?w=120&h=85" alt="' + data.name + '" width="120px"/>';
                }
                $("#{{ $uid }}-media-preview").html(html);
                @endif
            }
        });
        $("#{{ $uid }}-deleter").click(function(){
            var $id = $("#{{ $uid }}-media-id");
            if($id.val() !== "" || $id.val() != null){
                $("#{{ $uid }}-media-name").empty();
                $("#{{ $uid }}-media-preview").empty();
                $id.val("null");
            }
            return false;
        });
    });
</script>
<style>

    .{{ $uid }}-media .media-object{
        min-width: 120px;
        text-align: center;
    }
</style>