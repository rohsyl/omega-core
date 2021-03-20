<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 05.08.2017
 * Time: 18:45
 */
namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type;

use rohsyl\OmegaCore\Models\PluginFormEntry;
use rohsyl\OmegaCore\Models\PluginFormEntryValue;
use rohsyl\OmegaCore\Utils\Common\Plugin\Form\FormEntry;
use rohsyl\OmegaCore\Utils\Common\Plugin\Form\Renderer\PluginFormRenderer;
use rohsyl\OmegaCore\Utils\Common\Plugin\Form\Renderer\BasicFormRenderer;

class Type{

    /**
     *
     * @param int $plugin_form_id
     * @param int $component_id
     * @param int $page_id
     * @return array
     */
    public static function GetValues($plugin_form_id, $component_id, $page_id)
    {
        $data = array();
        $entries = self::GetFormEntries($plugin_form_id);
        foreach($entries as $entry){
            $e = new FormEntry($entry, $component_id, $page_id);
            $data[$e->getName()] = $e->getType()->getObjectValue();
        }
        return $data;
    }

    /**
     * @param int $plugin_form_id
     * @param int $component_id
     * @param int $page_id
     * @param PluginFormRenderer|null $formRenderer
     * @return string
     */
    public static function FormRender($plugin_form_id, $component_id, $page_id, PluginFormRenderer $formRenderer = null)
    {
        if(!isset($formRenderer)) {
            $formRenderer = new BasicFormRenderer();
        }
        $formRenderer->setEntries(
            self::EntriesToArrayWithKeyName(
                self::GetFormEntries($plugin_form_id),
                $component_id, $page_id
            )
        );
        return $formRenderer->render();
    }

    /**
     * @param array $entries
     * @param int $component_id
     * @param int $page_id
     * @return array
     */
    private static function EntriesToArrayWithKeyName($entries, $component_id, $page_id)
    {
        $new = [];
        foreach($entries as $entry){
            $e = new FormEntry($entry, $component_id, $page_id);
            $new[$e->getName()] = $e;
        }
        return $new;
    }

    /**
     * @param int $plugin_form_id
     * @param int $component_id
     * @param int $page_id
     * @return bool
     */
    public static function FormSave($plugin_form_id, $component_id, $page_id)
    {
        $success = true;
        $entries = self::GetFormEntries($plugin_form_id);
        foreach($entries as $entry){
            $e = new FormEntry($entry, $component_id, $page_id);
            $res = self::SaveValueForEntry($e);
            if(!$res)
                $success = false;
        }
        return $success;
    }

    /**
     * @param int $plugin_form_id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    protected static function GetFormEntries($plugin_form_id)
    {
        return PluginFormEntry::query()
            ->where('plugin_form_id', $plugin_form_id)
            ->orderBy('order', 'ASC')
            ->get();
    }

    /**
     * @param int $plugin_form_entry
     * @param int $component_id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public static function GetValueForEntry($plugin_form_entry_id, $component_id)
    {
       return PluginFormEntryValue::query()
           ->where('plugin_form_entry_id', $plugin_form_entry_id)
           ->where('component_id', $component_id)
           ->first();
    }

    /**
     * @param FormEntry $entry
     * @return bool
     */
    protected static function SaveValueForEntry(FormEntry $entry)
    {
        $newValue = $entry->getType()->getPostedValue();
        $valueEntry = $entry->getValue();
        if(isset($valueEntry)){
            $valueEntry->value = $newValue;
            $res = $valueEntry->save();
        }
        else {
            $valueEntry = new PluginFormEntryValue();
            $valueEntry->value = $newValue;
            $valueEntry->plugin_form_entry_id = $entry->getId();
            $valueEntry->component_id = $entry->getComponentId();
            $res = $valueEntry->save();
        }
        return $res;
    }
}