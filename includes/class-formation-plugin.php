<?php
 
class Formation_Plugin {
 
    protected $loader;
 
    protected $plugin_slug;
 
    protected $version;
	
	protected $options;
 
    public function __construct() {
 
        $this->plugin_slug = 'formation-plugin';
        $this->version = '0.1.0';
 
        $this->load_dependencies();
        $this->define_hooks();
 
    }
 
    private function load_dependencies() {
 
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-formation-plugin-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-formation-plugin-paralax.php';
		require_once plugin_dir_path( __FILE__ ) . 'class-formation-plugin-loader.php';
        $this->loader = new Formation_Plugin_Loader();
 
    }
 
    private function define_hooks() {
 		
		// Admin Hooks
        $admin = new Formation_Plugin_Admin( $this->get_version() );
		$this->loader->add_action( 'activate_formation-plugin/formation_plugin.php', $admin, 'formation_default_settings' );
		$this->loader->add_action( 'wp_head', $admin, 'formation_google_analytics_tracking_code' );
		$this->loader->add_action( 'admin_menu', $admin, 'formation_add_options_menu_item' );
		$this->loader->add_action( 'admin_init', $admin, 'formation_register_settings' );
        $this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_head' );
		$this->loader->add_action( 'widgets_init', $admin, 'formation_plugin_widgets_init' );
		
		// Paralax Hooks
		$paralax = new Formation_Plugin_Paralax();
		$this->loader->add_action( 'wp_enqueue_scripts', $paralax, 'formation_plugin_enque_scripts' );
		$this->loader->add_action( 'print_media_templates' , $paralax, 'add_media_template' );
		$this->loader->add_filter( 'post_gallery', $paralax, 'gallery_template', 10, 4 );
		
    }
 
    public function run() {
        $this->loader->run();
    }
 
    public function get_version() {
        return $this->version;
    }
 
}