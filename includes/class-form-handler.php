<?php

/**
 * Handle the form submissions
 *
 * @package Package
 * @subpackage Sub Package
 */
class Form_Handler {

    /**
     * Hook 'em all
     */
    public function __construct() {
        add_action( 'admin_init', array( $this, 'handle_form' ) );
    }

    /**
     * Handle the jhccruds new and edit form
     *
     * @return void
     */
    public function handle_form() {
        if ( ! isset( $_POST['submit_transaction'] ) ) {
            return;
        }

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'lorem' ) ) {
            die( __( 'Are you cheating?', 'wedevs' ) );
        }

        if ( ! current_user_can( 'read' ) ) {
            wp_die( __( 'Permission Denied!', 'wedevs' ) );
        }

        $errors   = array();
        $page_url = admin_url( 'admin.php?page=jhccrud-page' );
        $field_id = isset( $_POST['field_id'] ) ? intval( $_POST['field_id'] ) : 0;

        $imei = isset( $_POST['imei'] ) ? intval( $_POST['imei'] ) : 0;
        $branch = isset( $_POST['branch'] ) ? sanitize_text_field( $_POST['branch'] ) : '';
        $status = isset( $_POST['status'] ) ? sanitize_text_field( $_POST['status'] ) : '';

        // some basic validation
        if ( ! $imei ) {
            $errors[] = __( 'Error: IMEI is required', 'wedevs' );
        }

        if ( ! $branch ) {
            $errors[] = __( 'Error: Branch is required', 'wedevs' );
        }

        if ( ! $status ) {
            $errors[] = __( 'Error: Status is required', 'wedevs' );
        }

        // bail out if error found
        if ( $errors ) {
            $first_error = reset( $errors );
            $redirect_to = add_query_arg( array( 'error' => $first_error ), $page_url );
            wp_safe_redirect( $redirect_to );
            exit;
        }

        $fields = array(
            'id' => null,
            'imei' => $imei,
            'branch' => $branch,
            'status' => $status,
        );

        // New or edit?
        if ( ! $field_id ) {

            $insert_id = wd_insert_jhccruds( $fields );

        } else {

            $fields['id'] = $field_id;

            $insert_id = wd_insert_jhccruds( $fields );
        }

        if ( is_wp_error( $insert_id ) ) {
            $redirect_to = add_query_arg( array( 'message' => 'error' ), $page_url );
        } else {
            $redirect_to = add_query_arg( array( 'message' => 'success' ), $page_url );
        }

        wp_safe_redirect( $redirect_to );
        exit;
    }
}

new Form_Handler();