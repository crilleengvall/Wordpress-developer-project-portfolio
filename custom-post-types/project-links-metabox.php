<?php

function dpp_project_links_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function dpp_project_links_add_meta_box() {
	add_meta_box(
		'project_links-project-links',
		__( 'Project links', 'project_links' ),
		'dpp_project_links_html',
		'dpp_project',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'dpp_project_links_add_meta_box' );

function dpp_project_links_html( $post) {
	wp_nonce_field( '_project_links_nonce', 'project_links_nonce' ); ?>
	<p>
		<label for="project_links_project_url"><?php _e( 'Project url', 'project_links' ); ?></label><br>
		<input type="text" name="project_links_project_url" id="project_links_project_url" value="<?php echo dpp_project_links_get_meta( 'project_links_project_url' ); ?>">
	</p><?php
}

function dpp_project_links_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['project_links_nonce'] ) || ! wp_verify_nonce( $_POST['project_links_nonce'], '_project_links_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['project_links_project_url'] ) )
		update_post_meta( $post_id, 'project_links_project_url', esc_attr( $_POST['project_links_project_url'] ) );
}
add_action( 'save_post', 'dpp_project_links_save' );

/*
	Usage: dpp_project_links_get_meta( 'project_links_project_url' )
*/
