<?php
/**
 * Single view template.
 *
 * @package AMP
 */

/**
 * Context.
 *
 * @var AMP_Post_Template $this
 */

$this->load_parts( array( 'html-start' ) );
?>

<?php $this->load_parts( array( 'header' ) ); ?>

<article class="amp-wp-article">
	<header class="amp-wp-article-header">
		<h1 class="amp-wp-title"><?php echo esc_html( $this->get( 'post_title' ) ); ?></h1>
		<?php $this->load_parts( apply_filters( 'amp_post_article_header_meta', array( 'meta-author', 'meta-time' ) ) ); ?>
	</header>

	<?php $this->load_parts( array( 'featured-image' ) ); ?>

	<div class="amp-wp-article-content">
		<?php echo $this->get( 'post_amp_content' ); // WPCS: XSS ok. Handled in AMP_Content::transform(). ?>
	</div>

	<footer class="amp-wp-article-footer">
		<a href="https://www.academiadeltransportista.com/" class="boton-inicio-amp">Ir a Academia del Transportista</a>
	</footer>
</article>

<?php $this->load_parts( array( 'footer' ) ); ?>

<?php
$this->load_parts( array( 'html-end' ) );
