<?php

class Atyfp_Theme_Functions
{

    function __construct()
    {
    }

    public static function  define_theme_functions()
    {

        if (!function_exists('atyfp_link')) {
            function atyfp_link( $post_id = null )
            {

                global $post;

                $atyfp_options = get_option( 'atyfp-options' );

                if( $post_id != null && $post_id != $post->ID ) {
                    $post_data = get_post( $post_id );
                }else{
                    $post_data = $post;
                }

                $counter_html = " ";
                if( $atyfp_options['atyfp-show-mode'] == 'counter' && $post->favourites_counter > 0) {
                    $counter_html = " (" . $post->favourites_counter . ") ";
                }

                $img_on_off = '_off';
                if( $post->myfavourite ) {
                    $img_on_off = '';
                }

                if( $atyfp_options['atyfp-image'] == 'star' ) {
                    $img_html = '<img src="' . plugins_url( 'common/img/star'.$img_on_off.'.png', dirname( __FILE__ ) ) . '">';
                } else if( $atyfp_options['atyfp-image'] == 'little_star' ) {
                    $img_html = '<img src="' . plugins_url( 'common/img/little_star'.$img_on_off.'.png', dirname( __FILE__ )  ) . '">';
                } else if( $atyfp_options['atyfp-image'] == 'heart' ){
                    $img_html = '<img src="' . plugins_url( 'common/img/heart'.$img_on_off.'.png', dirname( __FILE__ )  ) . '">';
                } else if( $atyfp_options['atyfp-image'] == 'custom' ){
                    $img_html = '<img src="' . plugins_url( 'common/img/star'.$img_on_off.'.png', dirname( __FILE__ )  ) . '">';
                    // to be done
                } else {
                    $img_html = '<img src="' . plugins_url( 'common/img/star'.$img_on_off.'.png', dirname( __FILE__ )  ) . '">';
                }

                if( $post->myfavourite ) {

                    return '<a ' .
                    'href="#' . $post_data->ID . '"' .
                    'class="atyfp-remove" >' .
                    $img_html . $counter_html .
                    'Remove from your favourites' .
                    '</a>';

                } else {

                    return '<a ' .
                    'href="#' . $post_data->ID . '"' .
                    'class="atyfp-add" >' .
                    $img_html . $counter_html .
                    'add to your favourites' .
                    '</a>';

                }

            }
        }
    }

}