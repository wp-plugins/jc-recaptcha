<?php 
/*
Plugin Name: JC REcaptcha
Plugin URI: http://webdesignjc.com/recaptchawp/index.html
Description: Add new reCAPTCHA google in form
Version: 1:0
Author: Julio Cesar LLavilla Ccama
Autor URI: http://webdesignjc.com
License: GPL2
*/
?>
<?php
// create custom plugin settings menu
add_action('admin_menu', 'jc_baw_create_menu');
add_action( 'login_enqueue_scripts', 'jc_scripts_method' );
add_action( 'wp_enqueue_scripts', 'jc_scripts_method' );
add_action( 'admin_enqueue_scripts', 'jc_scripts_method' );

if(get_option('comment_form') !== ""){add_action( 'comment_form', 'reCAPTCHA_add' );}				
if(get_option('login_form') !== ""){add_action( 'login_form', 'reCAPTCHA_add' ); }
if(get_option('register_form') !== ""){add_action( 'register_form', 'reCAPTCHA_add' );}
function jc_baw_create_menu() {
	//create new top-level menu
	add_menu_page('RECAPTCHA Plugin Settings', 'RECAPTCHA  Settings', 'administrator', __FILE__, 'jc_recatcha_settings_page',plugins_url('/images/icon.png', __FILE__));
	//call register settings function
	add_action( 'admin_init', 'jc_register_mysettings_re' );
}
function jc_register_mysettings_re() {
	//register our settings
	register_setting( 'jc-settings-re', 'new_option_name' );
	//register our settings
	register_setting( 'jc-settings-re', 'comment_form' );
	register_setting( 'jc-settings-re', 'login_form' );
	register_setting( 'jc-settings-re', 'register_form' );
}
function jc_recatcha_settings_page() {
	?>
	<div class="wrap">
		<h2>Global configuration</h2>
		<p>Registra tu dominio en la pagina oficial de google recaptcha</p>
		<a href="https://www.google.com/recaptcha">Register domain</a>
		<p>Una vez registrado el dominio pega la clave de sitio que te provee Google Recaptcha.</p>
		<form method="post" action="options.php">
			<?php settings_fields( 'jc-settings-re' ); ?>
			<?php do_settings_sections( 'jc-settings-re' ); ?>
			<table class="form-table">
				<tr valign="top">
					<td>
						<label for=""><b>Clave del sitio:</b> </label>
						<input type="text" name="new_option_name" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" />
					</td>
				</tr>
				<tr>
					<td>
						<h2>Form configuration</h2>
					</td>
				</tr>
				<tr valign="top">
					<td>
						<label for=""><b> Seleccionar formularios:</b></label><br>
						<?php
						if(get_option('comment_form') !== ""){$checked1 = "checked=\"checked\""; }else{ $checked = "";}					
						if(get_option('login_form') !== ""){ $checked2 = "checked=\"checked\""; }else{ $checked = "";}
						if(get_option('register_form') !== ""){ $checked3 = "checked=\"checked\""; }else{ $checked = "";}
						?>
						<input type="checkbox" name="comment_form" id="<?php echo get_option('comment_form'); ?>" value="comment" <?php echo $checked1; ?> />Comment <br>
						<input type="checkbox" name="login_form" id="<?php echo get_option('login_form'); ?>" value="login" <?php echo $checked2; ?> />Login<br>
						<input type="checkbox" name="register_form" id="<?php echo get_option('register_form'); ?>" value="register" <?php echo $checked3; ?> />Register
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
		<div>
			<a href="http://webdesignjc.com/recaptchawp/index.html">Mas detalles</a>
		</div>
	</div>
	<?php } ?>
	<?php
	if ( ! function_exists( 'reCAPTCHA_add' ) ) {
		function reCAPTCHA_add() {

			$id=  esc_attr( get_option("new_option_name") );
			echo '<div class="g-recaptcha" data-sitekey="'.$id.'"></div>';
		}
	}
	function jc_scripts_method() {	
		wp_enqueue_script( 'jcscriptsapi', plugins_url( '/js/api.js', __FILE__ ) );
		wp_enqueue_script( 'jcscripts', plugins_url( '/js/jcscript.js', __FILE__ ),array( 'jquery' ) );
	}
	?>