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
			
				<div class="entry-content" itemprop="mainContentOfPage" style="padding-top:150px;"><?php 
				
				$autoescuelas=get_posts(array(
					'post_type' => 'autoescuela',
					'numberposts' => -1,
					'order' => 'ASC'
				));
				foreach($autoescuelas as $autoescuela)
				{
					$movil=get_field('telefono_movil',$autoescuela);
					$fijo=get_field('telefono_fijo',$autoescuela);
					$email=get_field('e-mail',$autoescuela);
					if(!$movil)
					{
						if($email != '' && strpos($email,'@') !== false)
						{
							echo $autoescuela->post_title.'='.get_permalink($autoescuela).'='.$email.'<br />';
						}
						elseif($fijo != '')
						{
							/*echo $autoescuela->post_title.'='.get_permalink($autoescuela).'='.$fijo.'<br />';*/
						}
					}
				}
				
				die;
					/*$cursos_seleccionados_autoescuela=array('curso-obtencion-camion-c','curso-obtencion-carnet-trailer-c-e','curso-obtencion-carnet-autobus-d','curso-obtencion-carnet-remolque-b-e','curso-obtencion-carnet-coche-b','curso-obtencion-carnet-moto-a');
					$cursos_seleccionados_transporte=array('curso-renovacion-del-cap','curso-obtencion-cap-inicial','curso-obtencion-mercancias-peligrosas','curso-renovacion-adr','curso-obtencion-titulo-de-transportista','curso-consejero-de-seguridad-adr');
					$cursos_seleccionados_mas=array('curso-de-carretillas-elevadoras','curso-grua-camion-pluma','une-12195-sujecion-de-cargas-y-estiba','curso-tacografo-digital','cursos-de-logistica','curso-de-seguridad-vial-laboral');*/
					
					$autoescuelas=get_posts(array(
						'post_type' => 'autoescuela',
						'numberposts' => -1
					));
					foreach($autoescuelas as $autoescuela)
					{
						$cursos_seleccionados_transporte=get_field('cursos_ofrecidos_tipo_transporte',$autoescuela->ID);
						/*$cursos_a_guardar=array();*/
						$cont=0;
						foreach($cursos_seleccionados_transporte as $curso)
						{
							if($curso['value']=='curso-conductor-ambulancia')
							{
								$cont++;
							}
						}
						echo $cont.' - '.$autoescuela->ID.'<br />';
						
						/*if($cursos_a_guardar)
						{
							$cursos_a_guardar[]='curso-conductor-ambulancia';
							update_field('cursos_ofrecidos_tipo_transporte',$cursos_a_guardar,$autoescuela->ID);
						}
						else
						{
							echo 2;
						}*/
					}
					/*foreach($autoescuelas as $autoescuela)
					{
						update_field('cursos_ofrecidos_tipo_autoescuela',$cursos_seleccionados_autoescuela,$autoescuela->ID);
						update_field('cursos_ofrecidos_tipo_transporte',$cursos_seleccionados_transporte,$autoescuela->ID);
						update_field('cursos_ofrecidos_tipo_mas_cursos',$cursos_seleccionados_mas,$autoescuela->ID);
					}*/ ?>
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