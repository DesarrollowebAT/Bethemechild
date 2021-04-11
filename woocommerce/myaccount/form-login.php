<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if(true)/*$_SERVER['REMOTE_ADDR']=='88.17.235.0')*/
{
	do_action( 'woocommerce_before_customer_login_form' ); ?>
    <div class="forms_container">
    	<div class="form form_login">
        	<h2><?php esc_html_e( 'Accede a tu cuenta', 'academiadeltransportista' ); ?></h2>
            <div class="white_box">
            	<p class="form_title"><?php _e('Introduce tu correo de usuario y tu contraseña de acceso','academiadeltransportista'); ?></p>
                <form class="woocommerce-form woocommerce-form-login login" method="post">
                    <div class="the_input">
                        <label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
                    </div>
                    <div class="the_input">
                        <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
                    </div>
                    <div class="the_input">
                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                        </label>
                    </div>
                    <div class="the_input">
                        <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                        <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
                    </div>
                    <div class="the_input forgot_password">
                        <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
                    </div>
                </form>
            </div>
        </div>
        <div class="form form_register">
        	<h2><?php esc_html_e( 'Regístrate gratis, es rápido y sencillo', 'academiadeltransportista' ); ?></h2>
        	<div class="white_box">
	        	<div class="column1">
                	<p class="form_title"><?php _e('Ser parte del club AT es completamente <span>gratuito</span> y <span>muy fácil</span>','academiadeltransportista'); ?></p>
                    <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> ><?php 
						do_action( 'woocommerce_register_form_start' );
						if('no' === get_option( 'woocommerce_registration_generate_username'))
						{ ?>
                        	<div class="the_input">
                                <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                            </div><?php 
						} ?>            
                        <div class="the_input">
                            <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                        </div><?php 
						if('no' === get_option( 'woocommerce_registration_generate_password'))
						{ ?>            
                            <div class="the_input">
                                <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
                            </div><?php 
						}
						else
						{ ?>            
                            <p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p><?php 
						} ?>
                        <div class="the_input">
                            <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                            <button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
                        </div><?php 
						do_action( 'woocommerce_register_form' );
						do_action( 'woocommerce_register_form_end' ); ?>
                    </form>
        	    </div>
	            <div class="column2">
                	<p class="ventajas_title"><?php _e('Disfruta de todas las ventajas de formar parte del Club AT','academiadeltransportista'); ?></p>
                    <ul class="ventajas">
                    	<li><?php _e('Es completamente <strong>GRATUITO</strong>.','academiadeltransportista'); ?></li>
                        <li><?php _e('Accede a nuestra <strong>bolsa de empleo para conductores y transportistas</strong>. ','academiadeltransportista'); ?></li>
                        <li><?php _e('Obtén <strong>descuentos en carburantes</strong>.','academiadeltransportista'); ?></li>
                        <li><?php _e('Contrata <strong>seguros al mejor precio</strong>. ','academiadeltransportista'); ?></li>
                        <li><?php _e('Infórmate de las <strong>novedades del sector</strong>. ','academiadeltransportista'); ?></li>
                        <li><?php _e('Disfruta de <strong>descuentos para cines y espectáculos</strong>.','academiadeltransportista'); ?></li>
                        <li><?php _e('<strong>Y mucho más...</strong>','academiadeltransportista'); ?></li>
                    </ul>
            	</div>
            </div>
        </div>
	</div><?php	
	do_action( 'woocommerce_after_customer_login_form' );
}
else
{
	do_action( 'woocommerce_before_customer_login_form' );
	
	if('yes' === get_option( 'woocommerce_enable_myaccount_registration')) : ?>
	
	<div class="u-columns col2-set" id="customer_login">
	
		<div class="u-column1 col-1">
	
	<?php endif; ?>
	
			<h2><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>
	
			<form class="woocommerce-form woocommerce-form-login login" method="post">
	
				<?php do_action( 'woocommerce_login_form_start' ); ?>
	
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
				</p>
	
				<?php do_action( 'woocommerce_login_form' ); ?>
	
				<p class="form-row">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
					</label>
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
					<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
				</p>
				<p class="woocommerce-LostPassword lost_password">
					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
				</p>
	
				<?php do_action( 'woocommerce_login_form_end' ); ?>
	
			</form>
	
	<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
	
		</div>
	
		<div class="u-column2 col-2">
	
			<h2><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>
	
			<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
	
				<?php do_action( 'woocommerce_register_form_start' ); ?>
	
				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
	
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
					</p>
	
				<?php endif; ?>
	
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>
	
				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
	
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
					</p>
	
				<?php else : ?>
	
					<p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>
	
				<?php endif; ?>
	
				<?php do_action( 'woocommerce_register_form' ); ?>
	
				<p class="woocommerce-FormRow form-row">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
				</p>
	
				<?php do_action( 'woocommerce_register_form_end' ); ?>
	
			</form>
	
		</div>
	
	</div>
	<?php endif; ?>
	
	<?php do_action( 'woocommerce_after_customer_login_form' );
} ?>