jQuery(document).ready(function($) {
	// Slide toggle
	jQuery( '.contact_details' ).hide();
	jQuery( '.contact_button' ).click(function() {
		jQuery( '.contact_details' ).slideToggle();
	});
});