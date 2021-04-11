<?php // GDRTS Template: Default // ?>

<div class="<?php gdrts_loop()->render()->classes(); ?>">
    <div class="gdrts-inner-wrapper"><?php 
		do_action('gdrts-template-rating-block-before');
		if(apply_filters('gdrts-template-stars-rating-default-show-rating-text', true))
		{ ?>
        	<div class="gdrts-rating-text"><?php
                do_action('gdrts-template-stars-rating-default-before-rating-text');
                if (gdrts_loop()->render()->has_votes())
				{
                    /*gdrts_loop()->render()->rating();*/
                }
				else
				{
                    $no_votes = __('<p class="sin_valoraciones">Esta autoescuela aún no ha sido valorada</p>');

                    echo apply_filters('gdrts-template-stars-rating-default-no-votes-message', $no_votes);
                }
                do_action('gdrts-template-stars-rating-default-after-rating-text'); ?>
            </div><?php 
		}
		do_action('gdrts-template-stars-rating-default-before-rating-stars'); ?>
		
		<div class="val">
        	<p class="titulo">Valoración:</p> <?php gdrts_loop()->render()->stars(); ?>
        </div><?php

        do_action('gdrts-template-stars-rating-default-after-rating-stars');
		
		if(apply_filters('gdrts-template-stars-rating-default-show-user-rating', true))
		{
            if (gdrts_loop()->user()->has_voted())
			{ ?>
            	<div class="gdrts-rating-user"><?php

                    do_action('gdrts-template-stars-rating-default-before-user-rating');

                    gdrts_loop()->render()->vote_from_user();

                    do_action('gdrts-template-stars-rating-default-after-user-rating'); ?>
                </div><?php
            }
        }
		
		if(gdrts_loop()->is_save())
		{
			if(apply_filters('gdrts-template-stars-rating-default-show-thank-you', true))
			{ ?>
            	<div class="gdrts-rating-thanks"><?php

                    do_action('gdrts-template-stars-rating-default-before-thank-you');

                    $thank_you = __("¡Gracias por votar! Recargando página...", "gd-rating-system");

                    echo apply_filters('gdrts-template-stars-rating-default-thank-you-message', $thank_you);

                    do_action('gdrts-template-stars-rating-default-after-thank-you'); ?>
                </div><?php 
			}
		}
		else
		{
            if(apply_filters('gdrts-template-stars-rating-default-show-please-wait', true))
			{
                do_action('gdrts-template-stars-rating-default-before-please-wait');

                gdrts_loop()->please_wait('Por favor, espera...');

                do_action('gdrts-template-stars-rating-default-before-please-wait');
            }
        }

        gdrts_loop()->json();

        do_action('gdrts-template-rating-block-after');
        do_action('gdrts-template-rating-rich-snippet'); ?>
    </div>
</div>