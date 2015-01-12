<?php 
/*
Plugin Name: JC REcaptcha
Plugin URI: http://webdesignjc.com/recaptchawp/index.html
Description: Add new reCAPTCHA google in form
Version: 1:001
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


if(get_option('ninja_form') !== ""){add_action( 'ninja_form', 'jcrecaptchacont' );}
if(get_option('ninja_form') !== ""){add_action( 'init', 'jc_ninja_form_fields' );}



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
	register_setting( 'jc-settings-re', 'ninja_form' );
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
						if(get_option('ninja_form') !== ""){ $checked4 = "checked=\"checked\""; }else{ $checked = "";}
						?>
						<input type="checkbox" name="comment_form" id="<?php echo get_option('comment_form'); ?>" value="comment" <?php echo $checked1; ?> />Comment <br>
						<input type="checkbox" name="login_form" id="<?php echo get_option('login_form'); ?>" value="login" <?php echo $checked2; ?> />Login<br>
						<input type="checkbox" name="register_form" id="<?php echo get_option('register_form'); ?>" value="register" <?php echo $checked3; ?> />Register<br>
						<input type="checkbox" name="ninja_form" id="<?php echo get_option('ninja_form'); ?>" value="ninja" <?php echo $checked4; ?> />Ninja Form<br>
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
			echo '<div class="g-recaptcha jc" data-sitekey="'.$id.'"></div>';
		}
	}
	function jc_scripts_method() {	
		wp_enqueue_script( 'jcscriptsapi', plugins_url( '/js/api.js', __FILE__ ) );
		wp_enqueue_script( 'jcscripts', plugins_url( '/js/jcscript.js', __FILE__ ),array( 'jquery' ) );
	}
	?>

	<?php 
	function jc_ninja_form_fields() {
		$argsjc = array(
			'name' => __( 'JCreCAPTCHA', 'ninja-forms' ),
			'edit_function' => '',
			'display_function' => 'jcrecaptchacont',
			'group' => 'standard_fields',
			'edit_label' => true,
			'edit_label_pos' => true,
			'edit_req' => false,
			'edit_custom_class' => false,
			'edit_help' => true,
			'edit_meta' => false,
			'sidebar' => 'template_fields',
			'display_label' => true,
			'edit_conditional' => false,
			'conditional' => array(
				'value' => array(
					'type' => 'text',
					),
				),
			'pre_process' => '',
			'process_field' => false,
			'limit' => 1,
			'edit_options' => array(
				),
			'req' => true,
			);
		if( function_exists( 'ninja_forms_register_field' ) )
		{
			ninja_forms_register_field('user_jc', $argsjc);
		}
	}
	function jcrecaptchacont( $field_id, $data, $form_id = '' ){
		$id=  esc_attr( get_option("new_option_name") );
		echo '<div class="g-recaptcha jc" data-sitekey="'.$id.'"></div>';
	}
	?>