<?php
/**
 * Team Post Type
 *
 * @package   Team_Post_Type
 * @license   GPL-2.0+
 */


 class Page_Metaboxes {

     public function init() {
 		add_action( 'add_meta_boxes', array( $this, 'staff_meta_boxes' ) );
 		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
 	}

 	/*-- Register Meta Box --*/
 	public function staff_meta_boxes() {
 		add_meta_box(
 			'alternative_title',
 			'Alternative Title',
 			array( $this, 'render_meta_boxes' ),
 			'page',
 			'side',
 			'low'
 		);
 	}

     /*-- Render Meta Box --*/
 	function render_meta_boxes( $post ) {

 		$meta = get_post_custom( $post->ID );
 		$alternative_title = ! isset( $meta['alternative_title'][0] ) ? '' : $meta['alternative_title'][0];

 		wp_nonce_field( basename( __FILE__ ), 'page_fields' ); ?>

 		<table class="form-table">

 			<tr>
 				<td>
					<input style="width: 100%; box-sizing: border-box;" type="text" name="alternative_title" value="<?php echo $alternative_title; ?>">
 				</td>
 			</tr>

 		</table>

 	<?php }

     /*-- Save Meta Box --*/
 	function save_meta_boxes( $post_id ) {

 		global $post;

 		// Verify nonce
 		if ( !isset( $_POST['page_fields'] ) || !wp_verify_nonce( $_POST['page_fields'], basename(__FILE__) ) ) {
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

 		$meta['alternative_title'] = ( isset( $_POST['alternative_title'] ) ? esc_textarea( $_POST['alternative_title'] ) : '' );

 		foreach ( $meta as $key => $value ) {
 			update_post_meta( $post->ID, $key, $value );
 		}
 	}

 }

$post_metaboxes = new Page_Metaboxes;
$post_metaboxes->init();

?>
