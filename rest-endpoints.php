<?php

/**
 * Zume_Android_REST_Endpoints
 *
 * @class      Zume_Android_REST_Endpoints
 * @version    0.1.0
 * @since      0.1.0
 * @package    Zume
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Class Zume_Android_REST_Endpoints
 */
class Zume_Android_REST_Endpoints
{
    /**
     * Zume_Android_REST_Endpoints The single instance of Zume_Android_REST_Endpoints.
     *
     * @var     object
     * @access    private
     * @since     0.1.0
     */
    private static $_instance = null;

    /**
     * Main Zume_Android_REST_Endpoints Instance
     * Ensures only one instance of Zume_Android_REST_Endpoints is loaded or can be loaded.
     *
     * @since 0.1.0
     * @static
     * @return Zume_Android_REST_Endpoints instance
     */
    public static function instance()
    {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    } // End instance()

    /**
     * Constructor function.
     *
     * @access  public
     * @since   0.1.0
     */
    public function __construct()
    {
        add_action( 'rest_api_init', [ $this, 'add_api_routes' ] );
    } // End __construct()

    public function add_api_routes()
    {
        $namespace = 'zume/v1/android'; // The root 'zume' is used by other services, but the route base /android is dedicated to the app project.

        // Sample REST route.
        // @example '{your local server}/wp-json/zume/v1/android/user_profile/1'
        // This should return the full usermeta for the current user.
        // @use https://github.com/WP-API/Basic-Auth
        // @use https://www.getpostman.com
        register_rest_route(
            $namespace, '/user_profile/(?P<user_id>\d+)', [
                [
                    'methods'  => WP_REST_Server::READABLE,
                    'callback' => [ $this, 'user_profile' ],
                ],
            ]
        );

    }

    /**
     * Get user profile
     *
     * @param  WP_REST_Request $request
     *
     * @access public
     * @since  0.1.0
     * @return string|WP_Error|array The contact on success
     */
    public function user_profile( WP_REST_Request $request )
    {
        $params = $request->get_params();
        if ( isset( $params['user_id'] ) ) {
            $result = Zume_Android_App::user_profile( $params['user_id'] );
            if ( $result['status'] ) {
                return $result['data'];
            } else {
                return new WP_Error( "mark_viewed_processing_error", $result["message"], [ 'status' => 400 ] );
            }
        } else {
            return new WP_Error( "notification_param_error", "Please provide a valid array", [ 'status' => 400 ] );
        }
    }

}

class Zume_Android_App {

    /**
     * Zume_Android_App The single instance of Zume_Android_App.
     *
     * @var     object
     * @access    private
     * @since     0.1.0
     */
    private static $_instance = null;

    /**
     * Main Zume_Android_App Instance
     * Ensures only one instance of Zume_Android_App is loaded or can be loaded.
     *
     * @since 0.1.0
     * @static
     * @return Zume_Android_App instance
     */
    public static function instance()
    {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    } // End instance()

    public static function user_profile ( $user_id ) {

        /**
         * @todo validate user permission to information
         * @see https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/
         * This plugin provides a token exchange for the WP Rest API
         *
         * The REST API does not have an authentication system in place yet. Consider
         * https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/
         *
         * Tip: In local development, try https://github.com/WP-API/Basic-Auth to get authentication while developing.
         */
        $user_meta = get_user_meta( get_current_user_id() );

        return [
            'status' => true,
            'data' => $user_meta,
        ];
    }
}