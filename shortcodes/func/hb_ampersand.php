<?php

if( !function_exists('hb_ampersand_shortcode') ) { 
 
	function hb_ampersand_shortcode($atts, $content = null) {
				

		return '<span class="hb-ampersand">&amp;</span>';
	}

	add_shortcode('hb_ampersand', 'hb_ampersand_shortcode');
}