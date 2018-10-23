jQuery(document).ready(function() {

	/* If there are required actions, add an icon with the number of required actions in the About certify page -> Actions required tab */
    var certify_nr_actions_required = certifyLiteWelcomeScreenObject.nr_actions_required;

    if ( (typeof certify_nr_actions_required !== 'undefined') && (certify_nr_actions_required != '0') ) {
        jQuery('li.certify-w-red-tab a').append('<span class="certify-actions-count">' + certify_nr_actions_required + '</span>');
    }

    /* Dismiss required actions */
    jQuery(".certify-dismiss-required-action").click(function(){

        var id= jQuery(this).attr('id');
        console.log(id);
        jQuery.ajax({
            type       : "GET",
            data       : { action: 'certify_dismiss_required_action',dismiss_id : id },
            dataType   : "html",
            url        : certifyLiteWelcomeScreenObject.ajaxurl,
            beforeSend : function(data,settings){
				jQuery('.certify-tab-pane h1').append('<div id="temp_load" style="text-align:center"><img src="' + certifyLiteWelcomeScreenObject.template_directory + '/inc/certify-info/img/ajax-loader.gif" /></div>');
            },
            success    : function(data){
				jQuery("#temp_load").remove(); /* Remove loading gif */
                jQuery('#'+ data).parent().remove(); /* Remove required action box */

                var certify_lite_actions_count = jQuery('.certify-actions-count').text(); /* Decrease or remove the counter for required actions */
                if( typeof certify_lite_actions_count !== 'undefined' ) {
                    if( certify_lite_actions_count == '1' ) {
                        jQuery('.certify-actions-count').remove();
                        jQuery('.certify-tab-pane').append('<p>' + certifyLiteWelcomeScreenObject.no_required_actions_text + '</p>');
                    }
                    else {
                        jQuery('.certify-actions-count').text(parseInt(certify_lite_actions_count) - 1);
                    }
                }
            },
            error     : function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });

	/* Tabs in welcome page */
	function certify_welcome_page_tabs(event) {
		jQuery(event).parent().addClass("active");
        jQuery(event).parent().siblings().removeClass("active");
        var tab = jQuery(event).attr("href");
        jQuery(".certify-tab-pane").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
	}

	var certify_actions_anchor = location.hash;

	if( (typeof certify_actions_anchor !== 'undefined') && (certify_actions_anchor != '') ) {
		certify_welcome_page_tabs('a[href="'+ certify_actions_anchor +'"]');
	}

    jQuery(".certify-nav-tabs a").click(function(event) {
        event.preventDefault();
		certify_welcome_page_tabs(this);
    });

		/* Tab Content height matches admin menu height for scrolling purpouses */
	 $tab = jQuery('.certify-tab-content > div');
	 $admin_menu_height = jQuery('#adminmenu').height();
	 if( (typeof $tab !== 'undefined') && (typeof $admin_menu_height !== 'undefined') )
	 {
		 $newheight = $admin_menu_height - 180;
		 $tab.css('min-height',$newheight);
	 }

});
