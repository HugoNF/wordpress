jQuery(document).ready(function() {
    var certify_aboutpage = certifyLiteWelcomeScreenCustomizerObject.aboutpage;
    var certify_nr_actions_required = certifyLiteWelcomeScreenCustomizerObject.nr_actions_required;

    /* Number of required actions */
    if ((typeof certify_aboutpage !== 'undefined') && (typeof certify_nr_actions_required !== 'undefined') && (certify_nr_actions_required != '0')) {
        jQuery('#accordion-section-themes .accordion-section-title').append('<a href="' + certify_aboutpage + '"><span class="certify-actions-count">' + certify_nr_actions_required + '</span></a>');
    }

    /* Upsell in Customizer (Link to Welcome page) */
    if ( !jQuery( ".certify-upsells" ).length ) {
        jQuery('#customize-theme-controls > ul').prepend('<li class="accordion-section certify-upsells">');
    }
    if (typeof certify_aboutpage !== 'undefined') {
        jQuery('.certify-upsells').append('<a style="width: 80%; margin: 5px auto 15px auto; display: block; text-align: center;" href="' + certify_aboutpage + '" class="button" target="_blank">{themeinfo}</a>'.replace('{themeinfo}', certifyLiteWelcomeScreenCustomizerObject.themeinfo));
    }
    if ( !jQuery( ".certify-upsells" ).length ) {
        jQuery('#customize-theme-controls > ul').prepend('</li>');
    }
});