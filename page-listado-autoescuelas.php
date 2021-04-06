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
		<div class="content_wrapper clearfix">
	
			<!-- .sections_group -->
			<div class="sections_group">
			
				<div class="entry-content" itemprop="mainContentOfPage">
					
					<div class="section section-page-footer">
						<div class="section_wrapper clearfix">
						
							<div class="column one page-pager"><?php
                				if(current_user_can('administrator'))
								{
									$autoescuelas=get_posts(array(
										'post_type' => 'autoescuela',
										'orderby' => 'name',
										'order' => 'ASC',
										'numberposts' => -1,
										'meta_query' => array(
											array(
											 'key' => '_thumbnail_id',
											 'compare' => 'EXISTS'
											),
										)
									));
								}
								if($autoescuelas)
								{ ?>
									<table>
                                    	<tr>
                                        	<th>Nombre</th>
                                            <th>Dirección</th>
                                            <th>Provincia</th>
                                            <th>Municipio</th>
                                            <th>ID</th>
                                            <th>Enlace</th>
                                            <th>Enlace edición</th>
                                        </tr><?php
										foreach($autoescuelas as $autoescuela)
										{ ?>
                                        	<tr>
                                                <td><?php echo $autoescuela->post_title; ?></td>
                                                <td><?php $mapa=get_field('mapa',$autoescuela); echo $mapa['address']; ?></td>
                                                <td><?php the_field('provincia_texto',$autoescuela); ?></td>
                                                <td><?php the_field('municipio_texto',$autoescuela); ?></td>
                                                <td><?php echo $autoescuela->ID; ?></td>
                                                <td><a href="<?php echo get_permalink($autoescuela->ID); ?>" target="_blank">Ver</a></td>
                                                <td><a href="https://www.academiadeltransportista.com/wp-admin/post.php?post=<?php echo $autoescuela->ID; ?>&action=edit" target="_blank">Editar</a></td>
                                            </tr><?php											
										} ?>
									</table><?php
								} ?>
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