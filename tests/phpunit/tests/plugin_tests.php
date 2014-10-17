<?php

/**
 * Tests to validate plugin code ...100% ...mmh ... mumble ... I hope 80% at least
 *
 * @package wordpress-plugins-tests
 */
class Atyfp_Plugin_Tests extends WP_UnitTestCase {

    function setUp()
    {
        parent::setUp();

        $addToYourFavouritesPostsOptions = array(
            'atyfp-only-registered-users' => '1', // 0, 1
            'atyfp-show-mode' => 'counter', //counter, single
            'atyfp-image' => 'star' //star,heart or path to a custom images
        );

        add_option('atyfp-options', $addToYourFavouritesPostsOptions);
        //atyfb-db-version

        // force DB schema creation - tobedone in a smarter way
        $data_model = Atyfp_Model::getinstance();
        //$admin = new Atyfp_Manager_Admin( '1.0.0', $addToYourFavouritesPostsOptions, $data_model );
        //$admin->init_db_schema();
    }

    function tearDown()
    {
        parent::tearDown();
        delete_option('atyfp-options');
    }

    function test_default_plugin_options_values()
    {
        $addToYourFavouritesPostsOptions = get_option('atyfp-options');
        $this->assertCount(3, $addToYourFavouritesPostsOptions, 'le opzioni indicate nel record atyfp-options devono essere 3');
        $this->assertEquals('1', $addToYourFavouritesPostsOptions['atyfp-only-registered-users']);
        $this->assertEquals('counter', $addToYourFavouritesPostsOptions['atyfp-show-mode']);
        $this->assertEquals('star', $addToYourFavouritesPostsOptions['atyfp-image']);
    }


}
