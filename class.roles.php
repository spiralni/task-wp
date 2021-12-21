<?php

class Roles {
    const TASK_LOGGER_ROLE = 'task_logger';

	public static function registerRoles() {
        add_role( self::TASK_LOGGER_ROLE, 'Task Logger' );

        $roles = [ 'administrator', self::TASK_LOGGER_ROLE ];

        foreach ( $roles as $role ) {
            $wp_role = get_role( $role );

            $wp_role->add_cap( 'read' );
            $wp_role->add_cap( 'edit_tasks' );
            $wp_role->add_cap( 'publish_tasks' );
            $wp_role->add_cap( 'edit_published_tasks' );

            if ( 'administrator' === $role ) {
                $wp_role->add_cap( 'read_private_tasks' );
                $wp_role->add_cap( 'edit_other_tasks' );
                $wp_role->add_cap( 'edit_private_tasks' );
                $wp_role->add_cap( 'delete_tasks' );
                $wp_role->add_cap( 'delete_published_tasks' );
                $wp_role->add_cap( 'delete_other_tasks' );
                $wp_role->add_cap( 'delete_private_tasks' );
            }
        }
    }

    public static final function unregisterRoles() {
        remove_role( self::TASK_LOGGER_ROLE );

        $wp_role = get_role( 'administrator' );

        $wp_role->remove_cap( 'read' );
        $wp_role->remove_cap( 'edit_tasks' );
        $wp_role->remove_cap( 'publish_tasks' );
        $wp_role->remove_cap( 'edit_published_tasks' );
        $wp_role->remove_cap( 'read_private_tasks' );
        $wp_role->remove_cap( 'edit_other_tasks' );
        $wp_role->remove_cap( 'edit_private_tasks' );
        $wp_role->remove_cap( 'delete_tasks' );
        $wp_role->remove_cap( 'delete_published_tasks' );
        $wp_role->remove_cap( 'delete_other_tasks' );
        $wp_role->remove_cap( 'delete_private_tasks' );
    }
}
