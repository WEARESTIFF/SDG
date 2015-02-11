<?php
/**
 * Initialize the custom Meta Boxes. 
 */
add_action( 'admin_init', 'onyx_meta_boxes' );

function hb_get_metabox_animation( $dir = 'in' ){

  $animations = array(
    'in'  => array( "slideInDown","slideInLeft","slideInRight","slideInUp","bounceIn","bounceInDown","bounceInLeft","bounceInRight","bounceInUp","fadeIn","fadeInDown","fadeInDownBig","fadeInLeft","fadeInLeftBig","fadeInRight","fadeInRightBig","fadeInUp","fadeInUpBig","flipInX","flipInY","lightSpeedIn","rotateIn","rotateInDownLeft","rotateInDownRight","rotateInUpLeft","rotateInUpRight","rollIn","zoomIn","zoomInDown","zoomInLeft","zoomInRight","zoomInUp" ),
    'out' => array( "slideOutDown","slideOutLeft","slideOutRight","slideOutUp","bounceOut","bounceOutDown","bounceOutLeft","bounceOutRight","bounceOutUp","fadeOut","fadeOutDown","fadeOutDownBig","fadeOutLeft","fadeOutLeftBig","fadeOutRight","fadeOutRightBig","fadeOutUp","fadeOutUpBig","flipOutX","flipOutY","lightSpeedOut","rotateOut","rotateOutDownLeft","rotateOutDownRight","rotateOutUpLeft","rotateOutUpRight","rollOut","zoomOut","zoomOutDown","zoomOutLeft","zoomOutRight","zoomOutUp" )
  );

  $x = array();

  foreach ($animations[$dir] as $value)

    $x[] = array(
      'value'       => $value,
      'label'       => $value,
      'src'         => ''
    );

  return $x;
}

/**
 * Theme's Meta Boxes
 *
 * @return    void
 * @since     2.0
 */
function onyx_meta_boxes() {
  
  /**
   * Create a custom meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   */
  $metaboxes  = array();

// question 

  $metaboxes[] = array(
    'id'          => 'question_metabox',
    'title'       => __( 'Answers', HB_DOMAIN_TXT ),
    'desc'        => '',
    'pages'       => array( 'question' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'id'          => 'answers',
        'label'       => __( '', HB_DOMAIN_TXT ),
        'type'        => 'list-item',
        'settings'    => array( 
          array(
            'id'          => 'ID',
            'label'       => __( 'ID', HB_DOMAIN_TXT ),
            'type'        => 'uniq-id',
          ),
          array(
            'id'          => 'value',
            'label'       => __( 'Value', HB_DOMAIN_TXT ),
            'type'        => 'numeric-slider',
            'min_max_step'=> '-2,2,1',
          ),
        )
      ),
    )
  );

// page templates

  $metaboxes[] = array(
    'id'          => 'page_metabox',
    'title'       => __( 'Page Settings', HB_DOMAIN_TXT ),
    'desc'        => '',
    'pages'       => array( 'page' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'id'          => 'color',
        'label'       => __( 'Alt Color', HB_DOMAIN_TXT ),
        'type'        => 'colorpicker',
      ),
    )
  );

  $metaboxes[] = array(
    'id'          => 'landing_metabox',
    'title'       => __( 'Layouts Settings', HB_DOMAIN_TXT ),
    'desc'        => '',
    'pages'       => array( 'page' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => __( 'Layers', HB_DOMAIN_TXT ),
        'id'          => 'landing_layers',
        'type'        => 'list-item',
        'settings'    => array( 
          array(
            'id'          => 'publish',
            'label'       => __( 'Publish', HB_DOMAIN_TXT ),
            'type'        => 'on-off',
            'std'         => 'on'
          ),
          array(
            'id'          => 'type',
            'label'       => __( 'Type', HB_DOMAIN_TXT ),
            'std'         => 'default',
            'type'        => 'select',
            'choices'     => array(
              array(
                'value'       => 'default',
                'label'       => __( 'Default Content', HB_DOMAIN_TXT ),
                'src'         => ''
              ),
              array(
                'value'       => 'video',
                'label'       => __( 'Video Background', HB_DOMAIN_TXT ),
                'src'         => ''
              ),
            ),
          ),
          array(
            'id'          => 'video_url',
            'label'       => __( 'Video URL', HB_DOMAIN_TXT ),
            'desc'        => '<p class="description">' . __( 'Enter the full url to the youtube video page like this: https://www.youtube.com/watch?v=C-y70ZOSzE0', HB_DOMAIN_TXT ) . '</p>',
            'condition'   => 'type:is(video)',
            'type'        => 'text',
          ),
          array(
            'id'          => 'color',
            'label'       => __( 'Text Color', HB_DOMAIN_TXT ),
            'std'         => 'dark',
            'type'        => 'select',
            'choices'     => array( 
              array(
                'value'       => 'light',
                'label'       => __( 'Light', HB_DOMAIN_TXT ),
                'src'         => ''
              ),
              array(
                'value'       => 'dark',
                'label'       => __( 'Dark', HB_DOMAIN_TXT ),
                'src'         => ''
              ),
            )
          ),
          array(
            'id'          => 'padding_top',
            'label'       => __( 'Padding Top', HB_DOMAIN_TXT ),
            'std'         => array('50', 'px'),
            'type'        => 'measurement',
          ),
          array(
            'id'          => 'padding_bottom',
            'label'       => __( 'Padding Bottom', HB_DOMAIN_TXT ),
            'std'         => array('50', 'px'),
            'type'        => 'measurement',
          ),
          array(
            'id'          => 'fullwidth',
            'label'       => __( 'Fullwidth', HB_DOMAIN_TXT ),
            'std'         => 'off',
            'type'        => 'on-off',
          ),
          array(
            'id'          => 'overlay',
            'label'       => __( 'Overlay', HB_DOMAIN_TXT ),
            'type'        => 'on-off',
            'std'         => 'off',
          ),
          array(
            'id'          => 'pattern_overlay',
            'label'       => __( 'Overlay Pattern', HB_DOMAIN_TXT ),
            'std'         => '',
            'type'        => 'select',
            'condition'   => 'overlay:is(on)',
            'operator'    => 'and',
            'choices'     => array( 
              array(
                'value'       => '',
                'label'       => __( 'Off', HB_DOMAIN_TXT ),
                'src'         => ''
              ),        
              array(
                'value'       => 'strip-1',
                'label'       => __( 'Strip 01', HB_DOMAIN_TXT ),
                'src'         => ''
              ),
              array(
                'value'       => 'strip-2',
                'label'       => __( 'Strip 02', HB_DOMAIN_TXT ),
                'src'         => ''
              ),
              array(
                'value'       => 'dot-1',
                'label'       => __( 'Dot 01', HB_DOMAIN_TXT ),
                'src'         => ''
              ),
              array(
                'value'       => 'dot-2',
                'label'       => __( 'Dot 02', HB_DOMAIN_TXT ),
                'src'         => ''
              ),
              array(
                'value'       => 'dot-3',
                'label'       => __( 'Dot 03', HB_DOMAIN_TXT ),
                'src'         => ''
              ),
              array(
                'value'       => 'points-light',
                'label'       => __( 'Points (light)', HB_DOMAIN_TXT ),
                'src'         => ''
              ),
              array(
                'value'       => 'points-dark',
                'label'       => __( 'Points (dark)', HB_DOMAIN_TXT ),
                'src'         => ''
              ),
              array(
                'value'       => 'vertical',
                'label'       => __( 'Vertical', HB_DOMAIN_TXT ),
                'src'         => ''
              ),
              array(
                'value'       => 'horizontal',
                'label'       => __( 'Horizontal', HB_DOMAIN_TXT ),
                'src'         => ''
              ),   
              array(
                'value'       => 'triangle',
                'label'       => __( 'Triangle', HB_DOMAIN_TXT ),
                'src'         => ''
              ),
              array(
                'value'       => 'gradient',
                'label'       => __( 'Gradient', HB_DOMAIN_TXT ),
                'src'         => ''
              ),
            )
          ),
          array(
            'id'          => 'overlay_fixed',
            'label'       => __( 'Fixed Overlay Pattern', HB_DOMAIN_TXT ),
            'type'        => 'on-off',
            'std'         => 'off',
            'condition'   => 'overlay:is(on),pattern_overlay:not(),pattern_overlay:not(gradient)',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'color_overlay',
            'label'       => __( 'Overlay Color', HB_DOMAIN_TXT ),
            'type'        => 'colorpicker',
            'condition'   => 'overlay:is(on),pattern_overlay:not(gradient)',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'gradient_overlay_start',
            'label'       => __( 'Gradient Color Start', HB_DOMAIN_TXT ),
            'type'        => 'colorpicker',
            'condition'   => 'overlay:is(on),pattern_overlay:is(gradient)',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'gradient_overlay_end',
            'label'       => __( 'Gradient Color Stop', HB_DOMAIN_TXT ),
            'type'        => 'colorpicker',
            'condition'   => 'overlay:is(on),pattern_overlay:is(gradient)',
            'operator'    => 'and'
          ),      
          array(
            'id'          => 'overlay_opacity',
            'label'       => __( 'Overlay Opacity', HB_DOMAIN_TXT ),
            'type'        => 'numeric-slider',
            'min_max_step'=> '0,1,0.01',
            'std'         => '0.5',
            'condition'   => 'overlay:is(on)',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'bg',
            'label'       => __( 'Background', HB_DOMAIN_TXT ),
            'type'        => 'background',
          ),
          array(
            'id'          => 'content',
            'label'       => __( 'Content', HB_DOMAIN_TXT ),
            'std'         => '',
            'type'        => 'textarea',
            'rows'        => '10',
          ),
        ),
      ),
    )
  );


  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
  if ( function_exists( 'ot_register_meta_box' ) )

    foreach ( $metaboxes as $metaboxe )

      ot_register_meta_box( $metaboxe );

}

/**
 * Initialize the custom Meta Boxes Scripts. 
 */
add_action( 'admin_print_scripts', 'onyx_meta_boxes_scripts', 99 );

function onyx_meta_boxes_scripts() {

  ?>
  <script type="text/javascript">

      jQuery(document).ready(function ($) {

          function toggle_page_metaboxes() {

              var template = $("#page_template").val();

              if ( ! template ) { return }

              if (template == 'page-landing.php') {
                $('#postdivrich').fadeOut('fast');
                $('#landing_metabox').fadeIn('fast');
              } else {
                $('#postdivrich').fadeIn('fast');
                $('#landing_metabox').fadeOut('fast');
              }
          }

          toggle_page_metaboxes();

          $('#page_template').change(toggle_page_metaboxes);
      });
  </script><?php
}