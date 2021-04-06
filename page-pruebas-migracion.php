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
				
					<?php 
						/*$autoescuelas=get_posts(array(
							'post_type' => 'autoescuela',
							'post_status' => 'any',
							'posts_per_page' => -1
						)); ?>
                        <ul><?php
							$i=1;
							foreach($autoescuelas as $autoescuela)
							{
								if(!metadata_exists('post',$autoescuela->ID,'id_post_original'))
								{ ?>
									<li><?php echo $i; ?> - <a href="<?php echo get_permalink($autoescuela->ID); ?>"><?php echo $autoescuela->post_title; ?></a> - <?php echo $autoescuela->ID.' - '.get_post_meta($autoescuela->ID,'id_post_original')[0]; ?></li><?php
									$i++;
								}
							} ?>
                        </ul><?php */
						
						
						/*$autoescuelas=get_posts(array(
							'post_type' => 'autoescuela',
							'post_status' => 'any',
							'posts_per_page' => -1
						));
						foreach($autoescuelas as $autoescuela)
						{
							echo get_post_meta($autoescuela->ID,'id_post_original')[0].',';
						}*/
						
						/*$autoescuelas=get_posts(array(
							'post_type' => 'autoescuela',
							'post_status' => 'publish',
							'posts_per_page' => -1
						));
						foreach($autoescuelas as $autoescuela)
						{*/
							/*$la_provincia=get_field('provincia',$autoescuela->ID);
							$la_provincia=$la_provincia['value'];
							$el_municipio=get_field('municipios_'.$la_provincia,$autoescuela->ID);
							$el_municipio=$el_municipio['value'];*/
							
							/*$level=get_microsite_level($autoescuela->ID);
							if($level != '')
							{
								echo $autoescuela->ID.' => "'.$level.'",';
							}*/
							
							/*$img=get_the_post_thumbnail_url($autoescuela->ID,'full');
							if($img != '')
							{
								echo $autoescuela->ID.' => "'.$img.'",';
							}
						}*/
						
						if(false)/*current_user_can('administrator'))*/
						{
							$autoescuelas=get_posts(array(
								'post_type' => 'autoescuela',
								'orderby' => 'name',
								'order' => 'ASC',
								'numberposts' => -1,
								'posts_per_page' => 2500,
								'paged' => 1
								/*'meta_query' => array(
									array(
									 'key' => '_thumbnail_id',
									 'compare' => 'EXISTS'
									),
								)*/
							));/*print_r($autoescuelas);die;*/
							$encontrado_dix=false;
							foreach($autoescuelas as $autoescuela)
							{
								if($encontrado_dix)
								{ /*print_r($autoescuela);die;*/
									$valoraciones=get_field('votos',$autoescuela);
									if($valoraciones)
									{/*print_r($autoescuela);die;*/
										$datos_post=array();
										$datos_post['id_autoescuela']=$autoescuela->ID;
										$i=1;
										foreach($valoraciones as $valoracion)
										{
											$datos_post['id_valoracion']=$i;
											$datos_post['usuario']=$valoracion['usuario']['user_email'];
											$datos_post['puntuacion']=$valoracion['puntuacion'];
											$datos_post['comentario']=$valoracion['comentario'];
											$fecha_trozos=explode('/',$valoracion['fecha']);
											$datos_post['fecha']=$fecha_trozos[2].$fecha_trozos[1].$fecha_trozos[0];
											$response = wp_remote_post(	'https://ecodriver.at/wp-json/eco_rest_api/sincronizar_valoraciones/', array(
												'method' => 'POST',
												'headers' => array('Content-type:application/x-www-form-urlencoded'),
												'body' => $datos_post
											));
											$i++;
										}
									}
								}
								if($autoescuela->ID==1069)
								{
									$encontrado_dix=true;
								}
							}
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