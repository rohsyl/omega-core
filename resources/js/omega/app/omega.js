let OmegaAjax = require('./omegaAjax');
let OmegaHtml = require('./omegaHtml');
let OmegaModal = require('./omegaModal');
let OmegaMvc = require('./omegaMvc');
let OmegaPlugin = require('./omegaPlugin');
let OmegaLocation = require('./omegaLocation');


(function (define) {
    define(['jquery'], function ($) {

        function CleanWordPastedHTML(sTextHTML) {
            var sStartComment = "<!--", sEndComment = "-->";
            while (true) {
                var iStart = sTextHTML.indexOf(sStartComment);
                if (iStart == -1) break;
                var iEnd = sTextHTML.indexOf(sEndComment, iStart);
                if (iEnd == -1) break;
                sTextHTML = sTextHTML.substring(0, iStart) + sTextHTML.substring(iEnd + sEndComment.length);
            }
            return sTextHTML;
        }

        function Omega() {
            this.abspath = $('meta[name="absurl"]').attr('content') + '/';
            this.html = new OmegaHtml(this);
            this.ajax = new OmegaAjax(this);
            this.modal = new OmegaModal(this);
            this.mvc = new OmegaMvc(this);
            this.plugin = new OmegaPlugin(this);
            this.location = new OmegaLocation(this);

            $(function () {
                $('.delete').click(function () {
                    let _this = $(this);
                    omega.modal.confirm(__('Do you really want to delete this ?'), function (yes) {
                        if (yes)
                            $(location).attr('href', _this.data('url'));
                    }, 'btn-danger');
                    return false;
                });
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }

        Omega.prototype = {
            //---- Public method ----//
            initSummerNote: function (selector) {
                var _this = this;
                $(selector).each(function () {
                    var $this = $(this);
                    var param = {
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'italic', 'underline', 'clear']],
                            ['fontname', ['fontname']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['height', ['height']],
                            ['table', ['table']],
                            ['insert', ['link', 'mediachooser', 'hr']],
                            ['view', ['fullscreen', 'codeview']],
                            ['help', ['help']]
                        ],
                        height: $this.is('[height]') ? $this.attr('height') : 350,

                        minHeight: null,             // set minimum height of editor
                        maxHeight: null,             // set maximum height of editor

                        focus: false,                 // set focus to editable area after initializing summernote
                        onKeyup: function (e) {
                            $this.val($(this).code());
                            $this.change(); //To update any action binded on the control
                        },
                        onPaste: function (evt) {
                            evt.preventDefault();
                            // Capture pasted data
                            var text = evt.originalEvent.clipboardData.getData('text/plain'),
                                html = evt.originalEvent.clipboardData.getData('text/html');
                            // Clean up html input
                            if (html) {
                                html = Word_Entity_Scrubber.scrub(html);
                                html = CleanWordPastedHTML(html);
                            }
                            // Do the
                            var $dom = $('<div class="pasted"/>').html(html || text);
                            $dom.find('meta').remove();
                            $dom.find('link').remove();
                            $dom.find('style').remove();
                            $dom.find('*').removeAttr('class').removeAttr('style');
                            $this.summernote('insertNode', $dom[0]);
                            return false;
                        },
                        prettifyHtml: true
                    };

                    $('[data-toggle="summernote-tooltip"]').tooltip({
                        placement: 'bottom'
                    });
                });
            },

            initDatePicker: function (selector) {
                $(selector).datepicker({
                    format: 'yyyy-mm-dd',
                });
            },


            getQueryStringParams: function (sParam) {
                var sPageURL = window.location.search.substring(1);
                var sURLVariables = sPageURL.split('&');
                for (var i = 0; i < sURLVariables.length; i++) {
                    var sParameterName = sURLVariables[i].split('=');
                    if (sParameterName[0] === sParam) {
                        return sParameterName[1];
                    }
                }
            }
            //---- Private method ----//
        };

        return new Omega();
    });


}(typeof define === 'function' && define.amd ? define : function (deps, factory) {
    if (typeof module !== 'undefined' && module.exports) { //Node
        module.exports = factory(require('jquery'));
    } else {
        window.omega = factory(window.jQuery);
    }
}));
