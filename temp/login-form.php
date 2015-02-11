<div class="widget widget-login">
    <div class="container-fluid">
        <p class="text-center wl-logo">
            <a href="./">
                <img src="<?php echo HB_THEME_URL; ?>/img/YOINK.png" height="153" width="150" alt="Yoink">
            </a>
        </p>

        <form name="bp-login-form" id="bp-login-widget-form" class="default-form" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
            <div class="form-group">
                <label for="bp-login-widget-user-login"><i class="custom-email-ico"></i></label>
                <input type="text" class="form-control" id="bp-login-widget-user-login" placeholder="Username" name="log">
            </div>

            <div class="form-group">
                <label for="bp-login-widget-user-pass"><i class="custom-pass-ico"></i></label>
                <input type="password" class="form-control" id="bp-login-widget-user-pass" placeholder="Password" name="pwd">
            </div>

            <div class="form-group forgetmenot">       
                <p class="wr-newsletter">
                <input name="rememberme" type="checkbox" id="bp-login-widget-rememberme" value="forever" /> 
								<label for="bp-login-widget-rememberme"><span></span><?php _e( 'Remember Me', 'buddypress' ); ?></label>
                </p>
            </div>

            <div class="text-right form-group clearfix">
                <a class="fb-login" href="#fblogin">f</a> 
                <input type="submit" name="wp-submit" class="btn btn-default" id="bp-login-widget-submit" value="<?php esc_attr_e( 'Login', 'buddypress' ); ?>" />
            </div>
        </form>
    </div><!-- ./container -->

    <div class="form-footer">
        <a class="forgot-password pull-left" href="/wp-login.php?action=lostpassword">Forgot Password?</a>
        <?php if ( bp_get_signup_allowed() ) : ?>
        <p class="bp-login-widget-register-link text-right pull-right"><?php printf( __( 'No account? <a href="%s">REGISTER</a>.', 'buddypress' ), bp_get_signup_page() ); ?></p>
        <?php endif; ?>
    </div>
</div><!-- ./widget-login -->