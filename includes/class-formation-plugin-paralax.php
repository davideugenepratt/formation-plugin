<?php

class Formation_Plugin_Paralax {
	
	public function formation_plugin_enque_scripts() {
		
		wp_enqueue_script( 'bootstrap', plugin_dir_url( __FILE__ ) . '../js/bootstrap.js', array( 'jquery' ) );

		wp_enqueue_script( 'skrollr', plugin_dir_url( __FILE__ ) . '../js/skrollr.min.js', array(), '', true );

		wp_enqueue_script( 'formation-plugin', plugin_dir_url( __FILE__ ) . '../js/formation-plugin.js', array(), '', true );
 
    }
	
	function gallery_template( $output = '', $atts, $content = false, $tag = false ) {
		$return = $output; // fallback 
		$ids = explode( ',' , $atts['ids'] );		
		$controls_html = '';
		$images = '';
		foreach ( $ids as $key => $id ) {
			//$active = '';
			//if ( $key == 0 ) { $active = 'active';  }
			//$controls_html .= '<li data-target="#case-study-carousel" data-slide-to="'.$key.'" class="'.$active.'"></li>';
			$key++;
			$image_full = wp_get_attachment_image_src( $id, 'full-screen' );
			$image_medium = wp_get_attachment_image_src( $id, 'half-screen' );
			$image_small = wp_get_attachment_image_src( $id, 'small-screen' );
			$image_info = wp_prepare_attachment_for_js( $id ) ;
			//var_dump(  );
			//echo '<br><br>';
			//$images .= '<section id="slide-'.$key.'" ><div class="bcg"><img src="'.$image_url[0].'" alt="..."><div class="carousel-caption"><h1>'.$image_info["title"].'</h1>'.$image_info["caption"].'</div></div>';
			ob_start();
			?>
            <section id="slide-<?php echo $key; ?>" class="homeSlide">
                <div class="bcg"
                    data-center="background-position: 50% 0px;"
                    data-bottom-top="background-position: 50% 100px;"
                    data-top-bottom="background-position: 50% -100px;"
                    data-anchor-target="#slide-<?php echo $key; ?>"
                   
                >
                	<style>
					
					#slide-<?php echo $key; ?> .hsContainer { background-image:url('<?php echo $image_small[0]; ?>'); };
					
					@media(  min-width: 500px ) { #slide-<?php echo $key; ?> .hsContainer { background-image:url('<?php echo $image_medium[0]; ?>'); }; }
					
					@media(  min-width: 1000px ) { #slide-<?php echo $key; ?> .hsContainer { background-image:url('<?php echo $image_full[0]; ?>'); }; }
					
					</style>
                    <div class="hsContainer" style="padding-top:<?php echo ( ( $image_full[2] / $image_full[1] ) * 100 ); ?>%;">                    
                        <div class="largeContainer">
                                <div class="curtainContainer">
                                    <div class="curtain"
                                        data-bottom-top="opacity: 0"
                                        data-106-top="height: 1%; top: -10%; opacity: 0;"
                                        data-center="height: 100%; top: 0%; opacity: 0.5"
                                        data-anchor-target="#slide-<?php echo $key; ?>"
                                    ></div>
                                    <div class="copy"
                                        data-bottom-top="opacity: 0"
                                        data--50-bottom="opacity: 0"
                                        data--150-bottom="opacity: 1;"
                                        data-150-top="opacity: 1;"
                                        data-50-top="opacity: 0;"
                                        data-anchor-target="#slide-<?php echo $key; ?> .copy"
                                    >
                                        <h2><?php echo $image_info["title"]; ?></h2>
                                        <p>
										 <?php echo $image_info["caption"]; ?>
                                        </p>
                                    </div>
                         
                            </div>
                        </div>
                	</div>
                </div>
</section>
            
			<?php

		$output .= ob_get_contents();
		ob_end_clean();
			
		}
		
		if ( !isset( $dep_site_gallery_id ) ) {
			$dep_site_gallery_id = 0;
		}
		else {
			$dep_site_gallery_id++;	
		}
		
		/*
		ob_start();
		?>
        <div class="row">
        	<div class="col-xs-12">
		<div id="case-study-carousel-<?php echo $dep_site_gallery_id; ?>" class="carousel slide" data-interval="10000" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
			<?php echo $controls_html; ?>
		  </ol>
		
		  <!-- Wrapper for slides -->
		  <div class="carousel-inner">
			
			<?php echo $images; ?>
			
		  </div>
		
		  <!-- Controls -->
		  <a class="left carousel-control" href="#case-study-carousel-<?php echo $dep_site_gallery_id; ?>" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
		  </a>
		  <a class="right carousel-control" href="#case-study-carousel-<?php echo $dep_site_gallery_id; ?>" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
		  </a>
		</div>
        </div>
        </div>
        <?php
		
		$output = ob_get_contents();
		ob_end_clean();
		*/
		// retrieve content of your own gallery function
		$my_result = $output;
	
		// boolean false = empty, see http://php.net/empty
		if( !empty( $my_result ) ) {
			$return = $my_result;
		}
	
		return $return;
	}
	
	public function add_media_template(){

	// define your backbone template;
	// the "tmpl-" prefix is required,
	// and your input field should have a data-setting attribute
	// matching the shortcode name
	?>
	<script type="text/html" id="tmpl-gallery-type">
	<label class="setting">
	  <span><?php _e('Gallery Type'); ?></span>
	  <select data-setting="gallery-type">
		<option value="tiled"> Tiled </option>
		<option value="parallax"> Parallax </option>
		<option value="slider"> Slider </option>
	  </select>
	</label>
	</script>
	<script type="text/html" id="tmpl-slide-details">
	<label class="setting">
	  <span><?php _e('Slide Details'); ?></span>
	  <select data-setting="Slide Details">
		<option value="tiled"> Curtain </option>
		<option value="parallax"> Fade </option>
		<option value="slider"> Blurr </option>
	  </select>
	</label>
	</script>
	<script>

    jQuery(document).ready(function(){

      // add your shortcode attribute and its default value to the
      // gallery settings list; $.extend should work as well...
      _.extend(wp.media.gallery.defaults, {
        gallery_type: 'tiled'
      });

      // merge default gallery settings template with yours
      wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
        template: function(view){
          return wp.media.template('gallery-settings')(view)
               + wp.media.template('gallery-type')(view);
        }
      });
	  
	  wp.media.view.Attachment.Details = wp.media.view.Attachment.Details.extend({
        template: function(view){
          return wp.media.template('attachment-details')(view)
               + wp.media.template('slide-details')(view);
        }
      });

    });

  </script>
  <?php

	}
	
		
}