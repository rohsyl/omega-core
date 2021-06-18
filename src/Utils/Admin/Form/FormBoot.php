<?php


namespace rohsyl\OmegaCore\Utils\Admin\Form;


class FormBoot
{

    public static function boot() {
        \Form::component('otext', 'omega::admin.components.form.text', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('onumber', 'omega::admin.components.form.number', ['name', 'value' => 0, 'attributes' => []]);
        \Form::component('odecimal', 'omega::admin.components.form.decimal', ['name', 'value' => 0, 'attributes' => []]);
        \Form::component('oemail', 'omega::admin.components.form.email', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('oselect', 'omega::admin.components.form.select', ['name', 'data', 'value' => null, 'attributes' => []]);
        \Form::component('oselectmultiple', 'omega::admin.components.form.selectmultiple', ['name', 'data', 'value' => null, 'attributes' => []]);
        \Form::component('ocheckbox', 'omega::admin.components.form.checkbox', ['name', 'value' => 0, 'attributes' => []]);
        \Form::component('oradio', 'omega::admin.components.form.radio', ['name', 'checked' => false, 'value' => 0, 'attributes' => []]);
        \Form::component('otextarea', 'omega::admin.components.form.textarea', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('owysiwyg', 'omega::admin.components.form.wysiwyg', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('oeditor', 'omega::admin.components.form.wysiwyg', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('opassword', 'omega::admin.components.form.password', ['name', 'attributes' => []]);

        // TODO : datepicker
        \Form::component('odatepicker', 'omega::admin.components.form.datepicker', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('otimepicker', 'omega::admin.components.form.timepicker', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('odatetimepicker', 'omega::admin.components.form.datetimepicker', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('odaterangepicker', 'omega::admin.components.form.daterangepicker', ['name', 'from', 'to', 'value' => null, 'attributes' => []]);

        \Form::component('oback', 'omega::admin.components.form.back', ['name', 'attributes' => []]);
        \Form::component('osubmit', 'omega::admin.components.form.submit', ['name' => __('Submit'), 'attributes' => []]);
        \Form::component('odelete', 'omega::admin.components.form.delete', ['url', 'attributes' => []]);


        \Form::component('oattribute', 'omega::admin.components.form.attribute', ['label', 'value', 'attributes' => []]);


        \Form::component('opermissions', 'omega::admin.components.acl.editor', ['name', 'permissions', 'user', 'attributes' => []]);
    }
}