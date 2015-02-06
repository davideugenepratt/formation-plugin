<?php

/**
 * Adds Formation_Latest_Posts_Widget.
 */
class Formation_Latest_Posts_Widget extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'formation_latest_posts_widget', // Base ID
			__('Formation Latest Posts Widget', 'formation_latest_posts_widget'), // Name
			array( 'description' => __( 'A widget for a list of latest posts by category', 'formation_latest_posts_widget' ), ) // Args
		);
		
		add_action('enqueue_scripts', 'formation_latest_posts_scripts');

		function formation_latest_posts_scripts() {
			wp_enqueue_style( 'formation_latest_posts_css', plugin_dir_url( __FILE__ ) . 'css/formation-latest-posts-widget.css' );
		}
		
		add_action('admin_enqueue_scripts', 'formation_latest_posts_admin_scripts');
		 
		function formation_latest_posts_admin_scripts() {
			wp_enqueue_style( 'formation_latest_posts_css', plugin_dir_url( __FILE__ ) . 'css/formation-latest-posts-widget.css' );
		}

	}
	
	protected function get_cat_tree() {
		$args = array(
			'type'                     => 'post',
			'child_of'                 => '',
			'parent'                   => '',
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'exclude'                  => '',
			'include'                  => '',
			'number'                   => '',
			'taxonomy'                 => 'category',
			'pad_counts'               => false 
		
		); 
		
		$categories = get_categories( $args );
		
		// loop through all categories to build the necessary arrays
		foreach ( $categories as $category ) {
			// builds an associative array of all children and their parents
			$children_parents[ $category->term_id ] = $category->parent;
			// builds an associative array with each category's name
			$cat_names[ $category->term_id ] = $category->name;
		}
			
		foreach ( $categories as $category ) {
			// add current_cat name to $cat_string
			$cat_string = $category->name;
			// set $has_parent to true so the while loop will run atleast once
			$has_parent = true;
			$current_cat = $category->term_id;
			while ( $has_parent ) {	
				// check current cat in children_parents and see what it's parent is.
				if ( $children_parents[ $current_cat ] == 0 ) {
					// if parent is '0' then $has_parent is false
					$has_parent = false;
				}
				else {
					$current_cat = $children_parents[ $current_cat ];
					$cat_string = $cat_names[ $current_cat ].' -> '.$cat_string;
				}		
			}	
			$cat_tree[ $category->term_id ] = $cat_string;
		}
		
		natsort( $cat_tree );
		
		foreach( $cat_tree as $key => $cat_tree ) {
			$cats = explode( ' -> ' , $cat_tree );
			$cat_name = array_pop( $cats );
			$padding = '';
			foreach ( $cats as $cat ) {
				$padding .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}
			$cat_name = $padding.'-&nbsp;'.$cat_name;
			$cats_short[ $key ] = $cat_name;
		}
				
		return( $cats_short );
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
		
		$instance['title'] = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$instance['cats'] = ( ! empty( $instance['cats'] ) ) ? $instance['cats'] : array();
		$instance['number'] = ( ! empty( $instance['number'] ) ) ? $instance['number'] : '';
				
		include_once('templates/Formation_Latest_Posts_Widget_Frontend.php');
		
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
		$instance['title'] = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$instance['cats'] = ( ! empty( $instance['cats'] ) ) ? $instance['cats'] : array();
		$instance['number'] = ( ! empty( $instance['number'] ) ) ? $instance['number'] : '';
		
		include('templates/Formation_Latest_Posts_Widget_Backend.php');
		
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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['cats'] = ( ! empty( $new_instance['cats'] ) ) ? $new_instance['cats'] : '';
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
		return $instance;
	}

} // class Formation_Latest_Posts_Widget

?>