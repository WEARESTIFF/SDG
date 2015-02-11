<?php

if( !function_exists('hb_hr_shortcode') ) { 
 
	function hb_hr_shortcode($atts, $content = null) {
				
		extract(shortcode_atts(array(
			 
			 'style'    => '',
			 'class'	=> ''
			 
		), $atts));

		$classes = array();

		$classes[] = 'hb-hr';

		if ( $style )

			$classes[] = 'hb-hr-'. $style;

		if ( $class )

			$classes[] = $class;

		$classes = implode(' ', $classes);

		return '<hr class="'.esc_attr($classes).'"/>';
	}

	add_shortcode('hb_hr', 'hb_hr_shortcode');
}