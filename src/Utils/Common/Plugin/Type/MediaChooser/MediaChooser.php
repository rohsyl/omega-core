<?php
namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type\MediaChooser;


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
        $v = $this->getValue();

        if(!$param['multiple']){
            $value = $v;
            return view('omega::common.plugin.type.mediachooser.simple.html', compact('value', 'uid', 'param'));
        }
        else {
            $values = isset($v) ? json_decode($v, true) : array();
            return view('omega::common.plugin.type.mediachooser.multiple.html', compact('values', 'uid', 'param'));
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

            $medias = array();
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
                $medias = array_orderby($medias, 'order', SORT_ASC);
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

        }
        return null;
    }

    public function getDoc()
    {
        // TODO: Implement getDoc() method.
    }
}