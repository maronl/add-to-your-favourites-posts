<?php

class Atyfp_Manager_Admin {

    private $version;

    function __construct($version)
    {
        $this->version = $version;
    }

    public function init_db_schema()
    {
        global $wpdb;

        $charset_collate = '';

        if (!empty($wpdb->charset)) {
            $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
        }

        if (!empty($wpdb->collate)) {
            $charset_collate .= " COLLATE {$wpdb->collate}";
        }

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        $table_name = $wpdb->prefix . 'your_favourites_posts';

        $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
                  id bigint(20) NOT NULL AUTO_INCREMENT,
                  blog_id int(11) NOT NULL,
                  post_id bigint(20) NOT NULL,
                  user_id bigint(20) NOT NULL,
                  time datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                  PRIMARY KEY id (id),
                  UNIQUE KEY unique_favourite_posts (blog_id, post_id, user_id),
                  KEY blog_favourite_posts (blog_id),
                  KEY post_favourite_posts (post_id),
                  KEY user_favourite_posts (user_id)
                ) $charset_collate;";


        dbDelta($sql);

        add_option('atyfp-db-version', $this->version);

    }

}