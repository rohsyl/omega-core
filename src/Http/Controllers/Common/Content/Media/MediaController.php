<?php


namespace rohsyl\OmegaCore\Http\Controllers\Common\Content\Media;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use rohsyl\OmegaCore\Models\Media;

class MediaController extends Controller
{

    public function __invoke(Media $media, string $name)
    {
        if($media->name !== $name) {
            return abort(404);
        }

        // TODO : resize media if picture and if w and h provided in querystring

        $force_download = request()->has('download');

        $filename = $media->name . '.' . $media->ext;
        $mimeType = Storage::mimeType($media->path);
        $type = $force_download ? ' attachment;' : 'inline;';
        $headers = [
            'Content-Type' => $mimeType,
            'Content-Disposition' => $type .' filename = "' . $filename . '"',
        ];

        return Storage::download($media->path, $filename, $headers);
    }
}