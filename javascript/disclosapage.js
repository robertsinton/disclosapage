var Disclosapage = {};

Disclosapage.check = function () {
	if ( ! jQuery) {
		setTimeout('Disclosapage.check()', 10);
	} else {
		Disclosapage.init();
	}
}

Disclosapage.init = function () {
	jQuery.noConflict();
	// Set up a click function for future disclosure targets.
	jQuery('.disclosure_target').live('click', function(){
		jQuery(this).toggleClass( 'disclosure_triangle_right' ).parent().nextAll('ul.mojo_sub_structure:first').slideToggle();
	});
	// Hook onto any clicks on the MojoBar admin button.
	jQuery('#mojo_admin_pages a' ).live('click', function() {
		if ((jQuery( '#mojo_site_structure').size() > 0) && (jQuery('#mojo_reveal_page').css('display') != 'none')){
			// If the tree is already present *and* visible, then this click is putting it away.
		} else {
			// Otherwise, the tree is on its way and we just need to wait for it.
			setTimeout('Disclosapage.waitForTree()', 100);
		}
	});
	// Also add a hook to the save buttons on the add Add Page and Edit Page panes.
	jQuery('input[name=page_prefs]').live('click', function() {
		setTimeout('Disclosapage.waitForTree()', 100);
	});
	// And the 'Pages' breadcrumb link on the Add Page and Edit Page panes.
	// (It's also on the main Pages page, but we test before adding extra controls below.)
	jQuery('#mojo_reveal_page_back').live('click', function() {
		setTimeout('Disclosapage.waitForTree()', 100);
	});
}

Disclosapage.waitForTree = function () {
	jQuery.noConflict();
	// Wait until the page manipulation tree is in place and visible ...
	if ((jQuery( '#mojo_site_structure' ).size() == 0) || (jQuery('#mojo_reveal_page').css('display') == 'none')){
		setTimeout('Disclosapage.waitForTree()', 100);
	} else {
		// ... then add disclosure targets in the appropriate places, if they aren't there already.
		if ( jQuery('.disclosure_target').size() == 0 ) {
			jQuery('li:has(ul.mojo_sub_structure) > div.ui-droppable:first-child').prepend('<span class="disclosure_target">&nbsp;&nbsp;&nbsp;&nbsp;</span>');
		}
	}
}

setTimeout('Disclosapage.check()', 10);


// The approach above is derived from Dan Horrigan's "Equipment" addon for MojoMotor.
// https://github.com/dhorrigan/mojo-equipment
