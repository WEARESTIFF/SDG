<?php
/**
 * Custom template tags for Swiss Design Group
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Swiss_Design_Group
 * @since Swiss Design Group 1.0
 */

if ( ! function_exists( 'SDG_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since Swiss Design Group 1.0
 */
function SDG_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', HB_DOMAIN_TXT ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', HB_DOMAIN_TXT ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', HB_DOMAIN_TXT ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
endif;

if ( ! function_exists( 'SDG_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * @since Swiss Design Group 1.0
 */
function SDG_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() ) {
		printf( '<span class="sticky-post">%s</span>', __( 'Featured', HB_DOMAIN_TXT ) );
	}

	$format = get_post_format();
	if ( current_theme_supports( 'post-formats', $format ) ) {
		printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
			sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', HB_DOMAIN_TXT ) ),
			esc_url( get_post_format_link( $format ) ),
			get_post_format_string( $format )
		);
	}

	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
			_x( 'Posted on', 'Used before publish date.', HB_DOMAIN_TXT ),
			esc_url( get_permalink() ),
			$time_string
		);
	}

	if ( 'post' == get_post_type() ) {
		if ( is_singular() || is_multi_author() ) {
			printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>',
				_x( 'Author', 'Used before post author name.', HB_DOMAIN_TXT ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);
		}

		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', HB_DOMAIN_TXT ) );
		if ( $categories_list && SDG_categorized_blog() ) {
			printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Categories', 'Used before category names.', HB_DOMAIN_TXT ),
				$categories_list
			);
		}

		$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', HB_DOMAIN_TXT ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Tags', 'Used before tag names.', HB_DOMAIN_TXT ),
				$tags_list
			);
		}
	}

	if ( is_attachment() && wp_attachment_is_image() ) {
		// Retrieve attachment metadata.
		$metadata = wp_get_attachment_metadata();

		printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
			_x( 'Full size', 'Used before full size attachment link.', HB_DOMAIN_TXT ),
			esc_url( wp_get_attachment_url() ),
			$metadata['width'],
			$metadata['height']
		);
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', HB_DOMAIN_TXT ), __( '1 Comment', HB_DOMAIN_TXT ), __( '% Comments', HB_DOMAIN_TXT ) );
		echo '</span>';
	}
}
endif;

/**
 * Determine whether blog/site has more than one category.
 *
 * @since Swiss Design Group 1.0
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function SDG_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'SDG_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'SDG_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so SDG_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so SDG_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in {@see SDG_categorized_blog()}.
 *
 * @since Swiss Design Group 1.0
 */
function SDG_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'SDG_categories' );
}
add_action( 'edit_category', 'SDG_category_transient_flusher' );
add_action( 'save_post',     'SDG_category_transient_flusher' );

if ( ! function_exists( 'SDG_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since Swiss Design Group 1.0
 */
function SDG_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
		?>
	</a>

	<?php endif; // End is_singular()
}
endif;

if ( ! function_exists( 'SDG_get_link_url' ) ) :
/**
 * Return the post URL.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Swiss Design Group 1.0
 *
 * @see get_url_in_content()
 *
 * @return string The Link format URL.
 */
function SDG_get_link_url() {
	$has_url = get_url_in_content( get_the_content() );

	return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
endif;

if ( ! function_exists( 'SDG_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
 *
 * @since Swiss Design Group 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function SDG_excerpt_more( $more ) {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading %s', HB_DOMAIN_TXT ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'SDG_excerpt_more' );
endif;



/*
 * Landing content.
 *
 * @since sTheme 1.0
*/
function hb_landing_template_content_filter( $layer ){

	if ( ! isset($layer['type']) || 'off' == $layer['publish'] ) return;

	extract( $layer );

	ob_start();

	?>

	<div id="<?php echo $layer_id; ?>" class="hb-layer hb-layer-landing hb-layer-<?php echo $color; ?>">

	<?php 

	switch ($type) {

		case 'video':
			
			hb_landing_template_content_video( $layer );
			break;

		default:

			hb_landing_template_content_default( $layer );
	}

	?>

	</div><!-- .hb-layer -->

	<?php

	$html = ob_get_contents();

	ob_end_clean();

	return $html;
}
add_filter( 'hb_landing_template_content', 'hb_landing_template_content_filter', 10 , 1 );

/*
 * Landing content (video).
 *
 * @since sTheme 1.0
*/
function hb_landing_template_content_video( $layer ){

	if ( $layer['video_url'] ){

		echo hb_get_background_video(0 , $layer['video_url']);
	}

	hb_landing_template_content_default( $layer );
}

/*
 * Landing content (default).
 *
 * @since sTheme 1.0
*/
function hb_landing_template_content_default( $layer ){

	extract( $layer );

	?>

	<div class="layer-overlay"></div>

	<?php if ( 'on' != $fullwidth ): ?>
	<div class="hb-layer-landing-content">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
		<?php endif; ?>
					<?php if ( trim($content) ): ?>
					<div class="hb-layer-landing-content-inner clearfix">
						<?php echo apply_filters('the_content', $content ); ?>
					</div>
					<?php endif; ?>
		<?php if ( 'on' != $fullwidth ): ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>

	<?php
}