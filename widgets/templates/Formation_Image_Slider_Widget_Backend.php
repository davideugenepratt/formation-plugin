<?php
if ( isset( $instance[ 'all_images' ] ) ) {
	$images = json_decode( $instance[ 'all_images' ] );
}
?>

<div class="formation_image_slider_widget_container">
    <button id="<?php echo $this->get_field_id('formation_image_slider_add_image'); ?>" class="formation_image_slider_add_image button-secondary">Add an Image</button>
    <div id="<?php echo $this->get_field_id('slider_images'); ?>" class="slider_images_container">
        <?php		
        if ( isset( $images ) ) {
            foreach ( $images as $image_inst ) {
				$image = $image_inst[0];
				$link = $image_inst[1];
				$caption = $image_inst[2];
                echo '<div class="slider_image"><img src="'.$image.'"><a href="#" class="formation_image_slider_up gen-enclosed foundicon-up-arrow control" ><span>Up</span></a><a href="#" class="formation_image_slider_down gen-enclosed foundicon-down-arrow control" ><span>Down</span></a><a href="#" class="formation_image_slider_control gen-enclosed foundicon-settings control" ><span>Caption</span></a><a href="#" class="formation_image_slider_delete gen-enclosed foundicon-remove control"><span>Delete</span></a><input type="hidden" value="'.$image.'" class="img_url"><input type="hidden" value="'.$link.'" class="img_link"><input type="hidden" value="'.$caption.'" class="img_caption"></div>';
            }
        }
        ?>
    </div>
    <input class="all_images" id="<?php echo $this->get_field_id( 'all_images' ); ?>" name="<?php echo $this->get_field_name( 'all_images' ); ?>" type="hidden" value="<?php echo esc_attr( $instance[ 'all_images' ] ); ?>">
</div>


<?php 

?>