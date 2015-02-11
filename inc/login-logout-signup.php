<?php

/* LOGIN
===================================================================================== */

function hb_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/widget-logo.png);
            padding-bottom: 0;
        }

        a:active,
        a:hover,
        .login #backtoblog a:hover,
        .login #nav a:hover,
        .login h1 a:hover {
            color: #ED6F5D;
        }

        .login form {
            margin-top: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
            padding: 21px;
        }

        .login #login_error {
            border: none;
            -webkit-box-shadow: none;
            box-shadow: none;
            background: #ED6F5D;
            color: #FFF;
        }

        .login #login_error * {
            color: inherit;
        }

        .login .message {
            border: none;
            -webkit-box-shadow: none;
            box-shadow: none;
            background: #333E44;
            color: #FFF;
        }

        .login .message * {
            color: inherit;
        }

        p.forgetmenot {
            display: none;
        }

        input#wp-submit {
            border: 1px solid #505C64;
            border-radius: 3px;
            height: 3.125rem;
            box-shadow: none;
            min-width: 7.500rem;
            font-size: 0.750rem;
            text-transform: uppercase;
            line-height: 3rem;
            color: #ED6F5D;
            border-color: #ED6F5D;
            padding: 0 1em;
            background: #FFF;
            border-width: 1px;
        }

        input#wp-submit:hover {
            color: #FFF;
            background: #ED6F5D;
        }

        .login form .input,
        .login input[type=text] {
            font-size: 14px;
            padding: 0 0.750rem;
            color: #505C64;
            border: 1px solid #505C64;
            border-radius: 3px;
            height: 3.125rem;
            line-height: 3.000rem;
            box-shadow: none;
            font-weight: 500;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'hb_login_logo' );

function hb_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'hb_login_logo_url' );

function hb_login_logo_url_title() {
    return ' ';
}
add_filter( 'login_headertitle', 'hb_login_logo_url_title' );

/**
 * Returns the Log In URL.
 *
 * Returns the URL that allows the user to log in to the site.
 *
 * @since 2.7.0
 * @uses site_url() To generate the log in URL.
 * @uses apply_filters() calls 'login_url' hook on final login URL.
 *
 * @param string $redirect Path to redirect to on login.
 * @param bool $force_reauth Whether to force reauthorization, even if a cookie is present. Default is false.
 * @return string A log in URL.
 */
function hb_login_url($login_url = '', $redirect = '') {

	$login_url = site_url('/login/', 'login');

	if ( !empty($redirect) )

		$login_url = add_query_arg('redirect_to', urlencode($redirect), $login_url);

	return $login_url;
}
add_filter('login_url', 'hb_login_url', 99, 2);

function hb_register_url( $register_url ) {
    return site_url( '/register/' );
}
add_filter( 'register_url', 'hb_register_url' );

/**
 *
 *
 */
function hb_login_content( $content ) { 

    if ( is_page('login')) {

    	ob_start();

    		get_template_part('/temp/login', 'form');

        	$content = ob_get_contents();

        ob_end_clean();
	}
    return $content;
}
add_filter( 'the_content', 'hb_login_content' ); 

/**
 *
 *
 */
function hb_wp_login_redirect() {

  global $pagenow;

  if ( $pagenow == 'wp-login.php' ) {

    $action = empty($_POST) ? 'empty-post' : false; 

    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : $action; /// TODO: look after this

    $action = isset($_REQUEST['loggedout']) ? 'loggedout' : $action;

    // r($action);

    switch ($action) {

        case 'logout':

            wp_logout();

            $redirect_to = !empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : 'login?loggedout=true';
            wp_safe_redirect( $redirect_to );
            exit();

            break;


        case 'loggedout':

            $redirect_to = !empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : 'login?loggedout=true';
            wp_safe_redirect( $redirect_to );
            exit();

            break;

        case 'empty-post':

            wp_safe_redirect( 'login' );
            exit();

            break;
    }
  }
}
add_action('init', 'hb_wp_login_redirect');


/* SIGN UP
===================================================================================== */

/**
 *
 *
 */
function hb_add_placeholder($elements){
    $elements['placeholder'] = bp_get_the_profile_field_name();

    return $elements;
}
add_filter('bp_xprofile_field_edit_html_elements','hb_add_placeholder', 99, 1);


/**
 *
 *
 */
function hb_core_validate_user_signup( $result ){

    // filter to validate whole signup form
    $errors = new WP_Error();

    if ( isset($result['errors'])
        && is_wp_error($result['errors']) ){

        // cleanup bp default crazy validation
        $user_errors = $result['errors']->get_error_code('user_name');

        if ( !empty( $user_errors ) 
            && validate_username( $result['user_name'] )
            && ! username_exists( $result['user_name'] ) )

            $result['errors']->remove( 'user_name');

        // validate email address 
        $email_errors = $result['errors']->get_error_code('user_email');

        if ( empty($email_errors)
            && $result['user_name'] != $result['user_email'] )

            $result['errors']->add( 'user_email', __('Email addresses are not match.', 'buddypress') );
    }

    if ( ! is_email( $result['user_name'] ) )

        $result['errors']->add( 'user_name', __('Please check your email address.', 'buddypress') );

    return $result;
}
add_filter('bp_core_validate_user_signup', 'hb_core_validate_user_signup', 98, 1);


function hb_inline_signup_username_errors(){

    if ( !isset($_REQUEST['su']) || empty($_REQUEST['su']) || ! username_exists($_REQUEST['su']) ) return;

    echo sprintf('<div class="error">%s</div>', __('Sorry, that email address is already used!', 'buddypress'));
}
add_action('bp_signup_username_errors', 'hb_inline_signup_username_errors');

/* Disable Activation Email
===================================================================================== 

// Change the text on the signup page
add_filter( 'bp_registration_needs_activation', '__return_false' );

function hb_disable_activation( $user, $user_email, $key, $meta = ” ) {
// Activate the user
bp_core_activate_signup( $key );

    // Return false so no email sent
    return false;
}
add_filter( 'wpmu_signup_user_notification', 'hb_disable_activation', 10, 4 );

//Disable new blog notification email for multisite
remove_filter( 'wpmu_signup_blog_notification', 'bp_core_activation_signup_blog_notification', 1, 7 );
add_filter( 'wpmu_signup_blog_notification', '__return_false' );

// disable sending activation emails for multisite
remove_filter( 'wpmu_signup_user_notification', 'bp_core_activation_signup_user_notification', 1, 4 );
add_filter( 'wpmu_signup_user_notification', '__return_false', 1, 4 );*/


/* FACEBOOK LOGIN
===================================================================================== */

function hb_facebook_user_login(){

    if ( ! wp_verify_nonce( $_POST['nonce'], 'hb-ajax' ) ) die ( 'Forbidden!');

    if ( !isset($_POST['user']) || !is_array($_POST['user']) || empty($_POST['user']) ) die ( '404' ); // do nothing!

    $user = $_POST['user'];

    if ( !isset($user['email']) || empty($user['email']) ) die( '301' ); // redirect user to register page

    if ( username_exists($user['email']) ){

        $registered_user = get_user_by('login', $user['email'] );

        // Redirect URL //
        if ( !is_wp_error( $registered_user ) )
        {
            wp_clear_auth_cookie();
            wp_set_current_user ( $registered_user->ID );
            wp_set_auth_cookie  ( $registered_user->ID );

            die( '202' ); // accepted
        }

    } else {

        $user_id = register_new_user( $user['email'], $user['email'] );

        if( ! is_wp_error($user_id) ) {

            $userdata = array(

                'ID'            => $user_id,
                'user_url'      => isset($user['link']) ? $user['link'] : '',
                'display_name'  => isset($user['name']) ? $user['name'] : '',
                'nickname'      => isset($user['name']) ? $user['name'] : '',
                'field_1'       => isset($user['name']) ? $user['name'] : '',
                'first_name'    => isset($user['first_name']) ? $user['first_name']: '',
                'last_name'     => isset($user['last_name']) ? $user['last_name'] : '',
            );

            foreach ($userdata as $key => $value)

                if ( ! $value ) unset($userdata[$key]);

            wp_update_user( $userdata );

            if ( bp_is_active( 'activity' ) && bp_is_active( 'xprofile' ) ) {
                bp_activity_add( array(
                    'user_id'   => $user_id,
                    'component' => 'xprofile',
                    'type'      => 'new_member'
                ) );
            }

            wp_clear_auth_cookie();
            wp_set_current_user ( $user_id );
            wp_set_auth_cookie  ( $user_id );

            die( '201' ); // created
        }
    }

    die ( '503' ); // sth went wrong
}
add_action( 'wp_ajax_facebook_user_login', 'hb_facebook_user_login' );
add_action( 'wp_ajax_nopriv_facebook_user_login', 'hb_facebook_user_login' );


function hb_print_facebook_login_script(){

    if ( get_current_user_id() ) return;

    ?>
    <div id="fb-root"></div>
    <script id="hb-fb-script" type="text/javascript">
        jQuery(document).ready(function($){

            (function(d, s, id){
                 var js, fjs = d.getElementsByTagName(s)[0];
                 if (d.getElementById(id)) {return;}
                 js = d.createElement(s); js.id = id;
                 js.src = "//connect.facebook.net/en_US/sdk.js";
                 fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            var get_login_process = false;
            function get_login( user ){

                if ( ! get_login_process ){ get_login_process = true;

                    var $redirect = null;

                    $.ajax({
                        type        : 'POST',
                        dataType    : 'html',
                        url         : detect.ajaxurl,
                        data        : { 
                                    action  : 'facebook_user_login',
                                    nonce   : detect.nonce,
                                    user    : user
                        },

                        success     : function( response ) {
                            
                            get_login_process = false;

                            switch (response){

                                case '201':

                                    $redirect = page.edit;
                                    break;

                                case '202':

                                    $redirect = page.profile;
                                    break;

                                case '301':

                                    $redirect = page.register + '?f1=' + user.name;
                                    break;

                                case '503':

                                    $('<div id="error-503">' + error.fb_login_success + '</div>').appendTo('body');
                                    setTimeout(function(){ $('#error-503').remove() }, 2000);
                                    break;
                            }

                            if ( null != $redirect ){

                                window.location.href = $redirect;
                            }
                        },
                        
                        complete    : function() { get_login_process = false },
                        
                        error       : function() { get_login_process = false }

                    });
                }
            };

            var scope = 'public_profile,email';
            window.fbAsyncInit = function() {
                FB.init({
                  appId      : '359585354228706',
                  xfbml      : true,
                  version    : 'v2.2'
                });

                var fb_user = false;
                FB.getLoginStatus(function(response) {

                    if (response.status === 'connected') {
                        //console.log("// the user is logged in and has authenticated your app, and response.authResponse supplies the user's ID, a valid access token, a signed request, and the time the access token and signed request each expire");

                        fb_user = true;

                    } else if (response.status === 'not_authorized') {
                        //console.log("// the user is logged in to Facebook, but has not authenticated your app");
                    } else {
                        //console.log("// the user isn't logged in to Facebook.");
                    }
                });
                
                $(document).on('click', 'a[href="#fblogin"]', function(e) {

                    e.preventDefault();

                    if ( false == fb_user ){

                        FB.login(function(response) {
                           if (response.authResponse) {

                            fb_user = true;

                            FB.api('/me', function(user) {
                                console.log('Good to see you, ' + user.name + '.');
                                get_login(user);
                            });

                           } else {
                             console.log('User cancelled login or did not fully authorize.');
                           }
                        }, { scope: scope });                       

                    } else {

                        FB.api('/me', function(user) {
                            console.log('There... There, ' + user.name + '.');
                            get_login(user);
                        });

                    }
                });
            };
        });
    </script>

    <?php
}
add_action('hb_after_page', 'hb_print_facebook_login_script', 30);