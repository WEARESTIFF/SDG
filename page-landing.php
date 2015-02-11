<?php
/**
 * Template Name: Landing
 *
 * @package WordPress
 * @subpackage sTheme
 * @since sTheme 1.0
 */


get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php

		// Start the Loop.
		while ( have_posts() ) : the_post();

			$landing_layers = get_post_meta(get_the_ID(), 'landing_layers', true);

			if ( $landing_layers 
				&& is_array($landing_layers) 
				&& ! empty($landing_layers) 
				&& $landing_layers != array('') ):
				
				?>
				<style type="text/css">
					<?php foreach ($landing_layers as $index => $layer): ?>
						
						<?php if ( 'off' == $layer['publish'] ) continue; ?>

						#hb-layer-<?php echo $index; ?> { <?php 

						if ( $layer['bg'] && is_array($layer['bg']) && ( $layer['bg']['background-color']||$layer['bg']['background-image'] ) )

							foreach ( $layer['bg'] as $module => $style ) 

								if ( $style )

									echo ( $module == 'background-image' ) ? "{$module}:url({$style}); "
									: "{$module}:{$style}; ";

						echo "padding-top: ", implode ( '', $layer['padding_top']), ";";
						echo "padding-bottom: ", implode ( '', $layer['padding_bottom']), ";";

						?> }

						<?php if ( 'on' == $layer['overlay'] ): 

							$overlay = array();

							$overlay['opacity'] = $layer['overlay_opacity'];

							if ( $layer['color_overlay'] )

								$overlay['background-color'] = $layer['color_overlay'];

							if ( $layer['pattern_overlay'] && $layer['pattern_overlay'] != 'gradient' )

								$overlay['background-image'] = HB_THEME_URL . "/img/{$layer['pattern_overlay']}.png";

							if ( $layer['overlay_fixed'] == 'on')

								$overlay['background-attachment'] = 'fixed';

							if ( $layer['pattern_overlay'] 
								&& $layer['pattern_overlay'] == 'gradient' 
								&& $layer['gradient_overlay_start'] 
								&& $layer['gradient_overlay_end'] ){

								if ( isset($overlay['background-color'])) unset($overlay['background-color']);
								if ( isset($overlay['background-attachment'])) unset($overlay['background-attachment']);
								
								$overlay['gradient'] = array(
									'start' => $layer['gradient_overlay_start'],
									'end'	=> $layer['gradient_overlay_end']
								);
							}
						?>
						#hb-layer-<?php echo $index; ?> .layer-overlay {

							<?php foreach ( $overlay as $module => $style ):

									if ( $style ) 

										if ( 'gradient' != $module )

											if ( 'background-image' == $module )
												echo "background-image: url({$style}); ";
											else
												echo "{$module}: {$style}; ";

										else

											echo 	"background: {$style['start']}; /* Old browsers */",
													"background: -moz-linear-gradient(-45deg,  {$style['start']} 0%, {$style['end']} 100%); /* FF3.6+ */",
													"background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,{$style['start']}), color-stop(100%,{$style['end']})); /* Chrome,Safari4+ */",
													"background: -webkit-linear-gradient(-45deg,  {$style['start']} 0%,{$style['end']} 100%); /* Chrome10+,Safari5.1+ */",
													"background: -o-linear-gradient(-45deg,  {$style['start']} 0%,{$style['end']} 100%); /* Opera 11.10+ */",
													"background: -ms-linear-gradient(-45deg,  {$style['start']} 0%,{$style['end']} 100%); /* IE10+ */",
													"background: linear-gradient(135deg,  {$style['start']} 0%,{$style['end']} 100%); /* W3C */",
													"filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$style['start']}', endColorstr='{$style['end']}',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */";

							endforeach; ?>
						}
						<?php endif; ?>

					<?php endforeach; ?>
				</style>

				<?php
				foreach ($landing_layers as $index => $layer):

					$layer['layer_id'] = "hb-layer-{$index}";

					echo apply_filters( 'hb_landing_template_content', $layer );

				endforeach;

			endif;

		endwhile;

		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php
get_footer();