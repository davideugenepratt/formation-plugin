<?php
echo $args['before_widget'];

echo ( $instance['title'] != '' ? '<h2 class="widget-title">'.$instance['title'].'</h2>' : '' );

$cat_string = '';

foreach ( $instance['cats'] as $key => $cat ) {
	$cat_string .= ( $key == 0 ? $cat : ', '.$cat );  	
}

$post_args = array(
	'posts_per_page'   => $instance[ 'number' ],
	'category'         => $cat_string,
	'orderby'          => 'post_date',
	'order'            => 'DESC',
	'post_type'        => 'post',
	'post_status'      => 'publish',
	'suppress_filters' => true );

$posts = get_posts( $post_args );

if ( !empty( $posts ) ) {
	foreach ( $posts as $post ) {
		echo '<div class="formation_latest_posts_post">';
		echo '<a href="'.$post->guid.'">'.$post->post_title.'</a>';
		echo '</div>';
		//var_dump( $post );
	}
}

echo $args['after_widget'];
?>
