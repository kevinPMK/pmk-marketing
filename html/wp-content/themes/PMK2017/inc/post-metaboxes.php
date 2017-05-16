<?php
/**
 * Team Post Type
 *
 * @package   Team_Post_Type
 * @license   GPL-2.0+
 */


 class Post_Metabox {

     public function init() {
 		add_action( 'add_meta_boxes', array( $this, 'staff_meta_boxes' ) );
 		add_action( 'save_post', array( $this, 'save_meta_boxes' ),  10, 2 );
 	}

 	/*-- Register Meta Box --*/
 	public function staff_meta_boxes() {
 		add_meta_box(
 			'custom_post_author',
 			'Post Author',
 			array( $this, 'render_meta_boxes' ),
 			'post',
 			'side',
 			'low'
 		);
 	}

     /*-- Render Meta Box --*/
 	function render_meta_boxes( $post ) {

 		$meta = get_post_custom( $post->ID );
 		$custom_post_author = ! isset( $meta['custom_post_author'][0] ) ? '' : $meta['custom_post_author'][0];

 		wp_nonce_field( basename( __FILE__ ), 'staff_fields' ); ?>

 		<table class="form-table">

 			<tr>
 				<td>
                    <select name="custom_post_author" id="custom_post_author" style="width: 100%;">

                        <option value="PikMyKid">
                            PikMyKid
                        </option>

                        <?php

                            $loop = new WP_Query( array( 'post_type' => 'staff', 'posts_per_page' => -1 ) );
                            while ( $loop->have_posts() ) : $loop->the_post();

                            $custom_post_id = get_the_ID();

                        ?>

                        <option value="<?php echo $custom_post_id; ?>" <?php selected( $custom_post_author, $custom_post_id ); ?>>
                            <?php echo get_the_title(); ?>
                        </option>

                        <?php
                            endwhile;
                            wp_reset_query();
                        ?>

                    </select>
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

 		$meta['custom_post_author'] = ( isset( $_POST['custom_post_author'] ) ? esc_textarea( $_POST['custom_post_author'] ) : '' );

 		foreach ( $meta as $key => $value ) {
 			update_post_meta( $post->ID, $key, $value );
 		}
 	}

 }

$post_metaboxes = new Post_Metabox;
$post_metaboxes->init();

?>
