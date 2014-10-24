<?php
class Atyfp_Model {

    private static $_instance = null;

    private function __construct() { }
    private function  __clone() { }

    public static function getInstance() {
        if( !is_object(self::$_instance) )
            self::$_instance = new Atyfp_Model();
        return self::$_instance;
    }

    public function wp_query_join_atyfp_data( $join ) {
        global $wpdb;
        $join .= " LEFT JOIN $wpdb->postmeta as favourites_counter " .
            " ON ( $wpdb->posts.ID = favourites_counter.post_id AND (favourites_counter.meta_key = 'atyfp-counter') ) ";

        if( is_user_logged_in() ) {
            global $wpdb;
            $user_id = get_current_user_id();
            $blog_id = get_current_blog_id();
            $join .= " LEFT JOIN " . $wpdb->prefix . "your_favourites_posts as myfavourites " .
                " ON ( $wpdb->posts.ID = myfavourites.post_id " .
                " AND myfavourites.user_id  = " . $user_id .
                " AND myfavourites.blog_id  = " . $blog_id . ") ";
        }

        return $join;
    }

    public function wp_query_fields_atyfp_data( $fields ) {
        $fields .= ", IFNULL(favourites_counter.meta_value, 0) as favourites_counter ";
        if( is_user_logged_in() ) {
            $fields .= ", IFNULL(myfavourites.time, 0) as myfavourite ";
        }
        return ($fields);
    }


} 