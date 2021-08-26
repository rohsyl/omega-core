<?php


namespace rohsyl\OmegaCore\Utils\Admin\Livewire;


use Livewire\Livewire;
use rohsyl\OmegaCore\Http\Livewire\Admin\Appearance\Menu\Edit\EditMenuComponent;
use rohsyl\OmegaCore\Http\Livewire\Admin\Content\Media\MediaLibrary\FileUploaderComponent;
use rohsyl\OmegaCore\Http\Livewire\Admin\Content\Media\MediaLibrary\MediaLibraryComponent;
use rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit\ComponentSettings;
use rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit\EditPageComponent;
use rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit\WidgetAreas;

class LivewireBoot
{

    public static function boot() {

        Livewire::component('omega_edit-page', EditPageComponent::class);
        Livewire::component('omega_edit-page-componentsettings', ComponentSettings::class);
        Livewire::component('omega_edit-page-widgetareas', WidgetAreas::class);

        Livewire::component('omega_edit-menu', EditMenuComponent::class);
        Livewire::component('omega_media-library', MediaLibraryComponent::class);
        Livewire::component('omega_media-fileuploader', FileUploaderComponent::class);
    }
}