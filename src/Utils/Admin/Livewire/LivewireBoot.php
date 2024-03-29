<?php
namespace rohsyl\OmegaCore\Utils\Admin\Livewire;

use Livewire\Livewire;
use rohsyl\OmegaCore\Extensions\Livewire\Modal\Modal;
use rohsyl\OmegaCore\Http\Livewire\Admin\Appearance\Menu\Edit\EditMenuComponent;
use rohsyl\OmegaCore\Http\Livewire\Admin\Content\Media\MediaLibrary\FileUploaderComponent;
use rohsyl\OmegaCore\Http\Livewire\Admin\Content\Media\MediaLibrary\MediaLibraryComponent;
use rohsyl\OmegaCore\Http\Livewire\Admin\Content\Media\MediaLibrary\Modal\CreateDirectoryModal;
use rohsyl\OmegaCore\Http\Livewire\Admin\Content\Media\MediaLibrary\Modal\EditMediaModal;
use rohsyl\OmegaCore\Http\Livewire\Admin\Content\Media\MediaLibrary\Modal\UploadModal;
use rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit\ComponentSettings;
use rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit\EditPageComponent;
use rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit\Modal\AddComponentModal;
use rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit\Modal\SettingsComponentModal;
use rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit\WidgetAreas;

class LivewireBoot
{

    public static function boot() {

        Livewire::component('omega_edit-page', EditPageComponent::class);
        Livewire::component('omega_edit-page-componentsettings', ComponentSettings::class);
        Livewire::component('omega_edit-page-widgetareas', WidgetAreas::class);

        Livewire::component('omega_edit_modal_add-component', AddComponentModal::class);
        Livewire::component('omega_edit_modal_settings-component', SettingsComponentModal::class);

        Livewire::component('omega_edit-menu', EditMenuComponent::class);

        Livewire::component('omega_media-library', MediaLibraryComponent::class);
        Livewire::component('omega_media-fileuploader', FileUploaderComponent::class);
        Livewire::component('omega_media_modal_create-directory', CreateDirectoryModal::class);
        Livewire::component('omega_media_modal_upload', UploadModal::class);
        Livewire::component('omega_media_modal_edit-media', EditMediaModal::class);

        Livewire::component('livewire-ui-modal2', Modal::class);
    }
}