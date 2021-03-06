<?php
/**
 * Style template.
 *
 * @package AMP
 */

/**
 * Context.
 *
 * @var AMP_Post_Template $this
 */

$content_max_width       = absint( $this->get( 'content_max_width' ) );
$theme_color             = $this->get_customizer_setting( 'theme_color' );
$text_color              = $this->get_customizer_setting( 'text_color' );
$muted_text_color        = $this->get_customizer_setting( 'muted_text_color' );
$border_color            = $this->get_customizer_setting( 'border_color' );
$link_color              = $this->get_customizer_setting( 'link_color' );
$header_background_color = $this->get_customizer_setting( 'header_background_color' );
$header_color            = $this->get_customizer_setting( 'header_color' );
?>
/* Generic WP styling */

.alignright {
	float: right;
}

:focus {
outline: 0;
}

figure.amp-wp-article-featured-image, .buscador-amp {
    display: none;
}

p.margen-ctapost-amp {
    margin: 25px 0;
    cursor: pointer;
}

body .amp-wp-article-content amp-img.alignright {
    margin: 0;
    margin-bottom: 15px;
}

.alignleft {
	float: left;
}

.aligncenter {
	display: block;
	margin-left: auto;
	margin-right: auto;
}

.amp-wp-enforced-sizes {
	/** Our sizes fallback is 100vw, and we have a padding on the container; the max-width here prevents the element from overflowing. **/
	max-width: 100%;
	margin: 0 auto;
}

.amp-wp-unknown-size img {
	/** Worst case scenario when we can't figure out dimensions for an image. **/
	/** Force the image into a box of fixed dimensions and use object-fit to scale. **/
	object-fit: contain;
}

.mas-info-curso-amp {
    display: none;
}

/* Template Styles */

.amp-wp-content,
.amp-wp-title-bar div {
	<?php if ( $content_max_width > 0 ) : ?>
	margin: 0 auto;
	max-width: <?php echo sprintf( '%dpx', $content_max_width ); ?>;
	<?php endif; ?>
}

html {
	background: <?php echo sanitize_hex_color( $header_background_color ); ?>;
}

body {
	background: <?php echo sanitize_hex_color( $theme_color ); ?>;
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	font-family: 'Merriweather', 'Times New Roman', Times, Serif;
	font-weight: 300;
	line-height: 1.75em;
}

p,
ol,
ul,
figure {
	margin: 0 0 1em;
	padding: 0;
}

a,
a:visited {
	color: <?php echo sanitize_hex_color( $link_color ); ?>;
}

a:hover,
a:active,
a:focus {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
}

/* Quotes */

blockquote {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	background: rgba(127,127,127,.125);
	border-left: 2px solid <?php echo sanitize_hex_color( $link_color ); ?>;
	margin: 8px 0 24px 0;
	padding: 16px;
}

blockquote p:last-child {
	margin-bottom: 0;
}

/* UI Fonts */

.amp-wp-meta,
.amp-wp-header div,
.menu-menu_principal-container,
.amp-wp-title,
.wp-caption-text,
.amp-wp-tax-category,
.amp-wp-tax-tag,
.amp-wp-comments-link,
.amp-wp-footer p,
.back-to-top {
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen-Sans", "Ubuntu", "Cantarell", "Helvetica Neue", sans-serif;
}

/* Header */

.amp-wp-header {
	background-color: <?php echo sanitize_hex_color( $header_background_color ); ?>;
}

.amp-wp-header div,
.menu-menu_principal-container {
	color: <?php echo sanitize_hex_color( $header_color ); ?>;
    background: #e85e02;
    font-size: 1em;
    font-weight: 400;
    margin: 0 auto;
    max-width: calc(840px - 32px);
    padding: 15px 15px 5px 15px;
    position: relative;
}

.amp-wp-header a,
#sidebar a {
	color: <?php echo sanitize_hex_color( $header_color ); ?>;
	text-decoration: none;
}

img.icon-clic-loguearte-at {
    display: none;
}

/* Site Icon */

.amp-wp-header .amp-wp-site-icon {
	/** site icon is 32px **/
	background-color: <?php echo sanitize_hex_color( $header_color ); ?>;
	border: 1px solid <?php echo sanitize_hex_color( $header_color ); ?>;
	border-radius: 50%;
	position: absolute;
	right: 18px;
	top: 10px;
}

/* Article */

.amp-wp-article {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	font-weight: 400;
	margin: 1.5em auto;
	max-width: 840px;
	overflow-wrap: break-word;
	word-wrap: break-word;
}

.caja-accordion-amp .titulo-form-ciudad {
    font-family: "Exo2 SemiBold";
    font-size: 20px;
    line-height: 22px;
    color: #333;
    margin-top: 0px;
    text-align: center;
    margin-bottom: 25px;
}

.caja-accordion-amp {
    border: 2px solid #353535;
    padding: 30px 20px 0 20px;
    margin: 30px 0;
}

.caja-accordion-amp .submit-ciudad {
    margin-bottom: -10px;
}

.caja-accordion-amp span.wpcf7-form-control.wpcf7-acceptance {
    display: flex;
    border: 0px solid #ccc;
    padding: 10px 0px;
}

.caja-accordion-amp span.wpcf7-form-control-wrap.acceptance-188 {
    display: inline-block;
    width: auto;
}

a.button.cta-articulo {
    display: none;
}

a.button.cta-articulo-amp, a:focus.button.cta-articulo-amp, a:hover.button.cta-articulo-amp {
    background: #EFEFEF;
    color: #333;
    text-align: center;
    text-decoration: none;
    padding: 20px 30px;
    -webkit-border-radius: 5px;
    display: block;
    -moz-border-radius: 5px;
    border-radius: 5px;
}

p.margen-cta-amp {
    margin: 40px 0 60px 0;
}

span.wpcf7-form-control-wrap .wpcf7-date, span.wpcf7-form-control-wrap .wpcf7-quiz, span.wpcf7-form-control-wrap .wpcf7-number, span.wpcf7-form-control-wrap .wpcf7-select, span.wpcf7-form-control-wrap .wpcf7-text, span.wpcf7-form-control-wrap .wpcf7-textarea {
    font-family: 'Gordita Regular';
    padding: 0.5em 0.5em 0.5em 1em;
    border: 1px solid gray;
    border-radius: 3px;
    margin-bottom: 0.5em;
    width: 90%;
}

.politicas-ciudad-cursos {
    font-size: 10px;
    line-height: 12px;
    font-family: "Gordita Regular";
    color: #464e5d;
}

.caja-accordion-amp {
    display: block;
    margin-bottom: 25px;
    margin-top: 25px;
}

.caja-accordion-amp .cta-popup {
    background-color: #e85e02;
    color: #fff;
    box-shadow: none;
    padding: 10px 30px;
    border-radius: 5px;
    text-align: center;
    font-size: 18px;
    margin: 0 auto;
    display: block;
}

.caja-accordion-amp .cta-popup:hover {
    color: #fff;
}

.caja-form-ciudad {
    text-align: center;
    margin-bottom: 15px;
}

.MinText {
    display: none;
}

input[type="checkbox"] {
    top: 2px;
    position: relative;
}

.caja-form-ciudad .boton-ciudad {
    background: #333;
    border-radius: 0px;
    border: none;
    cursor: pointer;
    width: 100%;
    padding: 15px 0;
    font-size: 16px;
    -webkit-transition: .2s background linear;
    -moz-transition: .2s background linear;
    transition: .2s background linear;
    -webkit-appearance: none;
}

input[type="submit"] {
    color: #fff;
}

.caja-form-ciudad .boton-ciudad:hover {
    background: #e85e02;
}

.amp-wp-article #mas-info-curso {
    display: none;
}

.amp-mode-touch #toc_container {
    border: 1px solid #aaa;
    padding: 20px 20px 15px 20px;
    margin-top: 30px;
    margin-bottom: 30px;
}

.amp-wp-article a {
    color: #e85e02;
    text-decoration: none;
}

.amp-wp-article a:hover {
    color: #e85e02;
    text-decoration: underline;
}

.amp-wp-article ul.toc_list, .amp-wp-article ul.toc_list li {
    list-style: none;
    margin-left: 0px;
}

/* Article Header */

.amp-wp-article-header {
	align-items: center;
	align-content: stretch;
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	margin: 1.5em 16px 0;
}

.logo-amp {
    width: 200px;
}

.amp-wp-title {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	display: block;
	flex: 1 0 100%;
	font-weight: 900;
	margin: 0 0 .625em;
	width: 100%;
}

/* Article Meta */

.amp-wp-meta {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	display: none;
	flex: 2 1 50%;
	font-size: .875em;
	line-height: 1.5em;
	margin: 0 0 1.5em;
	padding: 0;
}

.amp-wp-article-header .amp-wp-meta:last-of-type {
	text-align: right;
}

.amp-wp-article-header .amp-wp-meta:first-of-type {
	text-align: left;
}

.amp-wp-byline amp-img,
.amp-wp-byline .amp-wp-author {
	display: inline-block;
	vertical-align: middle;
}

.amp-wp-byline amp-img {
	border: 1px solid <?php echo sanitize_hex_color( $link_color ); ?>;
	border-radius: 50%;
	position: relative;
	margin-right: 6px;
}

.amp-wp-posted-on {
	text-align: right;
}

/* Featured image */

.amp-wp-article-featured-image {
	margin: 0 0 1em;
}
.amp-wp-article-featured-image amp-img {
	margin: 0 auto;
}
.amp-wp-article-featured-image.wp-caption .wp-caption-text {
	margin: 0 18px;
}

/* Article Content */

.amp-wp-article-content {
	margin: 0 16px;
}

.amp-wp-article-content ul,
.amp-wp-article-content ol {
	margin-left: 1em;
}

.amp-wp-article-content .wp-caption {
	max-width: 100%;
}

.amp-wp-article-content amp-img {
	margin: 0 auto;
}

.amp-wp-article-content amp-img.alignright {
	margin: 0 0 1em 16px;
}

.amp-wp-article-content amp-img.alignleft {
	margin: 0 16px 1em 0;
}

/* Captions */

.wp-caption {
	padding: 0;
}

.wp-caption.alignleft {
	margin-right: 16px;
}

.wp-caption.alignright {
	margin-left: 16px;
}

.wp-caption .wp-caption-text {
	border-bottom: 1px solid <?php echo sanitize_hex_color( $border_color ); ?>;
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .875em;
	line-height: 1.5em;
	margin: 0;
	padding: .66em 10px .75em;
}

/* AMP Media */

amp-carousel {
	background: <?php echo sanitize_hex_color( $border_color ); ?>;
	margin: 0 -16px 1.5em;
}
amp-iframe,
amp-youtube,
amp-instagram,
amp-vine {
	background: <?php echo sanitize_hex_color( $border_color ); ?>;
	margin: 0 -16px 1.5em;
}

.amp-wp-article-content amp-carousel amp-img {
	border: none;
}

amp-carousel > amp-img > img {
	object-fit: contain;
}

.amp-wp-iframe-placeholder {
	background: <?php echo sanitize_hex_color( $border_color ); ?> url( <?php echo esc_url( $this->get( 'placeholder_image_url' ) ); ?> ) no-repeat center 40%;
	background-size: 48px 48px;
	min-height: 48px;
}

/* Article Footer Meta */

.amp-wp-article-footer .amp-wp-meta {
	display: block;
}

.amp-wp-tax-category,
.amp-wp-tax-tag {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .875em;
	line-height: 1.5em;
	margin: 1.5em 16px;
}

.amp-wp-tax-category {
	display: none;
}

.amp-wp-comments-link {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .875em;
	line-height: 1.5em;
	text-align: center;
	margin: 2.25em 0 1.5em;
}

.amp-wp-comments-link a {
	border-style: solid;
	border-color: <?php echo sanitize_hex_color( $border_color ); ?>;
	border-width: 1px 1px 2px;
	border-radius: 4px;
	background-color: transparent;
	color: <?php echo sanitize_hex_color( $link_color ); ?>;
	cursor: pointer;
	display: block;
	font-size: 14px;
	font-weight: 600;
	line-height: 18px;
	margin: 0 auto;
	max-width: 200px;
	padding: 11px 16px;
	text-decoration: none;
	width: 50%;
	-webkit-transition: background-color 0.2s ease;
			transition: background-color 0.2s ease;
}

/* AMP Footer */

.amp-wp-footer {
	border-top: 1px solid <?php echo sanitize_hex_color( $border_color ); ?>;
	margin: calc(1.5em - 1px) 0 0;
}

.amp-wp-footer div {
	margin: 0 auto;
	max-width: calc(840px - 32px);
	padding: 1.25em 16px 1.25em;
	position: relative;
}

.amp-wp-footer h2 {
	font-size: 1em;
	line-height: 1.375em;
	margin: 0 0 1.5em;
}

.amp-wp-footer p {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: 0;
	line-height: 0;
	margin: 0 85px 40px 0;
}

.amp-wp-footer a {
	text-decoration: none;
    display: none;
}

a.back-to-top {
    display: block;
    color: #e85e02;
    top: 1.5rem;
    margin: 0 auto;
    text-align: center;
    width: 88%;
}

.back-to-top {
	bottom: 1.275em;
	font-size: .8em;
	font-weight: 600;
	line-height: 2em;
	position: absolute;
	right: 16px;
}

.amp-wp-article-content #toc_container {
    border: 1px solid #353535;
    padding: 20px 20px 5px 20px;
    margin-top: 28px;
    margin-bottom: 30px;
}

footer.amp-wp-article-footer {
    text-align: center;
    margin-top: 40px;
    margin-bottom: 40px;
}

a.boton-inicio-amp {
    color: #fff;
    background: #E85E02;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-transition: all 0.25s ease-in-out;
    -moz-transition: all 0.25s ease-in-out;
    -ms-transition: all 0.25s ease-in-out;
    -o-transition: all 0.25s ease-in-out;
    transition: all 0.25s ease-in-out;
    padding: 10px 20px;
}

a:hover.boton-inicio-amp {
	color: #fff;
    background: #333;
    text-decoration: none;
}

.titulo-footer-amp {
    color: #e85e02;
    font-weight: 600;
    width: 100%;
    text-align: center;
}

.amp-wp-header img.icon-clic-loguearte-at {
    display: none;
}

button.menu-toggle {
    position: absolute;
    border: 0px solid #fff;
    color: #fff;
    background: #e85e02;
    font-size: 24px;
    margin-top: 15px;
    z-index: 1;
    margin-right: 15px;
    right: 0;
}

.hamburger {
    padding-top: 0px;
    color: #fff;
    border: 0px;
}

.hamburger:focus, .hamburger:hover, .hamburger:active {
    border: 0px;
}

amp-sidebar {
    max-width: 60vw;
    width: 60vw;
}

.menu-menu_principal-container {
    padding-bottom: 20px;
}

amp-sidebar ul {
    list-style: none;
    margin-left: 15px;
    margin-bottom: 0;
}

amp-sidebar li {
    list-style: none;
}

button.cerrar-sidebar {
    color: #fff;
    background: #e85e02;
    border: 0px;
    padding: 5px 15px;
    margin: 15px;
    float: right;
}

.amp-wp-article .video-container {
    display: none;
}

.amp-wp-article blockquote {
    color: #353535;
    background: rgba(127,127,127,.125);
    border-left: 2px solid #e85e02;
    margin: 8px 0 24px 0;
    padding: 16px;
}

.amp-wp-article .cuadro-articulo-blog {
    border: 2px solid #e85e02;
    padding: 25px 25px 0px 25px;
	margin-top: 35px;
    margin-bottom: 35px;
}
#campo_id_amp,
.post_id_custom{
	display:none;
}