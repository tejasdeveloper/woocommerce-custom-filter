<?PHP 
	
	add_action( 'wp_ajax_get_filter_products', 'get_filter_products' );    // If called from admin panel
	add_action( 'wp_ajax_nopriv_get_filter_products', 'get_filter_products' );
	function get_filter_products(){
	
		if($colors_arr = explode(",",$_POST["colors"])){
			$allcolors = $colors_arr;
		}else { 
		
		}				
		$brand  = $_POST["brand"];
		
		
		
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 12,
			'tax_query' => array(
				'relation' => "OR",
				array(
				   'taxonomy' => 'custombrand',
				   'field'    => 'term_id',                      
					'terms'    => $brand,
					'operator' => 'IN',                
				),
				array(
				   'taxonomy' => 'pa_color',
				   'field'    => 'term_id',                      
					'terms'    => $allcolors,
					'operator' => "IN",                
				)
		   ),
			
		); //change this arguments depending on your needs
		$loop = new WP_Query( $args );
		$products = '';
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
				$products .= wc_get_template_part( 'content', 'product' );
			endwhile;
		} else {
				$products = 'No products found';
		}
		echo $products;
		die();
	}


	add_action( 'woocommerce_before_shop_loop', 'add_custom_prouct_filter' );
	function add_custom_prouct_filter(){
		ob_start();?>
		
			<div class="filterwraper">
            	<div class="filterbybrand">
                	<h3>Filter by Brand</h3>
                	<div class="filterbuttosons">
                    	<?PHP 
						$brandlist = get_terms( array(
							'taxonomy' => 'custombrand',
							'hide_empty' => false
						) );
						if ( !empty($brandlist) ) :
						foreach( $brandlist as $branditem ) {
						?>
                    	<div class="filterbrandtems">                        	
                            <input type="radio" id="brand_<?PHP echo $branditem->term_id; ?>" name="txbrand" value="<?PHP echo $branditem->term_id; ?>" />
                            <label for="brand_<?PHP echo $branditem->term_id; ?>"><?PHP echo $branditem->name ;?></label>
                        </div>
                        
                        <?PHP 
						}
						endif;
						?>
                        
                    </div>
                    
                </div>
                
                <?PHP 
				    global $woocommerce, $post, $product;
					$all_attribute =  wc_get_attribute_taxonomies();
					
					
					$color_list = get_terms( array(
						'taxonomy' => 'pa_color',
						'hide_empty' => false
					) );
				 //print_r($color_list)	;
				?>
                <div class="filterbybrand">
                	<h3>Filter by Colors</h3>
                	<div class="filterbuttosons">
                    	<?PHP 
						//global $woocommerce, $post, $product;
						//$all_attribute =  wc_get_attribute_taxonomies();
						//print_r($all_attribute);
						
						$color_list = get_terms( array(
							'taxonomy' => 'pa_color',
							'hide_empty' => false
						) );
						if ( !empty($color_list) ) :
						foreach( $color_list as $color_item ) {
						?>
                    	<div class="filterbrandtems">                        	
                            <input type="checkbox" id="color_<?PHP echo $color_item->term_id; ?>" name="colors[]" value="<?PHP echo $color_item->term_id; ?>" />
                            <label for="brand_<?PHP echo $branditem->term_id; ?>"><?PHP echo $color_item->name ;?></label>
                        </div>
                        
                        <?PHP 
						}
						endif;
						?>
                        
                    </div>
                    
                </div>
            	
            </div>	
		
	<?PHP
		$return_content = ob_get_clean(); 
		
		echo $return_content; 
	
	}
	
 ?>