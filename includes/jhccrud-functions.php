<?php

/**
 * Get all jhccrud
 *
 * @param $args array
 *
 * @return array
 */
function jhc_get_all_jhccrud( $args = array() ) {
    global $wpdb;

    $defaults = array(
        'number'     => 20,
        'offset'     => 0,
        'orderby'    => 'id',
        'order'      => 'ASC',
    );

    $args      = wp_parse_args( $args, $defaults );
    $cache_key = 'jhccrud-all';
    $items     = wp_cache_get( $cache_key, 'wedevs' );

    if ( false === $items ) {
        $items = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'imei ORDER BY ' . $args['orderby'] .' ' . $args['order'] .' LIMIT ' . $args['offset'] . ', ' . $args['number'] );

        wp_cache_set( $cache_key, $items, 'wedevs' );
    }

    return $items;
}

/**
 * Fetch all jhccrud from database
 *
 * @return array
 */
function jhc_get_jhccrud_count() {
    global $wpdb;

    return (int) $wpdb->get_var( 'SELECT COUNT(*) FROM ' . $wpdb->prefix . 'imei' );
}

/**
 * Fetch a single jhccrud from database
 *
 * @param int   $id
 *
 * @return array
 */
function jhc_get_jhccrud( $id = 0 ) {
    global $wpdb;

    return $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->prefix . 'imei WHERE id = %d', $id ) );
}
/**
 * Insert a new jhccruds
 *
 * @param array $args
 */
function wd_insert_jhccruds( $args = array() ) {
    global $wpdb;

    $defaults = array(
        'id' => '',
        'imei' => '',
        'branch' => '',
        'status' => '',

    );

    $args       = wp_parse_args( $args, $defaults );
    $table_name = $wpdb->prefix . 'imei';

    // some basic validation
    if ( empty( $args['imei'] ) ) {
        return new WP_Error( 'no-imei', __( 'No IMEI provided.', 'wedevs' ) );
    }
    if ( empty( $args['branch'] ) ) {
        return new WP_Error( 'no-branch', __( 'No Branch provided.', 'wedevs' ) );
    }
    if ( empty( $args['status'] ) ) {
        return new WP_Error( 'no-status', __( 'No Status provided.', 'wedevs' ) );
    }

    // remove row id to determine if new or update
    $row_id = (int) $args['id'];
    unset( $args['id'] );

    if ( ! $row_id ) {

        

        // insert a new
        if ( $wpdb->insert( $table_name, $args ) ) {
            return $wpdb->insert_id;
        }

    } else {

        // do update method here
        if ( $wpdb->update( $table_name, $args, array( 'id' => $row_id ) ) ) {
            return $row_id;
        }
    }

    return false;
}