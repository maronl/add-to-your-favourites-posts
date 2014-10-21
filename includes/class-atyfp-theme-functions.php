<?php

class Atyfp_Theme_Functions
{

    function __construct()
    {
    }

    public static function  define_theme_functions()
    {

        if (!function_exists('atyfp_link')) {
            function atyfp_link()
            {
                return '<a href="#">add to your favourites</a>';
            }
        }
    }
}