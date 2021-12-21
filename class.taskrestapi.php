<?php

class TaskRestAPI {
    public static function registerStatusField() {
        register_rest_field(
            'task',
            'task_status',
            [
                'get_callback' => [ 'TaskStatus', 'getStatus' ],
                'schema' => null
            ]
        );
    }

    public static function grantAccess( $query ) {
        $isRestRequest = defined('REST_REQUEST' ) && REST_REQUEST;

        if ( !$isRestRequest ) {
            return;
        }

        $isTaskPostType = isset( $query->query_vars['post_type'] ) &&
            $query->query_vars['post_type'] === 'task';

        if ( !$isTaskPostType ) {
            return;
        }

        if ( current_user_can( 'administrator' ) ) {
            $query->set( 'post_status', 'private' );
            return;
        }

        if ( current_user_can( 'task_logger' ) ) {
            $query->set( 'post_status', 'private' );
            $query->set( 'author', get_current_user_id() );
        }
    }
}
