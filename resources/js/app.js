
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import $ from 'jquery';
window.$ = window.jQuery = $;

import Alpine from 'alpinejs'
window.Alpine = Alpine

require('./bootstrap');
require('./omega/admin/index')
require('bs4-summernote')
require('daterangepicker/daterangepicker');

import { Sortable, AutoScroll } from 'sortablejs/modular/sortable.core.esm.js';
Sortable.mount(new AutoScroll());
window.Sortable = Sortable;

import Swal from 'sweetalert2';
window.Swal = Swal;

import SlimSelect from 'slim-select';
window.SlimSelect = SlimSelect;

import moment from 'moment';
window.moment = moment;

import CodeMirror from 'codemirror';
window.CodeMirror = CodeMirror;

import frenchkiss from 'frenchkiss';
window.frenchkiss = frenchkiss;

require('./omega/plugins/jquery.rsExplorer');
require('./omega/plugins/jquery.rsMediaChooser');
require('./omega/plugins/jquery.rsModuleChooser');
window.omega = require('./omega/app/omega');

// quickfix, let's not talk about it ok ?
window.__ = function(value) { return value; };
