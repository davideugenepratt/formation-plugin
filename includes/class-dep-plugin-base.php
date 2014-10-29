<?php
 
class DEP_Plugin_Base {
 
    protected $loader;
 
    protected $plugin_slug;
 
    protected $version;
 
    public function __construct() {
 
        $this->plugin_slug = 'dep-plugin-base-slug';
        $this->version = '0.2.0';
 
        $this->load_dependencies();
        $this->define_admin_hooks();
 
    }
 
    private function load_dependencies() {
 
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-dep-plugin-base-admin.php';
 
        require_once plugin_dir_path( __FILE__ ) . 'class-dep-plugin-base-loader.php';
        $this->loader = new DEP_Plugin_Base_Loader();
 
    }
 
    private function define_admin_hooks() {
 
        $admin = new DEP_Plugin_Base_Admin( $this->get_version() );
        $this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_styles' );
        $this->loader->add_action( 'add_meta_boxes', $admin, 'add_meta_box' );
 
    }
 
    public function run() {
        $this->loader->run();
    }
 
    public function get_version() {
        return $this->version;
    }
 
}