console.log('prova');
jQuery(function() {

    jQuery( ".atyfp-add").click( function() {
        var data = 'action=add_favourite_post&post_ID=' + jQuery(this).attr('href').slice(1);
        jQuery.post(ajax_atyfp.url, data, function(response) {
            console.log( 'Got this from the server: ' + response );
        });
    });

    jQuery( ".atyfp-remove").click( function() {
        var data = 'action=add_favourite_post&post_ID=' + jQuery(this).attr('href').slice(1);
        jQuery.post(ajax_atyfp.url, data, function(response) {
            console.log( 'Got this from the server: ' + response );
        });
    });

});
