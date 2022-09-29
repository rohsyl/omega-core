var mediaChooserInstance = 0;

(function($){
  var RsMediaChooser = function(elem, options){
      this.$button = $(elem);

      this.settings = $.extend({}, $.fn.rsMediaChooser.defaults, options || {});

    };

    RsMediaChooser.prototype = {
    	
    // ================ PUBLIC ================= //
    		
    init: function() {
		var $this = this;

		if($this.settings.url == undefined)
			$this.settings.url = route('omega.admin.content.media.index.modal');

		this.$button.off('click');
		this.$button.click(function(e){
            e.preventDefault();
			var args = {
				rootId : $this.settings.rootId,
				rights : $this.settings.rights,
                inception : $this.settings.inception
			};
			omega.ajax.query($this.settings.url, args, 'GET', function(html){
				let o = $this.parseScript(html);
				let mid = omega.modal.open(__('Select media'), o.html, __('Choose'), function(){

					let $media = $('#omega-modal-'+mid+' .modal-body').find('.media-item.selected');

					if ($media.length > 1) {
						if($this.settings.multiple === true) {

							let data = [];

							$media.each(function(){
								let media = $.parseJSON($('<div/>').html($(this).data('media')).text());
								if ($.inArray(media.media_type, $this.settings.allowedMedia) !== -1) {
									data.push(media);
								}
							});

							$this.settings.doneFunction(data, $this.$button);

							omega.modal.hide(mid);
						}
						else {
							alert('Multiple selection denied');
						}
					}
					else if ($media.length === 1) {
						let media = $.parseJSON($('<div/>').html($media.data('media')).text());
						if ($.inArray(media.media_type, $this.settings.allowedMedia) !== -1) {
							$this.settings.doneFunction(media, $this.$button);
							omega.modal.hide(mid);
						}
						else {
							alert('Unallowed media type');
						}
					}
					else {
						//alert('No selection');
					}
				}, 'modal-xl modal-fullscreen');
				$this.runScript(o.scripts);
			});
		});
		
      return this;
    },
	
    // ================ PRIVATE ================ //

	parseScript: function (_source) {
		var source = _source;
		var scripts = [];

		// Strip out tags
		while(source.toLowerCase().indexOf("<script") > -1 || source.toLowerCase().indexOf("</script") > -1) {
			var s = source.toLowerCase().indexOf("<script");
			var s_e = source.indexOf(">", s);
			var e = source.toLowerCase().indexOf("</script", s);
			var e_e = source.indexOf(">", e);

			// Add to scripts array
			scripts.push(source.substring(s_e+1, e));
			// Strip from source
			source = source.substring(0, s) + source.substring(e_e+1);
		}


		// Return the cleaned source
		return  {
			html: source,
			scripts : scripts
		};
	},

	runScript: function(scripts) {
		// Loop through every script collected and eval it
		for(var i=0; i<scripts.length; i++) {
			try {
				if (scripts[i] != '')
				{
					try  {          //IE
						execScript(scripts[i]);
					}
					catch(ex)           //Firefox
					{
						window.eval(scripts[i]);
					}

				}
			}
			catch(e) {
				// do what you want here when a script fails
				// window.alert('Script failed to run - '+scripts[i]);
				if (e instanceof SyntaxError) console.log (e.message+' - '+scripts[i]);
			}
		}
	}
  };

  $.fn.rsMediaChooser = function(options) {
    return this.each(function() {
    	var rsMediaChooser = new RsMediaChooser(this, options).init();
    	$(this).data("rsMediaChooser", rsMediaChooser);
    });
  };
  $.fn.rsMediaChooser.defaults = {
	url : undefined,
	rootId : 1,
	rights : 'mkdir,rn,rm,refresh,upload,download,copy,cut,paste',
	multiple: false,
    inception: false,
	allowedMedia: [
		'folder', 'picture', 'video', 'document', 'music', 'video_ext'
	],
	doneFunction: function(data)
	{
		$('[data-mediachooser="text"]').val(data);
	}
  };
  $.fn.rsMediaChooser.settings = {};
  
})(jQuery);
