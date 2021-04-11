<?php
/**
 * HTML start template part.
 *
 * @package AMP
 */

/**
 * Context.
 *
 * @var AMP_Post_Template $this
 */
?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); // WPCS: XSS ok. ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<style amp-custom>
		<?php $this->load_parts( array( 'style' ) ); ?>
		<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
    
    <!-- AMP Analytics --><script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
        <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
        <script async custom-element="amp-video" src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>
        <script async custom-element="amp-bind" src="https://cdn.ampproject.org/v0/amp-bind-0.1.js"></script>
        <!--<script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>-->
</head>


<body class="<?php echo esc_attr( $this->get( 'body_class' ) ); ?>">
<!-- Google Tag Manager -->
<amp-analytics config="https://www.googletagmanager.com/amp.json?id=GTM-M9CH5S3&gtm.url=SOURCE_URL" data-credentials="include"></amp-analytics>

    <!-- 1. Define the state -->
<amp-state id="navMenuExpanded">
        <script type="application/json">false</script>
</amp-state>

<!-- 2. Mutate the state -->
<button
        class="menu-toggle"
        on="tap:AMP.setState( { navMenuExpanded: ! navMenuExpanded } )"
        [class]="'menu-toggle' + ( navMenuExpanded ? ' toggled-on' : '' )"
        aria-expanded="false"
        [aria-expanded]="navMenuExpanded ? 'true' : 'false'"
>
        <div role="button" on="tap:sidebar.toggle" tabindex="0" class="hamburger"><span style="color:#fff;">☰</span></div>
</button>

<!-- 3. React to state changes -->
<amp-sidebar id="sidebar"
  class="sample-sidebar"
  layout="nodisplay"
  side="right">
<nav
        class="site-header-menu"
        [class]="'site-header-menu' + ( navMenuExpanded ? ' toggled-on' : '' )"
        aria-expanded="false"
        [aria-expanded]="navMenuExpanded ? 'true' : 'false'"
>
        <?php wp_nav_menu( /* ... */ ); ?>
</nav>
<button on="tap:sidebar.close" class="cerrar-sidebar">Cerrar</button>
</amp-sidebar>