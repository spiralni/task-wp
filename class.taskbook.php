<?php

class TaskBook {
    private static bool $initiated = false;

    public static function init() {
        if ( ! self::$initiated ) {
            self::initHooks();
        }
    }

    private static function initHooks() {
        self::$initiated = true;

        add_action( 'rest_api_init', [ 'TaskRestAPI', 'registerStatusField' ] );
        add_action( 'rest_after_insert_task', [ 'TaskStatus', 'changeStatus' ], 10, 2 );
        add_action( 'pre_get_posts', [ 'TaskRestAPI', 'grantAccess' ] );
        add_filter( 'acf/load_field', [ 'TaskStatus' ,'displayStatusValue' ] );
    }

    public static function onPluginActivated() {
        Roles::registerRoles();
    }

    public static function onPluginDeactivated() {
        Roles::unregisterRoles();
    }
}
