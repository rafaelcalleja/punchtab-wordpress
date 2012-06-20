<?php
/*
    Plugin Name: PunchTab for WordPress
    Plugin URI: http://punchtab.com
    Description: PunchTab rewards for WordPress lets you reward your users for daily visits, Facebook Likes, and leaving comments on your blog. To get started: 1) Get your key by registering your site at <a href="http://www.punchtab.com">PunchTab.com</a>, 2) Enter your key and choose tab placement from the <a href='options-general.php?page=punchtab-plugin'>Settings->PunchTab</a> menu, and 3) Click on the Activate link to the left of this description. To put your own rewards in your catalog log into your <a href="http://www.punchtab.com">PunchTab Dashboard</a>.
    Version: 1.8
    Author: PunchTab
    Author URI: http://punchtab.com
*/

// Version check
global $wp_version;
if(!version_compare($wp_version, '3.0', '>='))
{
    die("PunchTab requires WordPress 3.0 or above. <a href='http://codex.wordpress.org/Upgrading_WordPress'>Please update!</a>");
}
// END - Version check

/*
Add a link to the settings page with the others links: Activate | Delete
TODO change the description text
function pt_plugin_action_links($links, $file) {
    $plugin_file = basename(__FILE__);
    if (basename($file) == $plugin_file) {
        $settings_link = '<a href="options-general.php?page=punchtab-plugin">'.__('Settings', 'punchtab').'</a>';
        array_unshift($links, $settings_link);
    }
    return $links;
}
add_filter('plugin_action_links', 'pt_plugin_action_links', 10, 2);
*/


//this is to avoid getting in trouble because of the
//wordpress bug http://core.trac.wordpress.org/ticket/16953
$punchtab_file = __FILE__; 

if ( isset( $mu_plugin ) ) { 
    $punchtab_file = $mu_plugin; 
} 
if ( isset( $network_plugin ) ) { 
    $punchtab_file = $network_plugin; 
} 
if ( isset( $plugin ) ) { 
    $punchtab_file = $plugin; 
} 

$GLOBALS['punchtab_file'] = $punchtab_file;


// Make sure class does not exist already.
if(!class_exists('PunchTab')) :

    class PunchTabWidget extends WP_Widget {
        function PunchTabWidget() {
            parent::WP_Widget(false, 'PunchTab Widget', array('description' => 'Description'));
        }

        function widget($args, $instance) {
            echo '<div id="punchtab_widget"></div>';
        }

        function update( $new_instance, $old_instance ) {
            // Save widget options
            return parent::update($new_instance, $old_instance);
        }

        function form( $instance ) {
            // Output admin widget options form
            return parent::form($instance);
        }
    }

    function punchtab_widget_register_widgets() {
        register_widget('PunchtabWidget');
    }

    // Declare and define the plugin class.
    class PunchTab
    {
        // will contain id of plugin
        private $plugin_id;
        // will contain option info
        private $options;

        /** function/method
        * Usage: defining the constructor
        * Arg(1): string(alphanumeric, underscore, hyphen)
        * Return: void
        */
        public function __construct($id)
        {
            // set id
            $this->plugin_id = $id;
            // create array of options
            $this->options = array();
            // set default options
            $this->options['key'] = '';
            $this->options['language'] = '';
            $this->options['enable_rewards'] = 'on';
            $this->options['enable_badges'] = 'off';
            $this->options['xpos'] = 'left';
            $this->options['ypos'] = 'bottom';
            $this->options['display'] = 'tab';
            $this->options['earningmap'] = 1;
            $this->options['name'] = NULL;
            $this->options['badge_xpos'] = 'left';
            $this->options['badge_ypos'] = 'bottom';

            /*
            * Add Hooks
            */
            // register the script files into the footer section
            add_action('wp_footer', array(&$this, 'punchtab_scripts'));
            // initialize the plugin (saving default options)
            register_activation_hook(__FILE__, array(&$this, 'install'));
            // triggered when comment is posted (Email)
            add_action('comment_post', array(&$this, 'comment_reward'));
            // triggered when plugin is initialized (used for updating options)
            add_action('admin_init', array(&$this, 'init'));
            // register the menu under settings
            add_action('admin_menu', array(&$this, 'menu'));
            // Register sidebar widget
            add_action('widgets_init', 'punchtab_widget_register_widgets');


            function admin_scripts() {

                $wp_punchtab_plugin_url = plugins_url('wp-punchtab.js', $GLOBALS['punchtab_file']);
                wp_register_script( 'punchtab-admin-js', $wp_punchtab_plugin_url ,array('jquery-ui-core','jquery-ui-dialog','jquery-ui-widget','json2'));
                wp_enqueue_script('punchtab-admin-js');
            }

            function admin_styles() {

                wp_register_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);
                wp_enqueue_style( 'jquery-style' );

            }

            add_action( 'admin_print_scripts-settings_page_punchtab-plugin', 'admin_scripts' );
            add_action( 'admin_print_styles-settings_page_punchtab-plugin', 'admin_styles' );
            /*
            * END -Add Hooks
            */

            /*
            * Process queued events
            */
            if(isset($_COOKIE['comment_posted']))
            {
              setcookie("comment_posted", "", time()-3600, COOKIEPATH, COOKIE_DOMAIN);
              add_action('wp_head', create_function('', 'echo "<script type=\"text/javascript\">var _ptq = []; var _btq = []; _ptq.push([\"comment\",\"12\"]); _btq.push([\"comment\",\"42\"]);</script>";'));
            }
           /*
            * END -Process queued events
            */
        }

        /** function/method
        * Usage: return plugin options
        * Arg(0): null
        * Return: array
        */
        private function get_options()
        {
            // return saved options
            $options = get_option($this->plugin_id);
            return $options;
        }
        /** function/method
        * Usage: update plugin options
        * Arg(0): null
        * Return: void
        */
        private function update_options($options=array())
        {
            // update options
            update_option($this->plugin_id, $options);
        }

        /** function/method
        * Usage: helper for loading punchtab.js
        * Arg(0): null
        * Return: void
        */
        public function punchtab_scripts()
        {
            if (!is_admin()) {
                $options = $this->get_options();
                $key = trim($options['key']);
                $language = trim($options['language']);
                $xpos = trim($options['xpos']);
                $ypos = trim($options['ypos']);
                $display = trim($options['display']);
                $earningmap = $options['earningmap'] ? 'true' : 'false';
                $name = isset($options['name']) ? $options['name'] : NULL;
                $badge_xpos = trim($options['badge_xpos']);
                $badge_ypos = trim($options['badge_ypos']);
                if ($name == "") {
                    $name = NULL;
                }
                if ($options['enable_rewards']) {
                    $this->show_punchtab_reward_js($key,$language,$xpos,$ypos,$display,$earningmap,$name);
                }
                if ($options['enable_badges']) {
                    $this->show_punchtab_badge_js($key,$language,$badge_xpos,$badge_ypos);
                }
            }
        }
        public function show_punchtab_reward_js($key="",$language="",$xpos="",$ypos="",$display="",$earningmap='true',$name=NULL)
        {
            $asset_host = "static.punchtab.com/";
            $domain = "www.punchtab.com";

            echo '          <script type="text/javascript" charset="utf-8">
                var _ptq = _ptq || [];
                var _punchtab_settings = {
                    key: "'. $key . '",
                    language: "'. $language . '",
                    display: "'. $display. '",
                    earningmap: '. $earningmap .',
                    position: {x:"'.$xpos.'", y:"'.$ypos.'"}
                };';


            echo "\n";

            if (!is_null($name)) {
                  echo '            _punchtab_settings.name = "'.$name.'";';
                echo "\n";
            }

            echo '              (function() {
                var pt = document.createElement(\'script\'); pt.type = \'text/javascript\'; pt.async = true;
                pt.src = (\'https:\' == document.location.protocol ? \'https://\' : \'http://\') +\''.$asset_host.'js/pt.js?src=wordpress\';
                var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(pt, s);
            })();';

            echo "\n";
            echo '          </script>';
            echo "\n";
        }

        public function show_punchtab_badge_js($key="",$language="",$xpos="", $ypos="")
        {
            $asset_host = "static.punchtab.com/";
            $domain = "www.punchtab.com";

            $script = '<script type="text/javascript" charset="utf-8">';
            $script .= 'var _btq = _btq || [];';
            $script .= 'var _punchtab_settings_badges = {';
            $script .= '  key: "'. $key . '",';
            $script .= '  language: "'. $language . '",';
            $script .= '  position: {x: "'. $xpos . '", y: "' . $ypos . '"}';
            $script .= '};';
            $script .= '(function() {';
            $script .= 'var pt = document.createElement(\'script\'); pt.type = \'text/javascript\'; pt.async = true;';
            $script .= 'pt.src = (\'https:\' == document.location.protocol ? \'https://\' : \'http://\') +\''.$asset_host.'js/pb.js?src=wordpress\';';
            $script .= 'var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(pt, s);';
            $script .= '})();';
            $script .= '</script>';

            echo $script;
        }

        /** function/method
        * Usage: helper for hooking activation (creating the option fields)
        * Arg(0): null
        * Return: void
        */
        public function install()
        {
            $this->update_options($this->options);
        }
        /** function/method
        * Usage: helper for hooking notification when comment is posted
        * Arg(1): int (comment id)
        * Return: int (comment id)
        */
        public function comment_reward($comment)
        {
              setcookie("comment_posted", 1, time()+3600, COOKIEPATH, COOKIE_DOMAIN);
        }
        /** function/method
        * Usage: helper for hooking (registering) options
        * Arg(0): null
        * Return: void
        */
        public function init()
        {
            register_setting($this->plugin_id.'_options', $this->plugin_id);
        }
        /** function/method
        * Usage: show options/settings form page
        * Arg(0): null
        * Return: void
        */
        public function options_page()
        {
            if (!current_user_can('manage_options'))
            {
                wp_die( __('You can manage options from the Settings->PunchTab Options menu.') );
            }

            // get saved options
            $options = $this->get_options();
            $updated = false;

            if (!isset($options['earningmap'])) {
                $options['earningmap'] = 1;
                $updated = true;
            }
            if (!isset($options['enable_rewards'])) {
                $options['enable_rewards'] = 1;
                $updated = true;
            }
            if (!isset($options['enable_badges'])) {
                $options['enable_badges'] = 0;
                $updated = true;
            }

            if ($updated) {
                $this->update_options($options);
            }
            include('punchtab_options_form.php');
        }
        /** function/method
        * Usage: helper for hooking (registering) the plugin menu under settings
        * Arg(0): null
        * Return: void
        */
        public function menu()
        {
            add_options_page('PunchTab Options', 'PunchTab', 'manage_options', $this->plugin_id.'-plugin', array(&$this, 'options_page'));
        }
    }

    // Instantiate the plugin
    $PunchTab = new PunchTab('punchtab');

// END - class exists
endif;
?>
