<?php
/**
 * WordPress User Page
 *
 * Handles authentication, registering, resetting passwords, forgot password,
 * and other user handling.
 *
 * @package WordPress
 */
/** Make sure that the WordPress bootstrap has run before continuing. */
require( '../../../../wp-load.php' );
require_once(ABSPATH .'wp-config.php');
require_once(ABSPATH . 'wp-admin/includes/admin.php');

get_header();
?>

<form name="loginform" style="center" id="loginform" action="<?php echo esc_url(site_url('wp-login.php', 'login_post')); ?>" method="post">
    <div class="outer-center"> 
    <p>
        <label for="user_login"><?php _e('Username') ?><br />
            <input type="text" name="log" id="user_login" class="input" value="<?php echo esc_attr($user_login); ?>" size="20" readonly/></label>
    </p>
    <p>
        <label for="default_role"><?php _e('Rol') ?>
            <select>
                <?php
                /*global $wp_roles;
                foreach ($wp_roles->roles as $role) {
                    echo '<option>' . $role['name'] . '<option/>';                    
                }*/
?>
                                <?php wp_dropdown_roles(esc_attr($user_role)); ?>
            </select>
    </p>
    <br />
    
    <?php do_action('login_form'); ?>
    <p class="submit">
        <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Log In'); ?>" />
        <input type="hidden" name="redirect_to" value="<?php echo esc_attr($redirect_to); ?>" />
        <input type="hidden" name="testcookie" value="1" />
    </p>
    </div>
</form>
        <?php
        

    