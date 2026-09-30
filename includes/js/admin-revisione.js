/* Dettagli del checkup in una modale — Amministrazione Trasparente. */
( function () {
	'use strict';

	var open = null;

	function close() {
		if ( open ) {
			var trigger = open.trigger;
			open.overlay.remove();
			open = null;
			document.removeEventListener( 'keydown', onKeydown );
			if ( trigger ) {
				trigger.focus();
			}
		}
	}

	function onKeydown( e ) {
		if ( e.key === 'Escape' ) {
			close();
		}
	}

	document.addEventListener( 'click', function ( e ) {
		var trigger = e.target.closest( '.at-open-modal' );

		if ( trigger ) {
			e.preventDefault();
			close();

			var overlay = document.createElement( 'div' );
			overlay.className = 'at-modal';
			overlay.setAttribute( 'role', 'dialog' );
			overlay.setAttribute( 'aria-modal', 'true' );
			overlay.setAttribute( 'aria-label', trigger.dataset.modalTitle || '' );
			overlay.innerHTML =
				'<div class="at-modal-box" tabindex="-1">' +
				'<button type="button" class="button-link at-modal-close" aria-label="Chiudi">' +
				'<span class="dashicons dashicons-no-alt"></span></button>' +
				'<h2></h2><div class="at-modal-body"></div></div>';

			overlay.querySelector( 'h2' ).textContent = trigger.dataset.modalTitle || '';
			// Server-escaped markup: only <b>, <br>, <span> and <a> from the checkup.
			overlay.querySelector( '.at-modal-body' ).innerHTML = trigger.dataset.modalContent || '';

			document.body.appendChild( overlay );
			overlay.querySelector( '.at-modal-box' ).focus();
			document.addEventListener( 'keydown', onKeydown );
			open = { overlay: overlay, trigger: trigger };
			return;
		}

		if ( open && ( e.target === open.overlay || e.target.closest( '.at-modal-close' ) ) ) {
			e.preventDefault();
			close();
		}
	} );
}() );
