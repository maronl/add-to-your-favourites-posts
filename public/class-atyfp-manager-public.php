<?php

class Atyfp_Manager_Public {

    private $version;

    private $options;

    private $data_model;

    private $js_configuration;

    function __construct( $version, $options, $data_model ) {
        $this->version = $version;
        $this->options = $options;
        $this->data_model = $data_model;
        if(WP_DEBUG == false) {
            $this->js_configuration['js_path'] = 'js/prod/';
            $this->js_configuration['js_extension'] = $this->version . '.min.js';
        }else{
            $this->js_configuration['js_path'] = 'js/';
            $this->js_configuration['js_extension'] = 'js';
        }
    }

    public function register_scripts() {
        wp_register_script( 'atyfp-public-js', plugins_url( $this->js_configuration['js_path'] . 'atyfp-public.' . $this->js_configuration['js_extension'], __FILE__ ), array( 'jquery' ) );
        wp_localize_script( 'atyfp-public-js', 'ajax_atyfp', array(
            'url' => '/wp-admin/admin-ajax.php',
            'security' => wp_create_nonce( "atyfp-ajax" ),
        ) );

    }

    public function enqueue_scripts($hook) {
        wp_enqueue_script('atyfp-public-js');
    }

}