<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<p>¡Bienvenid@ a AT Academia del Transportista!</p>

<p>Ya formas parte del Club AT ¡los elegidos para mover el mundo!</p>

<p>A partir de ahora puedes acceder a tu cuenta con el nombre de usuario: <?php echo esc_html( $user_login ); ?></p>

<p>Ser miembro del Club AT tiene multitud de ventajas:</p>

<ul>
	<li>Acceso a ofertas de empleo activas.</li>
    <li>Compra tus cursos más baratos que en ningún otro lugar.</li>
    <li>Gestiona tus datos personales.</li>
    <li>Suscripción a información y novedades del sector.</li>
</ul>

<p>Accede ahora a tu perfil haciendo clic <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>">aquí</a>.</p>

<?php do_action( 'woocommerce_email_footer', $email );