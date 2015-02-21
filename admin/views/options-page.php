<div class="wrap">

	<h2>Formation Plugin Options</h2>
	
    <p>I've packaged all the Formation Plugin features as one plugin but you may not need everything that comes with it so through this screen you are able to toggle the features that you need and don't need.</p>
          
    <form method="post" action="options.php"> 
    	
        <?php settings_fields( 'formation-plugin-options' ); ?>                
        
        <h3 class="title">Features</h3>
        <?php $this->options["features"] = get_option( 'formation-plugin-features' ); ?>                
        <table class="form-table permalink-structure">
            <tbody>
                <tr>                	
                    <th>
                    	<label><input name="formation-plugin-features[google_analytics]" <?php echo ( isset( $this->options["features"]["google_analytics"] ) ) ? 'checked="checked"' : ''; ?> type="checkbox"> Google Analytics</label>
                    </th>
                    <td><input type="text" name="formation-plugin-features[google_analytics_id]" placeholder="Google Analytics Account #" value="<?php echo ( isset( $this->options["features"]["google_analytics_id"] ) ) ? $this->options["features"]["google_analytics_id"] : ''; ?>" ></td>
                </tr>
                <!--
                ## Paralax galleries coming soon!
                <tr>                	
                    <th>
                    	<label><input name="formation-plugin-features[paralax_galleries]" <?php echo ( isset( $this->options["features"]["paralax_galleries"] ) ) ? 'checked="checked"' : ''; ?> type="checkbox"> Paralax Galleries</label>
                    </th>
                    <td>Allows for paralax image galleries..</td>
                </tr>
                -->                     
            </tbody>
        </table>
        <br><br>
		<h3 class="title">Widgets</h3>
        <?php $this->options["widgets"] = get_option( 'formation-plugin-widgets' ); ?>                
        <table class="form-table permalink-structure">
            <tbody>
                <tr>                	
                    <th>
                    	<label><input name="formation-plugin-widgets[image_slider]" <?php echo ( isset( $this->options["widgets"]["image_slider"] ) ) ? 'checked="checked"' : ''; ?> type="checkbox"> Image Slider</label>
                    </th>
                    <td>Just a simple little image slider widget.</td>
                </tr>
                <tr>
                    <th>
                    	<label><input name="formation-plugin-widgets[contact_form]" <?php echo ( isset( $this->options["widgets"]["contact_form"] ) ) ? 'checked="checked"' : ''; ?> type="checkbox"> Contact Form</label>
                    </th>
                    <td>A cool little widget that allows you to add a contact form to any sidebar area.</td>
                </tr>
                <tr>
                    <th>
                    	<label><input name="formation-plugin-widgets[latest_posts]" <?php echo ( isset( $this->options["widgets"]["latest_posts"] ) ) ? 'checked="checked"' : ''; ?> type="checkbox"> Latest Posts</label>
                    </th>
                    <td>Let's you display a certain amount of the latest posts from specific categories.</td>
                </tr>
                <tr>
                    <th>
                    	<label><input name="formation-plugin-widgets[social_media]" <?php echo ( isset( $this->options["widgets"]["social_media"] ) ) ? 'checked="checked"' : ''; ?> type="checkbox"> Social Media</label>
                    </th>
                    <td>Social Media links on any page you like. Hmmmmmm.</td>
                </tr>      
            </tbody>
        </table>
		
		
		<?php submit_button(); ?>
        
    </form>

</div>