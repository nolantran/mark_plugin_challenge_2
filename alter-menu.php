<?php
/*
Plugin Name: Alter Menu Plugin
Plugin URI: http://markmeldrum.com/plugin
Description: This plugin alter the menu items depending on user roles.
Version: 1.0.0
Author: Nolan Tran
Author URI: https://www.linkedin.com/in/nolan-tran-9489bb188//
License: GPv2 or later
Text Domain: alter-menu-plugin
*/
?>
<?php
// If something external from our website trying to access, then kill it
if ( ! defined( 'ABSPATH' ) ) {
	die;
}


// Add customer role because customer role doesn't exist on new wordpress page
$newrole = add_role(
    'customer',
     __( 'Customer' ),
     array(
     'read'         => true,  
     'edit_posts'   => true,
     'delete_posts' => false, 
     'publish_post'=> true
   )
);

function add_roles_on_plugin_activation() {
      add_role( 'custom_role', 'Custom Subscriber', array( 'read' => true, 
      'level_0' => true ) );
  }

register_activation_hook( __FILE__, 'add_roles_on_plugin_activation' );

// Get the current role and then remove the menu item based on the role
function delete_menu() {
    global $current_user;

    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);

    if ( $user_role == 'administrator' ) { //your user id
        remove_menu_page('edit.php'); // Posts
        remove_menu_page('upload.php'); // Media
        remove_menu_page('link-manager.php'); // Links
        remove_menu_page('edit-comments.php'); // Comments
        remove_menu_page('edit.php?post_type=page'); // Pages
        remove_menu_page('plugins.php'); // Plugins
        remove_menu_page('themes.php'); // Appearance
        remove_menu_page('users.php'); // Users
        remove_menu_page('tools.php'); // Tools
        remove_menu_page('options-general.php'); // Settings
        remove_menu_page('edit.php'); // Posts
        remove_menu_page('upload.php'); // Media
    }
    else if ($user_role == 'subscriber') {
        
    }
    else if ($user_role == 'customer') {
        
    }
    
}
  add_action( 'admin_menu', 'delete_menu' );