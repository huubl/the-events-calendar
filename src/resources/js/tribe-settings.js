jQuery( function ( $ ) {
	updateMapsFields();

	// toggle view of the google maps size fields
	$( '.google-embed-size input' ).on( 'change', updateMapsFields );

	// toggle view of the google maps size fields
	function updateMapsFields() {
		if ( $( '.google-embed-size input' ).prop( 'checked' ) ) {
			$( '.google-embed-field' ).slideDown();
		} else {
			$( '.google-embed-field' ).slideUp();
		}
	}
} );

( function ( $, data ) {
	// eslint-disable-line no-unused-vars
	'use strict';

	/**
	 * Check hidden field when Unchecked when the base field is checked first
	 */
	$( function () {
		// Verify that all WP variables exists
		if ( -1 !== [ typeof pagenow, typeof typenow, typeof adminpage ].indexOf( 'undefined' ) ) {
			return false;
		}

		const $container = $( '#tribe-field-toggle_blocks_editor' );
		const $hiddenContainer = $( '#tribe-field-toggle_blocks_editor_hidden_field' );
		const $field = $container.find( '#tribe-blocks-editor-toggle-field' );
		const $hiddenField = $hiddenContainer.find( '#tribe-blocks-editor-toggle-hidden-field' );

		const isFieldChecked = $field.is( ':checked' );
		const isHiddenFieldChecked = $hiddenField.is( ':checked' );

		// Once this field is check we bail forever
		if ( isHiddenFieldChecked ) {
			return;
		}

		// Only check the hidden field when we change the Field was checked
		if ( isFieldChecked ) {
			$field.one( 'change', function () {
				// Check the hidden field
				$hiddenField.prop( 'checked', true );
			} );
		}
	} );
} )( jQuery, {} );
