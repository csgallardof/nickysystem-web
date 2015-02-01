<?php
// Register Custom Post Type
function mnky_portfolio_post_type() {

	$labels = array(
		'name'                => _x( 'Portfolios', 'Post Type General Name', 'core-extend' ),
		'singular_name'       => _x( 'Portfolio', 'Post Type Singular Name', 'core-extend' ),
		'menu_name'           => __( 'Portfolio', 'core-extend' ),
		'parent_item_colon'   => __( 'Parent Item:', 'core-extend' ),
		'all_items'           => __( 'All Items', 'core-extend' ),
		'view_item'           => __( 'View Item', 'core-extend' ),
		'add_new_item'        => __( 'Add New Item', 'core-extend' ),
		'add_new'             => __( 'Add New', 'core-extend' ),
		'edit_item'           => __( 'Edit Item', 'core-extend' ),
		'update_item'         => __( 'Update Item', 'core-extend' ),
		'search_items'        => __( 'Search Item', 'core-extend' ),
		'not_found'           => __( 'Not found', 'core-extend' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'core-extend' ),
	);
	$args = array(
		'label'               => __( 'portfolio-item', 'core-extend' ),
		'description'         => __( 'Portfolio Post Type', 'core-extend' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt'),
		'taxonomies'          => array( 'portfolio_category', 'portfolio_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon' => 'dashicons-format-image',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite' => array('slug' => 'portfolio-item'),
		'capability_type'     => 'post',
	);
	register_post_type( 'portfolio', $args );

}

// Hook into the 'init' action portfolio post type
add_action( 'init', 'mnky_portfolio_post_type', 0 );



function mnky_portfolio_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'core-extend' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'core-extend' ),
		'search_items'      => __( 'Search Categories', 'core-extend' ),
		'all_items'         => __( 'All Categories', 'core-extend' ),
		'parent_item'       => __( 'Parent Category', 'core-extend' ),
		'parent_item_colon' => __( 'Parent Category:', 'core-extend' ),
		'edit_item'         => __( 'Edit Category', 'core-extend' ),
		'update_item'       => __( 'Update Category', 'core-extend' ),
		'add_new_item'      => __( 'Add New Category', 'core-extend' ),
		'new_item_name'     => __( 'New Category Name', 'core-extend' ),
		'menu_name'         => __( 'Category', 'core-extend' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'portfolio-category' ),
	);

	register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );

	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Tags', 'taxonomy general name', 'core-extend' ),
		'singular_name'              => _x( 'Tag', 'taxonomy singular name', 'core-extend' ),
		'search_items'               => __( 'Search Tags', 'core-extend' ),
		'popular_items'              => __( 'Popular Tags', 'core-extend' ),
		'all_items'                  => __( 'All Tags', 'core-extend' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Tag', 'core-extend' ),
		'update_item'                => __( 'Update Tag', 'core-extend' ),
		'add_new_item'               => __( 'Add New Tag', 'core-extend' ),
		'new_item_name'              => __( 'New Tag Name', 'core-extend' ),
		'separate_items_with_commas' => __( 'Separate tags with commas', 'core-extend' ),
		'add_or_remove_items'        => __( 'Add or remove tags', 'core-extend' ),
		'choose_from_most_used'      => __( 'Choose from the most used tags', 'core-extend' ),
		'not_found'                  => __( 'No tags found.', 'core-extend' ),
		'menu_name'                  => __( 'Tags', 'core-extend' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'portfolio-tag' ),
	);

	register_taxonomy( 'portfolio_tag', 'portfolio', $args );
}

// Hook into the 'init' action portfolio taxonomies
add_action( 'init', 'mnky_portfolio_taxonomies', 0 );



function mnky_portfolio_columns( $gallery_columns ) {
	$new_columns['cb'] = '<input type="checkbox" />';
	$new_columns['title'] = __('Title', 'core-extend' ); 
	$new_columns['thumbnail'] = __('Image', 'core-extend' );
	$new_columns['portfolio_category'] = __('Categories', 'core-extend' );
	$new_columns['portfolio_tag'] = __('Tags', 'core-extend' );
	$new_columns['date'] = __('Date', 'core-extend' );
	 
	return $new_columns;
}

// Add filter for portfolio custom columns
add_filter('manage_edit-portfolio_columns', 'mnky_portfolio_columns');

 
function mnky_manage_portfolio_columns( $column_name ) {
	global $post;
	
	switch ($column_name) {
	
		/* If displaying the 'Image' column. */
		case 'thumbnail':
			echo get_the_post_thumbnail( $post->ID, array( 100, 100) );
		break;
		
		/* If displaying the 'Categories' column. */
		case 'portfolio_category' :

			$terms = get_the_terms( $post->ID, 'portfolio_category' );

			if ( !empty( $terms ) ) {

				$out = array();
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'portfolio_category' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'portfolio_category', 'display' ) )
					);
				}
				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			/* If no terms were found, output a default message. */
			else {
				echo '&macr;';
			}

			break;

		
		/* If displaying the 'Tags' column. */
		case 'portfolio_tag' :

			$terms = get_the_terms( $post->ID, 'portfolio_tag' );

			if ( !empty( $terms ) ) {

				$out = array();
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'portfolio_tag' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'portfolio_tag', 'display' ) )
					);
				}
				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			/* If no terms were found, output a default message. */
			else {
				echo '&macr;';
			}

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
		break;
	
	} 
}	

// Add filter for portfolio custom column view
add_action('manage_portfolio_posts_custom_column', 'mnky_manage_portfolio_columns', 10, 2);
