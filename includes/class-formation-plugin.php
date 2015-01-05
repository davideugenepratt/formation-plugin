<?php
 
class Formation_Plugin {
 
    protected $loader;
 
    protected $plugin_slug;
 
    protected $version;
 
    public function __construct() {
 
        $this->plugin_slug = 'formation-plugin';
        $this->version = '0.1.0';
 
        $this->load_dependencies();
        $this->define_admin_hooks();
 
    }
 
    private function load_dependencies() {
 
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-formation-plugin-admin.php';
 
        require_once plugin_dir_path( __FILE__ ) . 'class-formation-plugin-loader.php';
        $this->loader = new Formation_Plugin_Loader();
 
    }
 
    private function define_admin_hooks() {
 
        $admin = new Formation_Plugin_Admin( $this->get_version() );
        $this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_styles' );
		$this->loader->add_action( 'customize_register', $admin, 'formation_customize_register' );
		$this->loader->add_action( 'wp_head', $admin, 'formation_google_analytics' );
		$this->loader->add_action( 'widgets_init', $admin, 'formation_plugin_widgets_init' );
		 
    }
 
    public function run() {
        $this->loader->run();
    }
 
    public function get_version() {
        return $this->version;
    }
 
}