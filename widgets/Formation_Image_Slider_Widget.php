<?php
//require_once('../firePHPcore/fb.php');
/**
 * Adds Formation_Image_Slider_Widget.
 */
class Formation_Image_Slider_Widget extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'formation_image_slider_widget', // Base ID
			__('Formation Image Slider Widget', 'formation_image_slider_widget'), // Name
			array( 'description' => __( 'A widget for the Bootstrap slider', 'formation_image_slider_widget' ), ) // Args
		);
				
		
		
		function formation_image_slider_widget_scripts() {
			
			wp_enqueue_style( 'bootstrap_css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css' );
			wp_register_script('bootstrap_js', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array('jquery') );
			wp_enqueue_script('bootstrap_js');
			
		}
		
		add_action( 'wp_enqueue_scripts', 'formation_image_slider_widget_scripts' );				
 
		function formation_image_slider_widget_admin_scripts() {
			//FB::log('test');
			wp_enqueue_style( 'style-name', plugin_dir_url( __FILE__ ) . 'css/formation-image-slider-widget.css' );	
			wp_register_script('formation-image-slider-widget-admin-js', plugin_dir_url( __FILE__ ) . 'js/formation-image-slider-widget.js', array('jquery'));
			wp_enqueue_script('formation-image-slider-widget-admin-js');
			wp_enqueue_media();
			wp_enqueue_script('post');
			wp_enqueue_script('editor');
			add_thickbox();
			wp_enqueue_script('media-upload');
			wp_enqueue_script('word-count');
		}
		
		add_action('admin_enqueue_scripts', 'formation_image_slider_widget_admin_scripts');

	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
				
		include_once('templates/Formation_Image_Slider_Widget_Frontend.php');
		
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
		include('templates/Formation_Image_Slider_Widget_Backend.php');
		
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['all_images'] = ( ! empty( $new_instance['all_images'] ) ) ? strip_tags( $new_instance['all_images'] ) : '';

		return $instance;
	}

} // class Formation_Image_Slider_Widget

?>