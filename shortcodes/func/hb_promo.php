<?php
/**
 * Team Member
 *
 */
if (!function_exists('hb_promo_shortcode')) {
    function hb_promo_shortcode($atts, $content = null) {
        
        extract ( shortcode_atts( array(
              'link'    => '',
              'label'   => '',             
              'class'   => '',
        ), $atts ) );

        $output  = '<div class="hb-promo ' . $class . '">';
          $output .= '<div class="hb-promo-content clearfix">';
            $output .= apply_filters( 'the_content', $content );
            if (!empty($link) && !empty($label))
              $output .= '<a class="hb-promo-link btn btn-primary" href="'.esc_attr($link).'">'.esc_attr($label).'</a>';
          $output .= '</div>';
          // TODO: MAKE THIS DYNAMIC
          $output .= '<span class="you_and"><span class="face">f</span>YOU AND 3451 OTHER PEOPLE LIKE THIS</span>';
        $output .= '</div>';

        return $output;
    }
    add_shortcode('hb_promo', 'hb_promo_shortcode');
}