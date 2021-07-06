<?php
namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type\MediaChooser;


use Illuminate\Support\Arr;
use rohsyl\OmegaCore\Models\Media;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TypeEntry;

class MediaChooser extends TypeEntry
{

    private $param = null;
    private $defaults = array(
        'multiple' => false,
        'preview' => false,
        'type' => array(
            Media::MT_FOLDER, Media::MT_PICTURE, Media::MT_DOCUMENT, Media::MT_MUSIC, Media::MT_VIDEO, Media::MT_OTHER, Media::MT_VIDEO_EXT
        )
    );

    private function getMCParam() {
        if(!isset($this->param)) {
            $up = $this->getParam();
            $this->param = array_merge($this->defaults, isset($up) ? $up : []);
        }
        return $this->param;
    }


    public function getHtml()
    {
        $param = $this->getMCParam();
        $uid = $this->getUniqId();

        if(!$param['multiple']){
            $value = $this->getValue();
            return view('omega::common.plugin.type.mediachooser.simple.html', compact('value', 'uid', 'param'));
        }
        else {
            $medias = $this->getMultipleMediaAsArray($this->getObjectValue());
            return view('omega::common.plugin.type.mediachooser.multiple.html', compact('medias', 'uid', 'param'));
        }

    }

    public function getPostedValue()
    {
        $param = $this->getMCParam();
        $uid = $this->getUniqId();
        if(!$param['multiple']){
            if($this->existsPost($uid.'-media-id')) {
                return $this->getPost($uid . '-media-id');
            }
            return null;
        }
        else{

            $medias = [];
            if($this->existsPost($uid.'-media-id') && $this->existsPost($uid.'-media-order')){
                foreach ($this->getPost($uid.'-media-id') as $i => $type) {
                    $item = array(
                        'id' => $this->getPost($uid.'-media-id')[$i],
                        'order' => $this->getPost($uid.'-media-order')[$i]
                    );
                    if($this->getPost($uid.'-media-delete')[$i] == false && isset($item)) {
                        $medias[] = $item;
                    }
                }
                $medias = array_values(Arr::sort($medias, function($media) {
                    return $media['order'];
                }));
            }

            return json_encode($medias);
        }
    }

    public function getObjectValue()
    {
        $param = $this->getMCParam();
        $v = $this->getValue();

        if(!$param['multiple']){
            if(isset($v)) {
                return Media::find($v);
            }
        }
        else {
            $values = isset($v) ? json_decode($v, true) : [];
            $medias = collect();
            foreach($values as $value) {
                $media = Media::find($value['id']);
                if(isset($media)){
                    $medias[] = $media;
                }
            }
            return $medias;
        }
        return null;
    }

    private function getMultipleMediaAsArray($medias) {
        $out = [];
        foreach($medias as $media) {
            $mediaItem = array(
                'id' => $media->id,
                'name' => $media->name,
                'title' => $media->title,
                'description' => $media->description,
                'type' => $media->media_type,
            );
            if($media->media_type == Media::MT_PICTURE){
                $mediaItem['thumbnail'] = $media->getThumbnail(120, 68);
            }
            if($media->media_type == Media::MT_VIDEO_EXT){
                /*$media = new \Omega\Utils\Entity\VideoExternal($media);
                $mediaItem['thumbnail'] = $media->getVideoThumbnail();*/
            }
            $out[] = $mediaItem;
        }
        return $out;
    }

    public function getDoc()
    {
        // TODO: Implement getDoc() method.
    }
}