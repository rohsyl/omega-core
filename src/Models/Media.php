<?php

namespace rohsyl\OmegaCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    const IMG_404 = 'images/image-not-found.png';

    const TYPE_DIRECTORY = 1;
    const TYPE_FILE = 2;
    const TYPE_EXTERNAL_VIDEO = 3;


    const MT_PICTURE = 'picture';
    const MT_VIDEO = 'video';
    const MT_MUSIC = 'music';
    const MT_DOCUMENT = 'document';
    const MT_OTHER = 'other';
    const MT_FOLDER = 'folder';
    const MT_VIDEO_EXT = 'video_ext';

    const ROOT_DIRECTORY = 'ROOT';
    const PUBLIC_DIRECTORY = 'PUBLIC';


    public $defaultPermissions = [
        'owner_permission' => '1',
        'group_permission' => '1',
        'other_permission' => '1',
        'public_permission' => '1',
    ];

    protected $fillable = [
        'parent_id',
        'type',
        'name',
        'ext',
        'path',
        'title',
        'description',

        'is_system',

        'owner_id',
        'group_id',
        'owner_permission',
        'group_permission',
        'other_permission',
        'public_permission',
    ];

    public function parent() {
        return $this->belongsTo(Media::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(Media::class, 'parent_id')
            ->orderBy('type')
            ->orderBy('name');
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }

    public function getMediaTypeAttribute() {
        $ext = $this->ext;
        if($this->type == self::TYPE_DIRECTORY)
            return self::MT_FOLDER;
        else if($this->type == self::TYPE_EXTERNAL_VIDEO)
            return self::MT_VIDEO_EXT;
        else{
            return media_type_by_ext($ext);
        }
    }

    public function getIconAttribute() {

        $folder_icon_class = 'fas fa-folder';
        $video_icon_class = 'fas fa-file-video';
        $picture_icon_class = 'fas fa-file-image';
        $file_icon_class = 'fas fa-file';
        $music_icon_class = 'fas fa-file-audio';
        $videoext_icon_class = 'fas fa-video';

        switch($this->media_type) {
            case self::MT_FOLDER:
                return $folder_icon_class;
            case self::MT_PICTURE:
                return $picture_icon_class;
            case self::MT_VIDEO:
                return $video_icon_class;
            case self::MT_MUSIC:
                return $music_icon_class;
            case self::MT_DOCUMENT:
                return $file_icon_class;
            case self::MT_VIDEO_EXT:
                return $videoext_icon_class;
            default:
                return $file_icon_class;
        }
    }

    public function getUrlAttribute() {
        return route('omega.common.media', [$this, $this->name]);
    }

    public function getUrlDownloadAttribute() {
        return route('omega.common.media', [$this, $this->name, 'download']);
    }

    /*public function getThumbnail($w, $h, $returnUrl = true)
    {
        $fn = basename($this->path);

        $p = Path::Combine(media_path(), $this->id);
        $fp = Path::Combine($p, $fn);

        $showError = false;

        if(!file_exists($p) || !file_exists($fp)){
            $fp = self::Get404PlaceholderRealPath();
            $p = dirname($fp);
            $showError = true;
            //return self::Get404Placeholder();
        }


        $newFilename = PictureHelper::GetImageName($fp, $w, $h);
        $newFilePath = Path::Combine( $p, $newFilename);
        $newFileUrl = Url::Absolute(Url::Combine( url('media'), $this->id, $newFilename));

        if($showError){
            $newFileUrl = asset('images/' . $newFilename);
        }

        if(!file_exists($newFilePath))
            PictureHelper::Crop($fp, $newFilePath, $w, $h, 100);

        return $returnUrl ? $newFileUrl : $newFilePath;
    }

    public function getWidth()
    {
        if($this->getType() != self::T_PICTURE){
            return 0;
        }

        $path = $this->getRealpath();

        if(!file_exists($this->getRealpath())){
            $path = self::Get404PlaceholderRealPath();
        }

        list($width) = getimagesize($path);
        return $width;
    }

    public function getHeight()
    {
        if($this->getType() != self::T_PICTURE){
            return 0;
        }

        $path = $this->getRealpath();

        if(!file_exists($this->getRealpath())){
            $path = self::Get404PlaceholderRealPath();
        }

        list($width, $height) = getimagesize($path);
        return $height;
    }

    public function __toString()
    {
        return '<a href="'.Url::CombAndAbs(url('/'), $this->path).'", target="_blank">Preview</a>';
    }*/


}
