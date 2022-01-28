<?php


namespace rohsyl\OmegaCore\Utils\Common\Plugin\Form;


use Illuminate\Contracts\Support\Renderable;
use rohsyl\OmegaCore\Models\PluginFormEntry;
use rohsyl\OmegaCore\Models\PluginFormEntryValue;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\Type;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TypeEntry;

class FormEntry implements Renderable
{
    protected $entry;
    private $component_id;
    private $page_id;
    protected $type;
    protected $value;

    public function __construct(PluginFormEntry $entry, int $component_id, int $page_id)
    {
        $this->entry = $entry;
        $this->component_id = $component_id;
        $this->page_id = $page_id;
        $this->loadValue();
        $this->loadType();
    }

    /**
     * Instance the type of the entry
     */
    protected function loadType(){
        $typeClassName = $this->entry->type;
        if(class_exists($typeClassName)){
            $type = new $typeClassName($this->getUniqId(), $this->entry->param, $this->getValueValue(), $this->page_id);
            if(is_subclass_of($type, TypeEntry::class)){
                $this->type = $type;
                return;
            }
        }
        $this->type = null;
    }

    /**
     * Load the value of the entry
     */
    protected function loadValue(){
        $this->value = Type::GetValueForEntry($this->entry->id, $this->component_id);
    }

    /**
     * @return PluginFormEntryValue
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the value contained in the PluginFormEntryValue
     * @return null|mixed
     */
    protected function getValueValue(){
        if(isset($this->value) && !empty($this->value)){
            return $this->value->getValue();
        }
        return null;
    }

    /**
     * Use this uniq id as name for your inputs
     * @return string
     */
    protected function getUniqId(){
        return 'entry-'.$this->entry->id.'-'.$this->component_id;
    }

    /**
     * @return null|TypeEntry
     */
    public function getType()
    {
        return $this->type;
    }

    public function getName() {
        return $this->entry->name;
    }

    public function getId() {
        return $this->entry->id;
    }

    public function getComponentId() {
        return $this->component_id;
    }

    public function getHtml() {
        return view('omega::common.plugin.form.formentry')->with([
            'uid' => $this->getUniqId(),
            'title' => $this->entry->title,
            'description' => $this->entry->description,
            'type' => $this->type,
        ]);
    }


    public function render() {
        return $this->getHtml();
    }

    public function __toString(): string
    {
        return $this->render();
    }
}