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
        \Form::component('ocheckbox', 'omega::admin.components.form.checkbox', ['name', 'value' => 0, 'attributes' => []]);
        \Form::component('oradio', 'omega::admin.components.form.radio', ['name', 'checked' => false, 'value' => 0, 'attributes' => []]);
        \Form::component('otextarea', 'omega::admin.components.form.textarea', ['name', 'value' => null, 'attributes' => []]);

        // TODO : datepicker
        /*\Form::component('osimpledatepicker', 'ops.components.form.simpledatepicker', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('odatepicker', 'ops.components.form.datepicker', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('odatetimepicker', 'ops.components.form.datetimepicker', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('odaterangepicker', 'ops.components.form.daterangepicker', ['name', 'from', 'to', 'value' => null, 'attributes' => []]);*/

        \Form::component('oback', 'omega::admin.components.form.back', ['name', 'attributes' => []]);
        \Form::component('osubmit', 'omega::admin.components.form.submit', ['name' => __('Submit'), 'attributes' => []]);
        \Form::component('odelete', 'omega::admin.components.form.delete', ['url', 'attributes' => []]);
    }
}