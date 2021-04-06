<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */

get_header();
?>

<!-- #Content -->
<div id="Content" class="pc-offer">
	<div class="content_wrapper clearfix">
    	<div class="offer_header">
        	<div class="section_wrapper mcb-section-inner clearfix">
                <div class="text column mcb-column three-fifth column_column">
                <?php $term_actual = wp_get_post_terms(get_the_ID(),'tipo-oferta'); ?>
                    <div class="pre-title"><a class="migas-club" href="https://www.academiadeltransportista.com/club-at/">Club AT</a> - <a href="<?php echo get_term_link($term_actual[0]->term_id); ?>" class="migas-club"><?php echo $term_actual[0]->name; ?></a> - <span class="migas-club-active">Oferta de empleo</span></div>
                    <div class="title"><?php the_title(); ?></div><?php
					$provincia=get_field('provincia');
					if($provincia['label'] != 'Ruta internacional')
					{ ?>
                    	<div class="post-title"><?php echo $provincia['label']; ?> - España</div><?php
					}
					else
					{ ?>
                    	<div class="post-title"><?php _e('Ruta internacional'); ?></div><?php						
					} ?>
                </div>
                <div class="text column mcb-column two-fifth column_column"><?php
					$logo=get_field('logotipo_de_la_empresa');
					if($logo)
					{ ?>
                    	<figure><img src="<?php echo $logo['sizes']['medium']; ?>" /></figure><?php
					} ?>
                </div>
            </div>
        </div>
        <div class="section_wrapper mcb-section-inner clearfix contenido-oferta">
        	<div class="description column mcb-column three-fifth column_column">
            <p class="titulo-descripcion-oferta">Descripción de la oferta</p>
            	<div class="contract_type"><span><?php _e('Tipo de contrato:'); ?></span><?php echo ' '; the_field('tipo_de_contrato'); ?></div>
                <div class="salary_type"><span><?php _e('Salario:'); ?></span><?php echo ' '; the_field('remuneracion'); ?></div>
            	<div class="description_title"><?php _e('Descripción de la oferta'); ?></div>
                <div class="description_content"><?php the_content(); ?></div>
            </div>
            <div class="company_details column mcb-column two-fifth column_column">
            	<div class="full_company_name"><?php the_field('nombre_de_la_empresa'); ?></div>
                <div class="company_info_container">
                	<strong class="titulo-info-empresa"><?php _e('Información de la empresa'); ?></strong>
                    <div class="company_info"><?php the_field('descripcion_de_la_empresa'); ?></div>
                </div>
                <div class="cta button"><?php the_field('forma_de_contacto'); ?></div>
            </div>
        </div>
	</div>
</div>

<div id="Content-mobile-offer">
	<div class="content_wrapper clearfix">
    	<div class="offer_header">
        	<div class="section_wrapper mcb-section-inner clearfix">
                <div class="text column mcb-column three-fifth column_column">
                    <?php $term_actual = wp_get_post_terms(get_the_ID(),'tipo-oferta'); ?>
                    <div class="pre-title"><a class="migas-club" href="https://www.academiadeltransportista.com/club-at/">Club AT</a> - <a href="<?php echo get_term_link($term_actual[0]->term_id); ?>" class="migas-club"><?php echo $term_actual[0]->name; ?></a> - <span class="migas-club-active">Oferta de empleo</span></div>
                    <div class="title"><?php the_title(); ?></div><?php
					$provincia=get_field('provincia');
					if($provincia['label'] != 'Ruta internacional')
					{ ?>
                    	<div class="post-title"><?php echo $provincia['label']; ?> - España</div><?php
					}
					else
					{ ?>
                    	<div class="post-title"><?php _e('Ruta internacional'); ?></div><?php						
					} ?>
                </div>
            </div>
        </div>
        <div class="section_wrapper mcb-section-inner clearfix contenido-oferta">
          <div class="company_details column mcb-column two-fifth column_column">
            <div class="text column mcb-column two-fifth column_column"><?php
					$logo=get_field('logotipo_de_la_empresa');
					if($logo)
					{ ?>
                    	<figure><img src="<?php echo $logo['sizes']['medium']; ?>" /></figure><?php
					} ?>
                </div>
            	<div class="full_company_name"><?php the_field('nombre_de_la_empresa'); ?></div>
                <div class="company_info_container">
                	<strong class="titulo-info-empresa"><?php _e('Información de la empresa'); ?></strong>
                    <div class="company_info"><?php the_field('descripcion_de_la_empresa'); ?></div>
                </div>
                <div class="cta button"><?php the_field('forma_de_contacto'); ?></div>
            </div>
        	<div class="description column mcb-column three-fifth column_column">
            <p class="titulo-descripcion-oferta">Descripción de la oferta</p>
            	<div class="contract_type"><span><?php _e('Tipo de contrato:'); ?></span><?php echo ' '; the_field('tipo_de_contrato'); ?></div>
                <div class="salary_type"><span><?php _e('Salario:'); ?></span><?php echo ' '; the_field('remuneracion'); ?></div>
            	<div class="description_title"><?php _e('Descripción de la oferta'); ?></div>
                <div class="description_content"><?php the_content(); ?></div>
            </div>
        </div>
	</div>
</div><?php
get_footer();
// Omit Closing PHP Tags