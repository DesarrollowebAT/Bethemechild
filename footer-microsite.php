<?php
/**
 * The template for displaying the footer.
 *
 * @package Betheme
 * @author Muffin group
 * @link https://muffingroup.com
 */
?>
<!-- wp_footer() -->
<?php wp_footer(); ?>
<script>
	/* Rellenamos campo URL formularios */
	if(jQuery('input[name="current-url"]').length > 0)
	{
		jQuery('input[name="current-url"]').each(function(index, element) {
			jQuery(element).val(window.location.href);
			jQuery(element).attr('value',window.location.href); 
		});
	}
</script>
<script>
document.addEventListener( 'wpcf7mailsent', function( event ) {
    if ( '9825' == event.detail.contactFormId ) {console.log('test');
		location = 'https://www.academiadeltransportista.com/gracias-contacto-microsite/';
    } else {

    }
}, false );
</script>
</body>
</html>