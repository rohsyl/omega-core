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
        return $this->hasMany(Media::class, 'parent_id');
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function group() {
        return $this->belongsTo(Group::class);
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
