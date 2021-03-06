<?php

/*---------------------------------------------------------------
	META BOXES -- STAFF
---------------------------------------------------------------*/


class Staff_Metabox {

    public function init() {
		add_action( 'add_meta_boxes', array( $this, 'staff_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
	}

	/*-- Register Meta Box --*/
	public function staff_meta_boxes() {
		add_meta_box(
			'staff_title',
			'Staff Member Information',
			array( $this, 'render_meta_boxes' ),
			'staff',
			'normal',
			'high'
		);
	}

    /*-- Render Meta Box --*/
	function render_meta_boxes( $post ) {

		$meta = get_post_custom( $post->ID );
		$staff_title = ! isset( $meta['staff_title'][0] ) ? '' : $meta['staff_title'][0];
	    $display_on_front_page = ! isset( $meta['display_on_front_page'][0] ) ? '' : $meta['display_on_front_page'][0];

		wp_nonce_field( basename( __FILE__ ), 'staff_fields' ); ?>

		<table class="form-table">

			<tr>
				<td>
                    <label style="font-weight: bold; display: block; padding-bottom: 8px;" for="customer_url">
 					   Staff Title
 				   </label>
					<input style="width: 100%; box-sizing: border-box;" type="text" name="staff_title" value="<?php echo $staff_title; ?>">
					<p class="description" style="padding-bottom: 24px; opacity: 0.5;">E.g. CEO, Sales Lead, Designer</p>
                    <label for="display_on_front_page">
 					   <input name="display_on_front_page" type="checkbox" id="display_on_front_page" <?php echo ( $display_on_front_page == true ? ' checked="checked"' : '') ?>>
 					   Display on Team Page
 				   </label>
				</td>
			</tr>

		</table>

	<?php }

    /*-- Save Meta Box --*/
	function save_meta_boxes( $post_id ) {

		global $post;

		// Verify nonce
		if ( !isset( $_POST['staff_fields'] ) || !wp_verify_nonce( $_POST['staff_fields'], basename(__FILE__) ) ) {
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

		$meta['staff_title'] = ( isset( $_POST['staff_title'] ) ? esc_textarea( $_POST['staff_title'] ) : '' );
 	    $meta['display_on_front_page'] = ( isset( $_POST['display_on_front_page'] ) ? $_POST['display_on_front_page'] : '' );

		foreach ( $meta as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}

}


$staff_metaboxes = new Staff_Metabox;
$staff_metaboxes->init();

?>
