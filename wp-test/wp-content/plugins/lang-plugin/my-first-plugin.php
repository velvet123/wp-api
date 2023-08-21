<?php
/*
Plugin Name: WordPress Multilingual Plugin Tutorial
Description: Learn how to make a WordPress Multilingual Plugin.
Author: flippercode
Version: 1.0.0
Author URI: https://www.flippercode.com
*/

if (!class_exists('Multilingual_Tutorial')) {
    class Multilingual_Tutorial
    {
        /**
         * Construct the plugin object
         */
        public function __construct()
        {
            add_action('admin_menu', array($this, 'multilingual_menu'));
        } // END public function __construct

        public function multilingual_menu()
        {
            add_menu_page(
                __('Multilingual Tutorial', 'text-domain'),
                __('Multilingual Tutorial', 'text-domain'),
                'manage_options',
                'multilingual-tutorial',
                array($this, 'func_multilingual_tutorial')
            );

            add_submenu_page(
                'multilingual-tutorial',
                __('Sub Menu', 'text-domain'),
                __('Sub Menu', 'text-domain'),
                'manage_options',
                'multilingual-tutorial-submenu',
                array($this, 'func_multilingual_tutorial_submenu')
            );
        }

        public function func_multilingual_tutorial()
        {
            _e('Hello, World is here', 'text-domain');
        }

        public function func_multilingual_tutorial_submenu()
        {
            _e('Hello, World is here', 'text-domain');
        }
    }
}

// Instantiate the plugin class
$multilingual = new Multilingual_Tutorial();
