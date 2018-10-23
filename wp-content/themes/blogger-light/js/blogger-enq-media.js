/**
 * Load media uploader on pages with our custom metabox
 */
 jQuery(document).ready(function($){

	'use strict';

	// Instantiates the variable that holds the media library frame.
	var metaImageFrame;

	// Runs when the media button is clicked.
	$( 'body' ).click(function(e) {

		// Get the btn
		var btn = e.target;

		// Check if it's the upload button
		if ( !btn || !$( btn ).attr( 'data-media-uploader-target' ) ) return;

		// Get the field target
		var field = $( btn ).data( 'media-uploader-target' );
		var img_field = $( btn ).data( 'media-uploader-target-img' );

		// Prevents the default action from occuring.
		e.preventDefault();

		// Sets up the media library frame
		metaImageFrame = wp.media.frames.metaImageFrame = wp.media({
			title: meta_image.title,
			button: { text:  'Use this file' },
		});

		// Runs when an image is selected.
		metaImageFrame.on('select', function() {

			// Grabs the attachment selection and creates a JSON representation of the model.
			var media_attachment = metaImageFrame.state().get('selection').first().toJSON();

			// Sends the attachment URL to our custom image input field.
			$( field ).val(media_attachment.id);
			$( img_field ).html('<img src="'+ media_attachment.sizes.medium.url +'" alt="'+ media_attachment.title +'" style="max-width:100%">');

		});

		// Opens the media library frame.
		metaImageFrame.open();

	});

	$('#remove-post-meta-img').click(function(e) {
		$('#blogger-light-post-header-img').html('');
		$('#blogger-light-post-header-img-id').val('');
	});

	// Logo type inputs
	jQuery('input[name="blogger-light-post-header"]').change(function() {
		var value = jQuery(this).val();

		if ( value == 'custom-image' ) {
			$('.custom-image').css('display', 'block');
		} else {
			$('.custom-image').css('display', 'none');
		}

	});

});