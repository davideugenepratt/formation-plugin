
<div class="formation_latest_posts_widget_container">
    <div class="formation_latest_posts_title" >
        <label for="<?php echo $this->get_field_name( 'title' ); ?>" >Widget Title:</label>
        <input class="formation_latest_posts_title widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
    </div>
    <div class="formation_latest_posts_number">
    	<label for="<?php echo $this->get_field_name( 'number' ); ?>" >Number of posts to display:</label>
        <input class="formation_latest_posts_number small-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'number' ] ); ?>">
    </div>
    <div class="formation_latest_posts_cats">
    	<!--
        <select class="formation_latest_posts_cats widefat" name="<?php echo $this->get_field_name( 'cats' ); ?>" id="<?php echo $this->get_field_id( 'cats' ); ?>" multiple >
        	<?php
			foreach ( $this->get_cat_tree() as $key => $cat ) {
				echo '<option value="'.$key.'" >'.$cat.'</option>';
			}
			?>
        </select>
        -->
        
        <table class="wp-list-table widefat fixed tags fields-table">
        	<thead>
            	<tr class="no-fields">
                	<th class="manage-column column-checkbox" style="width:20px;"></th>
                    <th class="manage-column column-category" >Category</th>         
                </tr>
            </thead>
            <tfoot>
            	<tr class="no-fields">
                	<th class="manage-column column-checkbox"  style="width:20px;" ></th>                    
                    <th class="manage-column column-category" >Category</th>        
                </tr>
            </tfoot>
            <tbody>
            <?php
			
			foreach ( $this->get_cat_tree() as $key => $cat ) {
				$checked = ( in_array( $key, $instance['cats'] ) ? 'checked="checked"' : '' );
				echo '<tr><td><input type="checkbox" name="'.$this->get_field_name( 'cats' ).'[]"  value="'.$key.'" id="'.$this->get_field_id( 'number' ).'-'.$key.'" '.$checked.' ></td><td class="label" ><label for="'.$this->get_field_id( 'number' ).'-'.$key.'" >'.$cat.'</label></td></tr>';
			}
			?> 
            </tbody>
       </table>                
    </div>
</div>
