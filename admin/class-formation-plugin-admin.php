<?php
 
class Formation_Plugin_Admin {
 
    private $version;
 
    public function __construct( $version ) {
        $this->version = $version;
    }
 
    public function enqueue_head() {
 
        wp_enqueue_style(
            'formation-plugin-admin',
            plugin_dir_url( __FILE__ ) . 'css/formation-plugin-admin.css',
            array(),
            $this->version,
            FALSE
        );
		
		
 
    }
	
	public function formation_google_analytics_tracking_code(){
		
		$features = get_option( 'formation-plugin-features' );				
				
		if ( isset( $features["google_analytics"] ) ) {
			
			$propertyID = $features["google_analytics_id"]; // GA Property ID
						
			?>
			<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			  ga('create', '<?php echo $propertyID; ?>', 'auto');
			  ga('send', 'pageview');
			
			</script>
			<?php
		}
	}
	
	public function formation_add_options_menu_item() {
		
		add_options_page( 'Formation Plugin Settings','Formation Plugin','manage_options','formation-plugin-options', array( $this, 'formation_options_page' ) );		
	
	}
	
	public function formation_options_page() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/views/options-page.php' );

	}
 	
	public function formation_register_settings() {

		register_setting(
            'formation-plugin-options', // Option group
            'formation-plugin-widgets' // Option name
        );
		
		register_setting(
            'formation-plugin-options', // Option group
            'formation-plugin-features' // Option name
        );				
		
	}
	
	public function formation_default_settings() {
		
		update_option( 'formation-plugin-widgets' , array( "image_slider" => "on", "contact_form" => "on", "latest_posts" => "on", "social_media" => "on"  ) );
		update_option( 'formation-plugin-features' , array( "google_analytics" => "on", "paralax_galleries" => "on" ) );      
	}
	
	// This is deprecated. GA will be in options page.
	/*
	public function formation_customize_register( $wp_customize ) {
	   $wp_customize->add_section( 'google_analytics' , array(
			'title'      => __( 'Google Analytics', 'formation' ),
			'priority'   => 30,
		) );
		
		$wp_customize->add_setting( 'google_analytics_account_id' , array(
			'default'     => '',
			'transport'   => 'refresh',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'google_analytics_account_id', array(
			'label'        => __( 'Google Analytics ID', 'formation' ),
			'section'    => 'google_analytics',
			'settings'   => 'google_analytics_account_id',
		) ) );
		
	}
	*/
	
	public function formation_google_analytics() {
		?>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		  ga('create', '<?php echo get_theme_mod( google_analytics_account_id ); ?>', 'auto');
		  ga('send', 'pageview');
		
		</script>
		<?php
	}
	
	
	public function formation_plugin_widgets_init() {
		
		$widgets = get_option( 'formation-plugin-widgets' );
		
		if ( is_array( $widgets ) ) {
		
			if ( isset( $widgets["image_slider"] ) ) {
				include( plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/Formation_Image_Slider_Widget.php');
				register_widget( 'Formation_Image_Slider_Widget' );
			}
			
			if ( isset( $widgets["contact_form"] ) ) {
				include( plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/Formation_Contact_Widget.php');
				register_widget( 'Formation_Contact_Widget' );
			}
			
			if ( isset( $widgets["social_media"] ) ) {
				include( plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/Formation_Social_Widget.php');
				register_widget( 'Formation_Social_Widget' );	
			}
			
			if ( isset( $widgets["latest_posts"] ) ) {
				include( plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/Formation_Latest_Posts_Widget.php');
				register_widget( 'Formation_Latest_Posts_Widget' );	
			}
			
		}
		
	}
	
}