jQuery( document ).ready( function() {
	
	function update_fields( parent ) {
		var fields = new Array();
		parent.find( 'tr:not(.no-fields)' ).each( function( index ) {
			var fieldOptions = new Array();								   
			jQuery( this ).find('input.select-option').each( function() {
				fieldOptions.push( jQuery( this ).val() );
			});
			var field = [ jQuery( this ).find('.field-name').val() , jQuery( this ).find('.field-type').val() , fieldOptions, jQuery( this ).find('.field-required:checked').val() ];
			fields.push( field );
		});
		parent.find('input.all-fields').val( JSON.stringify( fields ) );
	}
	
	jQuery(document).on("click", ".formation_contact_wrapper a.add-field", function(event) {
		event.preventDefault();
		var parent = jQuery(this).parents('div.formation_contact_fields_container').find('table.fields-table');
		var newRow = jQuery(this).parents('div.formation_contact_fields_container').find('tr.template-row').clone();
		jQuery( newRow ).removeClass('template-row').removeClass('no-fields').addClass('fields');
		jQuery( newRow ).find('input').val('');
		jQuery(this).parents('div.formation_contact_fields_container').find('table.fields-table').append( newRow );
		update_fields( parent );
	});
	
	jQuery(document).on("click", ".formation_contact_wrapper tr.fields a.row-delete", function(event) {
		event.preventDefault();
		var parent = jQuery(this).parents('table.fields-table');
		if ( parent.find( 'tr:not(.no-fields)').length > 1 ) {
			jQuery(this).parents('tr').remove();		
			update_fields( parent );
		}
	});
	
	jQuery( document ).on( "change" , ".formation_contact_wrapper table.fields-table select.field-type", function(event) {																								  
		var parent = jQuery(this).parents('.formation_contact_wrapper table.fields-table');
		if ( jQuery(this).val() == 'select' ) {
			jQuery(this).parent().append('<div class="formation_contact_option_container removeable" ><a href="#" class="formation_contact_option_remove" ><span class="dashicons dashicons-minus"></span></a><input type="text" class="select-option" value="Option"></div><a href="#" class="alignright add_option removeable"><div class="dashicons dashicons-plus"></div></a>');	
		}
		if ( jQuery(this).val() != 'select' ) {
			jQuery(this).parent().find('.removeable').each( function() { jQuery( this ).remove(); });	
		}
		update_fields( parent );
	});
	
	jQuery(document).on("click", ".formation_contact_wrapper a.add_option", function(event) {
		event.preventDefault();
		var parent = jQuery(this).parents('table.fields-table');
		jQuery('<div class="formation_contact_option_container removeable" ><a href="#" class="formation_contact_option_remove" ><span class="dashicons dashicons-minus"></span></a><input type="text" class="select-option" value="Option"></div>').insertBefore( this );	
		update_fields( parent );
	});
	
	jQuery(document).on("click", ".formation_contact_wrapper a.formation_contact_option_remove", function(event) {
		event.preventDefault();
		var parent = jQuery(this).parents('table.fields-table');
		jQuery(this).parent().remove();
		update_fields( parent );
	});
	
});