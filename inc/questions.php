<?php

// function microtime_float()
// {
//     list($usec, $sec) = explode(" ", microtime());
//     return ((float)$usec + (float)$sec);
// }

// $search = array(
// 	'white' 	=> 7,
// 	'yellow' 	=> 13,
// 	'red'  		=> 8,
// 	'blue'		=> 18,
// 	'green' 	=> 3,
// 	'brown' 	=> 9
// );

// $pre = array('white', 'yellow', 'red', 'blue', 'green', 'brown');

// $data = array();

// for ($i = 3; $i < 10000; $i++)

// 	foreach ($pre as $value)

// 		$data[$i][$value] = rand(0, 20);


// $time_start = microtime_float();
// $startMemory = memory_get_usage();
// foreach ($data as $id => $user) {

// 	$total = 0;
// 	foreach ($user as $key => $value) {

// 		$score = 100 - ( abs($value - $search[$key]) * 5 );

// 		$data[$id][$key] = $score;

// 		$total += $score;
// 	}

// 	$data[$id]['match'] = $total / count($user);
// }
// echo memory_get_usage() - $startMemory, ' bytes<br>';

// $time_end = microtime_float();
// $time = $time_end - $time_start;

// echo "Matched ", count($data)," profiles with search criteria in $time seconds<br/>";

// // r($data);

// $time_start = microtime_float();
// //$startMemory = memory_get_usage();
// usort($data, function($a, $b) {
//     if($a['match']==$b['match']) return 0;
//     return $a['match'] < $b['match']?1:-1;
// });
// //echo memory_get_usage() - $startMemory, ' bytes<br>';

// $time_end = microtime_float();
// $time = $time_end - $time_start;

// echo "Sorted results in $time seconds<br/>";


// die;

/**
 * Set up question option
 *
 *
 */ 
function hb_after_switch_theme_question_option () {

	if ( ! get_option('hb_answer_counter') )
		add_option('hb_answer_counter', 1);

}
add_action('after_switch_theme', 'hb_after_switch_theme_question_option');

/**
 * Set up question tables
 *
 *
 */ 
function hb_after_switch_theme_question_tables () {

	global $wpdb;

	$wpdb->query( 
		$wpdb->prepare( 
			"
	        DELETE FROM $wpdb->postmeta
			WHERE post_id = %d
			AND meta_key = %s
			",
		        13, 'gargle' 
	        )
	);
}
//add_action('after_switch_theme', 'hb_after_switch_theme_question_tables');


///// REGISTER QUESTIONS

function oz_featured_question_post_type () {
	$labels = array(
		'name' => _x( 'Questions', 'post type general name', HB_DOMAIN_TXT ),
		'singular_name' => _x( 'Question', 'post type singular name', HB_DOMAIN_TXT ),
		'add_new' => _x( 'Add New', 'question', HB_DOMAIN_TXT ),
		'add_new_item' => __( 'Add New Question', HB_DOMAIN_TXT ),
		'edit_item' => __( 'Edit Question', HB_DOMAIN_TXT ),
		'new_item' => __( 'New Question', HB_DOMAIN_TXT ),
		'view_item' => __( 'View Question', HB_DOMAIN_TXT ),
		'search_items' => __( 'Search Question', HB_DOMAIN_TXT ),
		'not_found' =>  __( 'No question found', HB_DOMAIN_TXT ),
		'not_found_in_trash' => __( 'No question found in Trash', HB_DOMAIN_TXT ), 
		'parent_item_colon' => __( 'Parent question:', HB_DOMAIN_TXT )
	);
	$args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'taxonomies' => array( 'question-category' ), 
		'menu_position' => 5,
		'menu_icon' => 'dashicons-chart-pie',
		'supports' => array('title',/*'thumbnail', 'author','thumbnail','excerpt','comments'*/)
	);

	register_post_type( 'question', $args );

	// "Question Pages" Custom Taxonomy
	$labels = array(
		'name' => _x( 'Question Groups', 'taxonomy general name', HB_DOMAIN_TXT ),
		'singular_name' => _x( 'Question Groups', 'taxonomy singular name', HB_DOMAIN_TXT ),
		'search_items' =>  __( 'Search Question Groups', HB_DOMAIN_TXT ),
		'all_items' => __( 'All Question Groups', HB_DOMAIN_TXT ),
		'parent_item' => __( 'Parent Question Group', HB_DOMAIN_TXT ),
		'parent_item_colon' => __( 'Parent Question Group:', HB_DOMAIN_TXT ),
		'edit_item' => __( 'Edit Question Group', HB_DOMAIN_TXT ), 
		'update_item' => __( 'Update Question Group', HB_DOMAIN_TXT ),
		'add_new_item' => __( 'Add New Question Group', HB_DOMAIN_TXT ),
		'new_item_name' => __( 'New Question Group Name', HB_DOMAIN_TXT ),
		'menu_name' => __( 'Question Groups', HB_DOMAIN_TXT )
	); 	

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'question-category' )
	);

	register_taxonomy( 'question-category', array( 'question' ), $args );
} // End oz_featured_question_post_type()

add_action( 'init', 'oz_featured_question_post_type' );

/*-----------------------------/
	EDIT LIST CUSTOM COLUMNS
/-----------------------------*/
add_filter("manage_edit-question_columns", "question_edit_columns");

add_action("manage_posts_custom_column",  "question_columns_display", 10, 2);

add_theme_support( 'post-thumbnails', array( 'question' ) );
   
function question_edit_columns($question_columns){
    $question_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => _x('Question', 'column name', HB_DOMAIN_TXT),
        // "question_thumbnail" => __('Image', HB_DOMAIN_TXT),
        "group" => __('Group', HB_DOMAIN_TXT),
        "date" => __('Date', HB_DOMAIN_TXT)
    );
    return $question_columns;
}

function question_columns_display($question_columns, $post_id){
    switch ($question_columns)
    {
        case "question_thumbnail":
            $thumb_id = get_post_thumbnail_id( $post_id );
                
            if ($thumb_id != ''){
                $thumb = wp_get_attachment_image( $thumb_id, array( 100, 100 ), true );
                echo $thumb;
            } else {
                echo __('None', HB_DOMAIN_TXT);
            }
            
         break;

		case 'group':
				    
				    $terms = get_the_terms( $post_id, 'question-category', '', ', ', '' );
				    
					if ( $terms && ! is_wp_error( $terms ) ) : 

						$groups_list = array();

						foreach ( $terms as $term ) {
							$groups_list[] = "{$term->name} (Group ID: {$term->term_id})";
						}
											
						$groups = join( ", ", $groups_list );

						echo $groups;

					else :

						_e( '&#8212;', HB_DOMAIN_TXT );

					endif;
		break;
    }
}
