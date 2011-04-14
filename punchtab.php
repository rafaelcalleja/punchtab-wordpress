<?php
/*
Plugin Name: PunchTab for WordPress
Plugin URI: http://punchtab.com
Description: PunchTab rewards for WordPress lets you reward your users for daily visits, Facebook Likes, and leaving comments on your blog. To get started: 1) Get your key by registering your site at <a href="http://www.punchtab.com">PunchTab.com</a>, 2) Enter your key and choose tab placement from the <a href='options-general.php?page=punchtab-plugin'>Settings->PunchTab</a> menu, and 3) Click on the Activate link to the left of this description. To put your own rewards in your catalog log into your <a href="http://www.punchtab.com">PunchTab Dashboard</a>.
Version: 1.01
Author: Ranjith Kumaran
Author URI: http://punchtab.com
*/

// Version check
global $wp_version;
if(!version_compare($wp_version, '3.0', '>='))
{
	die("PunchTab requires WordPress 3.0 or above. <a href='http://codex.wordpress.org/Upgrading_WordPress'>Please update!</a>");
}
// END - Version check

// Make sure class does not exist already.
if(!class_exists('PunchTab')) :

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
			$this->options['xpos'] = 'left';
			$this->options['ypos'] = 'bottom';
			
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
			/*
			* END -Add Hooks
			*/

			/*
			* Process queued events
			*/      			
			if($_COOKIE['comment_posted'])
			{
			  setcookie("comment_posted", "", time()-3600, COOKIEPATH, COOKIE_DOMAIN);
			  echo '<script type="text/javascript">var _ptq = []; _ptq.push(["comment","12"]);</script>';
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
			if (!is_admin())
			{

				$options = $this->get_options();
				$key = $options['key'];
				$xpos = $options['xpos'];
				$ypos = $options['ypos'];
				$url = str_replace("http://","",get_bloginfo('url'));
				$this->show_punchtab_js($key,$url,$xpos,$ypos);
			}
		}
		public function show_punchtab_js($key="",$url="",$xpos="",$ypos="")
		{
			echo '              <script type="text/javascript" charset="utf-8">
              var is_ssl = ("https:" == document.location.protocol);
              var asset_host = is_ssl ? "https://www.punchtab.com/" : "http://www.punchtab.com/";
              document.write(unescape("%3Cscript src=\'" + asset_host + "s/js/pt.js\' type=\'text/javascript\'%3E%3C/script%3E"));
              </script>

              <script type="text/javascript" charset="utf-8">
              var _ptq = _ptq || [];
              var reward_widget_options = {};
              reward_widget_options.domain = "' . $url . '";
              reward_widget_options.key = "' . $key . '";
              reward_widget_options.host = "www.punchtab.com";
              reward_widget_options.position = {x:"' . $xpos . '",y:"' . $ypos . '"};
              var reward_widget = new PT.reward_widget(reward_widget_options);
              </script>
			';
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
		* Usage: alert the user
		* Arg(1): string (message)
		* Return: void
		*/
		public function js_alert($msg)
		{
			echo '<script type="text/javascript">alert("'.$msg.'");</script>';
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