<?php

$images = json_decode( $instance['all_images'] );

?>
<div class="col-xs-12">
    <div id="<?php echo $this->get_field_id('slider'); ?>" class="carousel slide" data-ride="carousel" >
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <?php
        foreach ( $images as $key => $image ) {
            $id = $this->get_field_id('slider');
            $active = ( $key == 0 ) ? 'active' : '';
            echo '<li data-target="#'.$id.'" data-slide-to="'.$key.'" class="'.$active.'"></li>';	
        }
        ?>
      </ol>
    
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <?php
        foreach ( $images as $key => $image_inst ) {
			$image = $image_inst[0];
			$link = $image_inst[1];
			$caption = $image_inst[2];
            $id = $this->get_field_id('slider');
            $active = ( $key == 0 ) ? 'active' : '';
			$link_beg = '';
			$link_end = '';
			if ( $link != '' ) {
				$link_beg = '<a href="'.$link.'">';
				$link_end = '</a>';
			}
            echo '<div class="item '.$active.'">'.$link_beg.'<img src="'.$image.'" alt="'.$caption.'">'.$link_end.'<div class="carousel-caption">'.$caption.'</div></div>';
        }
        ?>
      </div>
    
      <!-- Controls -->
      <a class="left carousel-control" href="#<?php echo $this->get_field_id('slider'); ?>" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#<?php echo $this->get_field_id('slider'); ?>" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
    </div>
</div>
