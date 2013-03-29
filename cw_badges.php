<?php
/*
Plugin Name: My Coderwall Badges
Description: gets your badges from coderwall website and let you show them on your blog.
Author: Francesco Lentini
Version: 0.6
Plugin URI: https://github.com/flentini/my-coderwall-badges
Author URI: http://github.com/flentini 
*/

add_action('init','cwb_init');
add_action('wp_enqueue_scripts', 'cwb_stylesheet');
add_action('admin_menu', 'cwb_init_admin');
add_action('plugins_loaded', 'cwb_plugins_loaded');

function cwb_init(){
	require_once('cwbclass.php');
	define('CWB_URLPATH', WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)));
	load_plugin_textdomain('my-coderwall-badges', false, 'my-coderwall-badges/i18n');
	global $cwb;
	$cwb = new CWB();
	add_shortcode('cwbadges', array(&$cwb, 'get_badges'));
}

function cwb_init_admin() {
	$ad_opt_page = add_menu_page(__('My CW Badges', 'my-coderwall-badges'), __('My CW Badges', 'my-coderwall-badges'),
		'manage_options', 'cwbadges-plugin', 'cwb_options',CWB_URLPATH .'/css/coderwallicon.png');
	add_action('admin_print_styles-'.$ad_opt_page, wp_enqueue_style('cwb-css', CWB_URLPATH .'/css/style.css', false, false, 'all'));
}

function cwb_stylesheet(){
	$cwb_css_url = plugins_url('css/style.css', __FILE__);
	$cwb_css_file = WP_PLUGIN_DIR . '/coderwall-badges/css/style.css';

	wp_register_style('cwb-css', $cwb_css_url);
	wp_enqueue_style('cwb-css', $cwb_css_file, false, false, 'all');
}

function cwb_plugins_loaded(){
	wp_register_sidebar_widget('coderwall', 'Coderwall', 'widget_coderwall');
}

function cwb_options() {
	if (!current_user_can('manage_options'))  {
				wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	global $cwb;

	if (isset($_POST['cwusername'])&&!empty($_POST['cwusername'])) {
		$cwb->set_username($_POST['cwusername']);
	}

	if (isset($_POST['cwendorse'])&&!empty($_POST['cwendorse'])) {
		$cwb->set_show_endorse($_POST['cwendorse']);
	} else {
		$cwb->set_show_endorse('off');
	}

	?>

	<div class="wrap">
		<p><div id="icon-users" class="icon32"></div><h2><?php _e('My Coderwall Badges', 'my-coderwall-badges'); ?></h2></p>
		<div>
			<div style="display: inline-block; float: left">
				<?php echo __('Name', 'my-coderwall-badges').': <h3>'.$cwb->get_name().'</h3>'; ?>
				<?php echo __('Location', 'my-coderwall-badges').': <h3>'.$cwb->get_location().'</h3>'; ?>
			</div>
			<div style="display: inline-block; margin-left: 150px; margin-bottom: 125px;">
			<form name="cwb_form" method="post" action="<?php str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
				<label for="cwusername"><?php _e('Coderwall username', 'my-coderwall-badges'); ?>: </label>
				<input id="cwusername" maxlength="45" size="25" name="cwusername" value="<?php echo $cwb->get_username(); ?>" />
				</br>
				<label for="cwendorse"><?php _e('Display endorse count', 'my-coderwall-endorsecount'); ?>: </label>
				<input id="cwendorse" type="checkbox" name="cwendorse" <?php if($cwb->get_show_endorse() == 'on') echo 'checked = checked' ?>/>
				</br>
				<?php submit_button(); ?>
			</form>
			</div>
		</div>
		<div>
			<?php echo $cwb->get_badges(); ?>
		</div>
	</div>
<?php }

function widget_coderwall ($args){
	global $cwb;

	extract($args);

	echo $before_widget . $before_title;
	_e('My Coderwall Badges', 'my-coderwall-badges');
	echo $after_title;
	echo $cwb->get_badges();
	if ($cwb->get_show_endorse()=='on'){
		echo $cwb->get_endorsements();
	}
	echo $after_widget;
}
