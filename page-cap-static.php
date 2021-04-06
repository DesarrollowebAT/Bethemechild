<?php
/**
 * Template name: CAP Static
 */

get_header();

$centro_mas_cercano=get_cursos_por_proximidad(1);
$centro_mas_cercano=$centro_mas_cercano[0];
$centro_mas_cercano=get_permalink($centro_mas_cercano->ID); ?>
<script>
	var link_centro_mas_cercano = <?php echo json_encode($centro_mas_cercano); ?>;
</script>
		
	<!-- #Content -->
	<div id="Content">
    	<?php /*<div class="inner_search_form" style="clear:both;">
        	<h1 class="titulo-filter">Renovación CAP</h1>
            <div class="section_wrapper clearfix"><?php get_template_part('template-parts/search-form'); ?></div>
        </div>*/ ?>
		<div class="content_wrapper clearfix">
	
			<!-- .sections_group -->
			<div class="sections_group">
			
				<div class="entry-content" itemprop="mainContentOfPage">
				
					<?php 
						while ( have_posts() ){
							the_post();							// Post Loop
							mfn_builder_print( get_the_ID() );	// Content Builder & WordPress Editor Content
						}
					?>
					
					<div class="section section-page-footer">
						<div class="section_wrapper clearfix">
						
							<div class="column one page-pager">
								<?php
									// List of pages
									wp_link_pages(array(
										'before'			=> '<div class="pager-single">',
										'after'				=> '</div>',
										'link_before'		=> '<span>',
										'link_after'		=> '</span>',
										'next_or_number'	=> 'number'
									));
								?>
							</div>
							
						</div>
					</div>
					
				</div>
				
				<?php if( mfn_opts_get('page-comments') ): ?>
					<div class="section section-page-comments">
						<div class="section_wrapper clearfix">
						
							<div class="column one comments">
								<?php comments_template( '', true ); ?>
							</div>
							
						</div>
					</div>
				<?php endif; ?>
		
			</div>
			
			<!-- .four-columns - sidebar -->
			<?php get_sidebar(); ?>
	
		</div>
	</div>
    
	
	<?php get_footer();
	
	// Omit Closing PHP Tags