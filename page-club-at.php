<?php
/**
 * The template for displaying all pages.
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */

get_header();
	?>
		
	<!-- #Content -->
	<div id="Content">
    	<div class="video_container full_width" video_cod="MoXWftD7rRE">
            <img alt="Bienvenido al club AT - Los elegidos para mover el mundo" src="https://www.academiadeltransportista.com/wp-content/uploads/2018/12/slide-club-at-ok.jpg" />
            <div class="the_video" style="display:none;"></div>
        </div>
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