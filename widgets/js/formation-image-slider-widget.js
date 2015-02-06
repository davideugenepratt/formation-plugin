jQuery(document).ready( function() {
	
	var custom_uploader;
	var existing_uploader;
	jQuery(document).on("click", ".formation_image_slider_add_image", function(event) {
		event.preventDefault();		
		var parent = jQuery(this).parents('.formation_image_slider_widget_container');
		
    	if (existing_uploader) {
			existing_uploader.open();
			return;
		}
		
		existing_uploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		
		existing_uploader.on('select', function() {
			attachment = existing_uploader.state().get('selection').first().toJSON();
			parent.find('.slider_images_container').append('<div class="slider_image"><img src="'+attachment.url+'"><a href="#" class="formation_image_slider_up gen-enclosed foundicon-up-arrow control" ><span>Up</span></a><a href="#" class="formation_image_slider_down gen-enclosed foundicon-down-arrow control" ><span>Down</span></a><a href="#" class="formation_image_slider_control gen-enclosed foundicon-settings control" ><span>Caption</span></a><a href="#" class="formation_image_slider_delete gen-enclosed foundicon-remove control"><span>Delete</span></a><input type="hidden" value="'+attachment.url+'" class="img_url"><input type="hidden" value="" class="img_link"><input type="hidden" value="" class="img_caption"></div>');
			var images = new Array();
			parent.find('.slider_image').each( function() {	
				var image = new Array();
				image[0] = jQuery(this).find('.img_url').val();
				image[1] = jQuery(this).find('.img_link').val();
				image[2] = jQuery(this).find('.img_caption').val();
				images.push( image );	
			});
			
			parent.find('input.all_images').val( JSON.stringify(images, null, "") );
			
		});
		existing_uploader.open(); 
	});


	jQuery(document).on("click", ".formation_image_slider_delete", function(event) {
		var parent = jQuery(this).parents('.formation_image_slider_widget_container');												 
		jQuery(this).parent().remove();
		var images = new Array();
		parent.find('.slider_image').each( function() {	
			var image = new Array();
			image[0] = jQuery(this).find('.img_url').val();
			image[1] = jQuery(this).find('.img_link').val();
			image[2] = jQuery(this).find('.img_caption').val();
			images.push( image );	
		});
		if ( images.length > 0 ) {
			parent.find('input.all_images').val( JSON.stringify(images, null, "") );
			
		}
		else {
			parent.find('input.all_images').val( '' );
		}
	});
	

	
	jQuery(document).on("click", ".formation_image_slider_up", function(event) {
		var parent = jQuery(this).parents('.formation_image_slider_widget_container');												 
		var previousSib = jQuery(this).parent().prev();
		if ( previousSib.length != 0 ) {
			jQuery(this).parent().detach().insertBefore( previousSib );
		}
		var images = new Array();
		parent.find('.slider_image').each( function() {	
			var image = new Array();
			image[0] = jQuery(this).find('.img_url').val();
			image[1] = jQuery(this).find('.img_link').val();
			image[2] = jQuery(this).find('.img_caption').val();
			images.push( image );	
		});
		
		parent.find('input.all_images').val( JSON.stringify(images, null, "") );
	});
	
	jQuery(document).on("click", ".formation_image_slider_down", function(event) {
		var parent = jQuery(this).parents('.formation_image_slider_widget_container');												 
		var nextSib = jQuery(this).parent().next();
		if ( nextSib.length != 0 ) {
			jQuery(this).parent().detach().insertAfter( nextSib );
		}
		var images = new Array();
		parent.find('.slider_image').each( function() {	
			var image = new Array();
			image[0] = jQuery(this).find('.img_url').val();
			image[1] = jQuery(this).find('.img_link').val();
			image[2] = jQuery(this).find('.img_caption').val();
			images.push( image );	
		});
		
		parent.find('input.all_images').val( JSON.stringify(images, null, "") );
	});

	jQuery(document).on("click", ".formation_image_slider_control", function(event) {
		var parent = jQuery(this).parents('.formation_image_slider_widget_container');
		var img = jQuery(this).parents('div.slider_image');
		var link = img.find('.img_link').val();
		var caption = img.find('.img_caption').val();
		jQuery('body').prepend('<div id="control_blocker" style="height:100%; width:100%; position:absolute; top:0px; left:0px; background:#000; opacity:.5; z-index:998;"></div><div id="control_modal" style="height:170px; width:270px; padding:15px; background:#fff; opacity:1; border-radius:20px; border:5px solid #eee; position:absolute; top:50%; left:50%; margin-top:-100px; margin-left:-150px; z-index:999;"><label for="link">Link URL:</label><br><input type="text" name="link" id="link" style="width:100%;" value="'+link+'"><br><label for="link">Caption:</label><br><textarea style="width:100%; margin-bottom:5px;" name="caption" id="caption">'+caption+'</textarea><br><button id="cancel" class="button button-secondary" style="margin-right:10px;">Cancel</button><button id="ok" class="button-primary">Ok</button></div>');
		jQuery('body').css( 'overflow','hidden' );
		jQuery('#cancel').click( function(){
			jQuery('#control_modal').remove();
			jQuery('#control_blocker').remove();
			jQuery('body').css( 'overflow','scroll' );
		});
		jQuery('#ok').click( function(){
			img.find('.img_link').val( jQuery('#link').val() );
			img.find('.img_caption').val( jQuery('#caption').val() );
			jQuery('#control_modal').remove();
			jQuery('#control_blocker').remove();
			jQuery('body').css( 'overflow','scroll' );
			var images = new Array();
			parent.find('.slider_image').each( function() {	
				var image = new Array();
				image[0] = jQuery(this).find('.img_url').val();
				image[1] = jQuery(this).find('.img_link').val();
				image[2] = jQuery(this).find('.img_caption').val();
				images.push( image );	
			});
			
			parent.find('input.all_images').val( JSON.stringify(images, null, "") );
		});
		
	});
	
});