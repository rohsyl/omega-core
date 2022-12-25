$.extend($.summernote.options, {
    mediachooser: {
        icon: '<i class="fa fa-folder"></i>',
        tooltip: 'Insert a media...'
    }
});

$.extend($.summernote.plugins, {
    /**
     *  @param {Object} context - context object has status of editor.
     */
    'mediachooser' : function (context) {
        var self = this,

            // ui has renders to build ui elements
            // for e.g. you can create a button with 'ui.button'
            ui = $.summernote.ui,
            $note = context.layoutInfo.note,

            // contentEditable element
            $editor = context.layoutInfo.editor,
            $editable = context.layoutInfo.editable,
            $toolbar = context.layoutInfo.toolbar,

            // options holds the Options Information from Summernote and what we extended above.
            options = context.options;

        context.memo('button.mediachooser', function () {
            return self.$button.render();
        });

        this.initialize = function () {

            this.$button = ui.button({

                // icon for button
                contents: options.mediachooser.icon,

                // tooltip for button
                tooltip: options.mediachooser.tooltip,

                // Keep button from being disabled when in CodeView
                codeviewKeepButton: true,

                click: function (e) {
                    context.invoke('examplePlugin.show');
                }
            });

            var rsMediaChooser = new RsMediaChooser(this.$button, options).init();
            $(this).data("rsMediaChooser", rsMediaChooser);
        }
    }
});
