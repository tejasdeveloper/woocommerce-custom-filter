<?PHP 
	add_action( 'init', 'add_brand_to_product' );

	// Register Custom Taxonomy
	function add_brand_to_product()  {
	
		$labels = array(
			'name'                       => 'Brands',
			'singular_name'              => 'Brand',
			'menu_name'                  => 'Brand',
			'all_items'                  => 'All Brands',
			'parent_item'                => 'Parent Brand',
			'parent_item_colon'          => 'Parent Brand:',
			'new_item_name'              => 'New Brand Name',
			'add_new_item'               => 'Add New Brand',
			'edit_item'                  => 'Edit Brand',
			'update_item'                => 'Update Brand',
			'separate_items_with_commas' => 'Separate Brand with commas',
			'search_items'               => 'Search Brand',
			'add_or_remove_items'        => 'Add or remove Ites',
			'choose_from_most_used'      => 'Choose from the most used Brands',
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'custombrand', 'product', $args );
		register_taxonomy_for_object_type( 'custombrand', 'product');
	
	}
	
	
 ?>