<?php

class TaskStatus {
    private const TaskStatusFieldName = 'task_status';

	static function getStatus( $object, $field_name, $request ): string {
        return get_field( $field_name, $object['id'] ) ?? '';
    }

    /**
     * If outcome is not empty, change the task_status to "Completed"
     *
     * @param $post
     * @param $request
     * @return void
     */
    static function changeStatus( $post, $request ): void {
        error_log( 'changing status');
        $outcome = get_field( 'taskbook_outcome', $post->ID );

        if ( strlen($outcome) > 0 ) {
            update_field( self::TaskStatusFieldName, 'Completed', $post->ID );
            return;
        }

        update_post_meta( $post->ID, self::TaskStatusFieldName, 'In progress' );
    }

    static function displayStatusValue( $field ) {
        if ( self::TaskStatusFieldName === $field['name'] ) {
            $value = get_field( self::TaskStatusFieldName, get_the_ID() );
            $field['value'] = $value;
        }

        return $field;
    }
}
