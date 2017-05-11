<?php
/**
 * Team Post Type
 *
 * @package   Team_Post_Type
 * @license   GPL-2.0+
 */


class Post_Metaboxes {

    public function init() {
		add_action( 'add_meta_boxes', array( $this, 'post_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
	}

    /*-- Register Meta Box --*/
	public function post_meta_boxes() {
		add_meta_box(
			'post_author',
			'Post Author',
			array( $this, 'render_meta_boxes' ),
			'post',
			'side',
			'high'
		);
	}

/**
	* The HTML for the fields
	*
	* @since 0.1.0
	*/
	function render_meta_boxes( $post ) {

		$meta = get_post_custom( $post->ID );
		$post_author = ! isset( $meta['post_author'][0] ) ? '' : $meta['post_author'][0];

		wp_nonce_field( basename( __FILE__ ), 'staff_fields' ); ?>

		<table class="form-table">

			<tr>
				<td>
					<input style="width: 100%; box-sizing: border-box;" type="text" name="post_author" value="<?php echo $post_author; ?>">
					<p class="description">E.g. CEO, Sales Lead, Designer</p>
				</td>
			</tr>

		</table>

	<?php }

 /*-- Save Meta Boxes --*/

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

		$meta['post_author'] = 'fugly'; //( isset( $_POST['post_author'] ) ? esc_textarea( $_POST['post_author'] ) : '' );

		foreach ( $meta as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}

}




class Staff_Metabox {

    public function init() {
		add_action( 'add_meta_boxes', array( $this, 'staff_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
	}

	/*-- Register Meta Box --*/
	public function staff_meta_boxes() {
		add_meta_box(
			'staff_title',
			'Staff Member Title',
			array( $this, 'render_meta_boxes' ),
			'staff',
			'normal',
			'high'
		);
	}

   /**
	* The HTML for the fields
	*
	* @since 0.1.0
	*/
	function render_meta_boxes( $post ) {

		$meta = get_post_custom( $post->ID );
		$staff_title = ! isset( $meta['staff_title'][0] ) ? '' : $meta['staff_title'][0];

		wp_nonce_field( basename( __FILE__ ), 'staff_fields' ); ?>

		<table class="form-table">

			<tr>
				<td>
					<input style="width: 100%; box-sizing: border-box;" type="text" name="staff_title" value="<?php echo $staff_title; ?>">
					<p class="description">E.g. CEO, Sales Lead, Designer</p>
				</td>
			</tr>

		</table>

	<?php }

    /*-- Save Meta Boxes --*/

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

		foreach ( $meta as $key => $value ) {
			update_post_meta( $post->ID, $key, $value );
		}
	}

}


$post_type_metaboxes = new Post_Metaboxes;
$post_type_metaboxes->init();
$post_type_metaboxes = new Staff_Metabox;
$post_type_metaboxes->init();

?>
