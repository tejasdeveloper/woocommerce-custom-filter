<?PHP 
	add_action( 'wp_enqueue_scripts', 'gated_script_include' );
	function gated_script_include(){
		$pluginURL = plugin_dir_url( __FILE__ ) ;
		
		wp_enqueue_style('gatedstyle', $pluginURL ."/css/style.css");
		wp_enqueue_script('gatedscript', $pluginURL  . '/js/gated_init.js',array("jquery"));
		wp_localize_script( 'gatedscript', 'my_ajax_object',array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		
	}

	
 ?>