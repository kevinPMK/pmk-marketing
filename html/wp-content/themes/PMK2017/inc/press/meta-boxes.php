<?php

/*---------------------------------------------------------------
	META BOXES -- PRESS
---------------------------------------------------------------*/


class Press_Meta_Boxes {

	public function init() {
	   add_action( 'add_meta_boxes', array( $this, 'press_meta_box' ) );
	   add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
   }

   /*-- Register Meta Box --*/
   public function press_meta_box() {
	   add_meta_box(
		   'press_meta',
		   'Press Information',
		   array( $this, 'render_press_meta_box' ),
		   'press',
		   'normal',
		   'low'
	   );
   }

	/*-- Render Meta Box --*/
   function render_press_meta_box( $post ) {

	   $meta = get_post_custom( $post->ID );
	   $press_url = ! isset( $meta['press_url'][0] ) ? '' : $meta['press_url'][0];
	   $press_syndicate = ! isset( $meta['press_syndicate'][0] ) ? '' : $meta['press_syndicate'][0];
	   $display_on_front_page = ! isset( $meta['display_on_front_page'][0] ) ? '' : $meta['display_on_front_page'][0];

	   wp_nonce_field( basename( __FILE__ ), 'press_fields' ); ?>

	   <table class="form-table">

		   <tr>
			    <td>
					<label style="font-weight: bold; display: block; padding-bottom: 8px;" for="press_syndicate">
 						Syndicate Name
					</label>
					<input style="width: 100%; box-sizing: border-box;" type="text" name="press_syndicate" value="<?php echo $press_syndicate; ?>">
			    </td>
		   </tr>
		   <tr>
			    <td>
 					<label style="font-weight: bold; display: block; padding-bottom: 8px;" for="press_url">
 						External Url
 					</label>
					<input style="width: 100%; box-sizing: border-box;" type="text" name="press_url" value="<?php echo $press_url; ?>">
					<p class="description">Please include the entire URL. Ex: (http://www.website.com)</p>
					<div style="font-weight: bold; display: block; padding-bottom: 8px; margin-top: 24px;" for="customer_url">
 					   Display Settings
 				   </div>
 				   <label for="display_on_front_page">
 					   <input name="display_on_front_page" type="checkbox" id="display_on_front_page" <?php echo ( $display_on_front_page == true ? ' checked="checked"' : '') ?>>
 					   Display on Front Page
 				   </label>
			    </td>
		   </tr>

	   </table>

   <?php }

	/*-- Save Meta Box --*/
   function save_meta_boxes( $post_id ) {

	   global $post;

	   // Verify nonce
	   if ( !isset( $_POST['press_fields'] ) || !wp_verify_nonce( $_POST['press_fields'], basename(__FILE__) ) ) {
		   return $post_id;
	   }

	   // Check Autosave
	   if ( (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || ( defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']) ) {
		   return $post_id;
	   }

	   // Don't save if only a revision
	   if ( isset( $post->post_type ) && $post->post_type == 'revision' ) {
		   return $post_id;
	   }

	   // Check permissions
	   if ( !current_user_can( 'edit_post', $post->ID ) ) {
		   return $post_id;
	   }

	   $meta['press_url'] = ( isset( $_POST['press_url'] ) ? esc_textarea( $_POST['press_url'] ) : '' );
	   $meta['press_syndicate'] = ( isset( $_POST['press_syndicate'] ) ? esc_textarea( $_POST['press_syndicate'] ) : '' );
	   $meta['display_on_front_page'] = ( isset( $_POST['display_on_front_page'] ) ? $_POST['display_on_front_page'] : '' );

	   foreach ( $meta as $key => $value ) {
		   update_post_meta( $post->ID, $key, $value );
	   }
   }
}

$press_metaboxes = new Press_Meta_Boxes;
$press_metaboxes->init();

?>
