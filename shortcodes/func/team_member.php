<?php
/**
 * Team Member
 *
 */
if (!function_exists('fm_member_shortcode')) {
    function fm_member_shortcode($atts) {
        
        extract ( shortcode_atts( array(
              'img'     => '',
              'name'    => '',
              'title'   => '',             
              'class'   => '',
        ), $atts ) );
        $output = '<div class="team-item hb-animate ' . $class . '" data-animation="fadeIn">';
          $output .= '<div class="team-member clearfix">';
            if ( $img ) $output .= '<div class="memeber-avatar"><img src="' . esc_attr($img) . '" alt="' . esc_attr($name) . '" /></div>';
            $output .= '<div class="memeber-name">';
            if ( $name ) $output .= '<h3>' . $name . '</h3>';
            if ( $title ) $output .= '<span>' . $title . '</span>';
            $output .= '</div>';
          $output .= '</div>';
        $output .= '</div>';
        return $output;
    }
    add_shortcode('team_member', 'fm_member_shortcode');
}