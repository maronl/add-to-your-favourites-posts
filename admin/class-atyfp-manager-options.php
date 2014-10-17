<?php

class Atyfp_Manager_Options {

    private $version;

    private $options;

    private $js_configuration;

    function __construct($version, $options) {
        $this->version = $version;
        $this->options = $options;
        if(WP_DEBUG == false) {
            $this->js_configuration['js_path'] = ATYFP_JS_PROD_PATH;
            $this->js_configuration['js_extension'] = $this->version . '.min.js';
        }else{
            $this->js_configuration['js_path'] = ATYFP_JS_PATH;
            $this->js_configuration['js_extension'] = 'js';
        }
    }

    function add_plugin_options_page() {
        add_options_page(
            'Add to Your Favourites Posts Options',
            __('Add to Your Favourites Posts', 'atyfp'),
            'manage_options',
            'atyfp-plugin-options',
            array( $this, 'render_admin_options_page' )
        );
    }

    function render_admin_options_page() {
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2><?php _e( 'Add to Your Favourites Posts Plugin Options', 'add-to-your-favourites' )?></h2>
            <form method="post" action="options.php">
                <?php
                settings_fields( 'atyfp-options' );
                do_settings_sections( 'atyfp-options' );
                submit_button();
                ?>
            </form>
        </div>
    <?php
    }

    function options_page_init() {
        register_setting(
            'atyfp-options', // Option group
            'atyfp-options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'atyfp-options', // ID
            'Add to Your Favourites Posts Options', // Title
            array( $this, 'print_section_info' ), // Callback
            'atyfp-options' // Page
        );

        add_settings_field(
            'atyfp-only-registered-users',
            __('Enable only registered users', 'atyfp'), // Title
            array( $this, 'only_registered_users_callback' ), // Callback
            'atyfp-options', // Page
            'atyfp-options' // Section
        );

        add_settings_field(
            'atyfp-show-mode',
            __( 'Mode', 'atyfp' ),
            array( $this, 'show_mode_callback' ),
            'atyfp-options',
            'atyfp-options'
        );

        add_settings_field(
            'atyfp-image',
            __( 'Image', 'atyfp' ),
            array( $this, 'image_callback' ),
            'atyfp-options',
            'atyfp-options'
        );

    }

    public function print_section_info()
    {
        _e( 'Enter your settings below:', 'atyfp' );
    }

    function sanitize( $input ) {

        foreach ($input as $key => $value){
            $input[$key] =  sanitize_text_field($value);
        }

        $input['atyfp-only-registered-users'] = intval( $input['atyfp-only-registered-users'] );

        return $input;
    }

    public function only_registered_users_callback() {
        $value = ( isset( $this->options['atyfp-only-registered-users'] ) && ( 1 == $this->options['atyfp-only-registered-users'] ) ) ? 'checked' : '';
        $description = '<p class="description">' . __('enable only registered users to have favourites posts', 'atyfp') . '</p>';
        printf(
            '<input type="checkbox" id="atyfp-only-registered-users" name="atyfp-options[atyfp-only-registered-users]" value="1" autocomplete="off" %s/>%s',
            $value,
            $description
        );
    }

    public function show_mode_callback() {

        $mode_options = array(
            'counter' => __('show counter mode', 'atyfp'),
            'single' => __('show single mode', 'atyfp')
        );

        $format = '<br /><input type="radio" id="atyfp-show-mode" name="atyfp-options[atyfp-show-mode]" value="%s" %s/> %s';

        foreach( $mode_options as $key => $value ){
            $checked = '';
            if( isset( $this->options['atyfp-show-mode'] ) && ( $key == $this->options['atyfp-show-mode'] ) ) {
                $checked = 'checked';
            }

            printf( $format, $key, $checked, $value );
        }

    }

    public function image_callback() {
        $image_options = array(
            'star' => __( 'star image', 'atyfp' ),
            'little_star' => __( 'little star image', 'atyfp' ),
            'heart' => __( 'heart image', 'atyfp' ),
            'custom' => __( 'custom image', 'atyfp' )
        );
        $image_files = array(
            'star' => 'star.png',
            'little_star' => 'little_star.png',
            'heart' => 'heart.png'
        );

        $format = '<br /><input type="radio" id="atyfp-image" name="atyfp-options[atyfp-image]" value="%s" %s/>%s %s';

        foreach( $image_options as $key => $value ) {
            $checked = '';
            if( isset( $this->options['atyfp-image'] ) && ( $key == $this->options['atyfp-image'] ) ) {
                $checked = 'checked';
            }
            $img_tag = '';
            if( isset( $image_files[$key] ) ) {
                $img_tag = '<img src="' . plugins_url( ATYFP_COMMON_PATH . '/img/' . $image_files[$key], dirname( __FILE__ ) ) . '">';
            }

            printf( $format, $key, $checked,  $img_tag, $value );
        }

        //echo '<br /><input type="file" name="atyfp-custom-image" id="atyfp-custom-image" />';
    }


}