<?php

function dpp_project_information_get_meta( $value, $id = NULL ) {
	global $post;
	$post_id = $post->ID;
	if(is_null($id) == false) {
		$post_id = $id;
	}
	$field = get_post_meta( $post_id, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function dpp_project_information_add_meta_box() {
	add_meta_box(
		'project_information-project-information',
		__( 'Project information', 'developer-project-portfolio' ),
		'dpp_project_information_html',
		'dpp_project',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'dpp_project_information_add_meta_box' );

function dpp_project_information_html( $post) {
	wp_nonce_field( '_project_information_nonce', 'project_information_nonce' ); ?>

	<p>
		<label for="project_information_project_url"><?php _e( 'Project url', 'developer-project-portfolio' ); ?></label><br>
		<input type="text" name="project_information_project_url" id="project_information_project_url" value="<?php echo dpp_project_information_get_meta( 'project_information_project_url' ); ?>">
	</p>	<p>
		<label for="project_information_short_description"><?php _e( 'Short description', 'developer-project-portfolio' ); ?></label><br>
		<input type="text" name="project_information_short_description" id="project_information_short_description" value="<?php echo dpp_project_information_get_meta( 'project_information_short_description' ); ?>">
	</p><?php
}

function dpp_project_information_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['project_information_nonce'] ) || ! wp_verify_nonce( $_POST['project_information_nonce'], '_project_information_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['project_information_project_url'] ) )
		update_post_meta( $post_id, 'project_information_project_url', esc_attr( $_POST['project_information_project_url'] ) );
	if ( isset( $_POST['project_information_short_description'] ) )
		update_post_meta( $post_id, 'project_information_short_description', esc_attr( $_POST['project_information_short_description'] ) );
}
add_action( 'save_post', 'dpp_project_information_save' );

function dpp_project_information_get_the_terms($post_id, $taxonomy_name) {
	$term_names = '';
	$terms = get_the_terms($post_id, $taxonomy_name);
	if($terms) {
		foreach ($terms as $cat) {
			$term_names .= $cat->name . ', ';
		}
	}
	return substr($term_names, 0, strlen($term_names) - 2 );
}

function dpp_project_information_get_terms_and_icon($post_id, $taxonomy_name, $icon) {
	$terms = dpp_project_information_get_the_terms($post_id, $taxonomy_name);
	$html = '';
	if(strlen($terms) > 0) {
		$html = '<i class="fa fa-' . $icon . ' fa-2" aria-hidden="true"></i> ';
		$html .= $terms;
	}
	return $html;
}

/*
	Usage: dpp_project_information_get_meta( 'project_information_project_url' )
	Usage: dpp_project_information_get_meta( 'project_information_short_description' )
*/
