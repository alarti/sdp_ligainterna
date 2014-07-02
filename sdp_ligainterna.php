<?php
/*
  Plugin Name: SDP_LigaInterna
  Version: 0.7.0
  Plugin URI: http://grid.ie/wiki/WordPress_sdp_samlphp_authentication
  Description: Gestiona la Liga Interna Universitaria del Servicio de Deportes de la ULE.
  <a href="http://sdp_samlphp.org">sdp_samlphp</a> fork de David.OCallaghan.
  Author: (Core & SSO & enarCRUD  by Alberto Arce) , (Formularios de inscripción:¡ by Sergio del Campo Camacho)
  Author URI:   http://ulelin.unileon.es
 */

/* Copyright (C) 2013 Alberto Arce (alberto dot arce dot ti at gmail dot com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

 */

//----------------------------------------------------------------------------
//		SAML2 Autenthication
//----------------------------------------------------------------------------
add_action('admin_menu', 'sdp_saml_authentication_add_options_page');

$sdp_saml_authentication_opt = get_option('sdp_saml_authentication_options');

$sdp_saml_configured = true;

#Instala o actualiza las tablas adicionales

include_once dirname( __FILE__ ) . '/class/SDPDatabase.class.php';
register_activation_hook( __FILE__, array( 'SDPDatabase', 'install' ) );

//--------------------------------------------------
//// Configuramos el cliente saml
if ($sdp_saml_authentication_opt ['include_path'] == '') {
    $sdp_saml_configured = false;
} else {
    $include_file = $sdp_saml_authentication_opt ['include_path'] . "/lib/_autoload.php";
    if (!include_once($include_file)) {
        $sdp_saml_configured = false;
    }
}

if ($sdp_saml_configured) {
    $sp_auth = ($sdp_saml_authentication_opt ['sp_auth'] == '') ? 'default-sp' : $sdp_saml_authentication_opt['sp_auth'];
    $as = new SimpleSAML_Auth_Simple($sp_auth);
}


/*
  Plugin hooks into authentication system
 */
add_filter('authenticate', array('sdp_SAMLAuthenticator', 'authenticate'), 10, 2);


//include_once dirname( __FILE__ ) . '/forms/inicio.php';
//add_filter('authenticate', 'login_ini');

add_action('wp_logout', array('sdp_SAMLAuthenticator', 'logout'));
#add_action('lost_password', array('sdp_SAMLAuthenticator', 'disable_function'));
#add_action('retrieve_password', array('sdp_SAMLAuthenticator', 'disable_function'));
#add_action('password_reset', array('sdp_SAMLAuthenticator', 'disable_function'));
#add_action('show_user_profile', array('sdp_SAMLAuthenticator', 'disable_function'));

add_filter('show_password_fields', array('sdp_SAMLAuthenticator', 'show_password_fields'));

// Version logic
$version = '0.7.0';
$previous_version = get_option('sdp_saml_authentication_version');
if ($previous_version) {
    /*
      #Version comparison. Not yet needed as this is the first release that has a database version number.
      if(version_compare($version, $db_version) === 1) {
      Upgrade stuff here...
      }
     */
} else {
# No previous version detected -> that means possibly vulnerable passwords
    fix_vulnerable_passwords();
    update_option(
            'sdp_saml_authentication_version', $version);
}

function fix_vulnerable_passwords() {
    global $wpdb;
    require_once( ABSPATH . 'wp-includes/class-phpass.php' );
    $wp_hasher = new PasswordHash(8, true);
    $users = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "users");

    foreach ($users as $user) {
        if ($wp_hasher->CheckPassword(md5('Authenticated through SSPSAML'), $user->user_pass)) {
            invalidate_password
                    ($user->ID);
        }
    }
}

function invalidate_password($ID) {
    global $wpdb;
    $wpdb->query(
            $wpdb->prepare("UPDATE " . $wpdb->prefix . "users SET user_pass = '~~~password_incorrecta~~~' WHERE ID = %d", $ID
            )
    );
}

$slo = $sdp_saml_authentication_opt['slo'];
if ($slo) {
    /*
      Log the user out from WordPress if the sdp_samlphp SP session is gone.
      This function overrides the is_logged_in function from wp core.
      (Another solution could be to extend the wp_validate_auth_cookie func instead).
     */

    function is_user_logged_in() {
        global $as;

        $user = wp_get_current_user();
        if ($user->ID > 0) {

            // User is local authenticated but SP session was closed
            if (!isset($as)) {
                global $sdp_saml_authentication_opt;
                $sp_auth = ($sdp_saml_authentication_opt ['sp_auth'] == '') ? 'default-sp' : $sdp_saml_authentication_opt['sp_auth'];
                $as = new SimpleSAML_Auth_Simple($sp_auth);
            }

            if (!$as->isAuthenticated()) {
                wp_logout();
                return false;
            } else {
                return true;
            }
        }

        return false;
    }

}


if (!class_exists
                ('sdp_SAMLAuthenticator')) {

    class

    sdp_SAMLAuthenticator {

        function authenticate($user, $username) {
            if (is_a($user, 'WP_User')) {
                return $user;
            }

            global $sdp_saml_authentication_opt, $sdp_saml_configured, $as;
            if (!$sdp_saml_configured) {
                die("NO SE HA CONFIGURADO EL PLUGIN sdp_saml-authentication");
            }
// Reset value from input ($_POST and $_COOKIE)
            $username = '';
            $as->requireAuth();
            $attributes = $as->getAttributes();
            if (empty($sdp_saml_authentication_opt['username_attribute'])) {
                $username = $attributes['uid'][0];
            } else {
                $username = $attributes[$sdp_saml_authentication_opt['username_attribute']][0];
            }

            if ($username != substr(sanitize_user($username, TRUE), 0, 60)) {
                $error = sprintf(__('<p><strong>ERROR</strong><br /><br />
				Hemos recibido el siguiente indentificador del servicio SAML:<pre>%s</pre>
				Desafortunadamente no coincide con nuestros registros.<br />
				Por favor contacte con <a href="mailto:%s">el administradir</a> para que reconfigure
				el plugin SAML!</p>'), $username, get_option('admin_email'));
                $errors['registerfail'] = $error;
                print($error);
                exit();
            }
//$username = 'admin';
            $user = get_user_by('login', $username);
#var_dump($user);
#exit;
            if ($user) {

// user already exists
                return $user;
            } else {
// First time logging in
#var_dump('asdfasdf');
                if ($sdp_saml_authentication_opt ['new_user'] == 1) {
// Auto-registration is enabled
// User is not in the WordPress database
// They passed sdp_saml and so are authorised
// Add them to the database
// User must have an e-mail address to register
                    $user_email = '';
                    $email_attribute = empty($sdp_saml_authentication_opt['email_attribute']) ? 'mail' : $sdp_saml_authentication_opt['email_attribute'];

                    if ($attributes[$email_attribute][0]) {
// Try to get email address from attribute
                        $user_email = $attributes[$email_attribute][0];
                    } else {
// Otherwise use default email suffix
                        if ($sdp_saml_authentication_opt ['email_suffix'] != '') {
                            $user_email = $username . '@' . $sdp_saml_authentication_opt['email_suffix'];
                        }
                    }

                    $user_info = array();
                    $user_info['user_login'] = $username;
                    $user_info['user_pass'] = 'dummy'; // Gets reset later on.
                    $user_info['user_email'] = $user_email;

                    if (empty($sdp_saml_authentication_opt['firstname_attribute'])) {
                        $user_info['first_name'] = $attributes['givenName'][0];
                    } else {
                        $user_info['first_name'] = $attributes[$sdp_saml_authentication_opt['firstname_attribute']][0];
                    }

                    if (empty($sdp_saml_authentication_opt['lastname_attribute'])) {
                        $user_info['last_name'] = $attributes['sn'][0];
                    } else {
                        $user_info['last_name'] = $attributes[$sdp_saml_authentication_opt['lastname_attribute']][0];
                    }

// We atach the defined rol in player inscription
// Set user role based on eduPersonEntitlement
                    if ($sdp_saml_authentication_opt ['admin_entitlement'] != '' &&
                            $attributes ['eduPersonEntitlement'] &&
                            in_array($sdp_saml_authentication_opt['admin_entitlement'], $attributes['eduPersonEntitlement'])) {
                        $user_info['role'] = "administrator";
                    } else {
                        $user_info['role'] = $sdp_saml_authentication_opt['default_role'];
                    }

                    $wp_uid = wp_insert_user($user_info);
                    invalidate_password($wp_uid);
                    return get_user_by('login', $username);
                } else {
                    $error = sprintf(__('<p><strong>AVISO</strong>: %s no está registrado en este sitio.
						Contacte con <a href="mailto:%s">blog administrator</a> para crear una nueva cuenta!</p>'), $username, get_option('admin_email'));
                    $errors['registerfail'] = $error;
                    print($error);
                    print('<p><a href="/wp-login.php?action=logout">Log out</a> of sdp_samlphp.</p>');
                    exit();
                }
            }
        }

        function logout() {
            global $sdp_saml_authentication_opt, $sdp_saml_configured, $as;
            if (!$sdp_saml_configured) {
                die("NO SE HA CONFIGURADO sdp_saml-authentication");
            }
            $as->logout(get_option('siteurl'));
        }
// Don't show password fields on user profile page.
        function show_password_fields($show_password_fields) {

            return false;
        }
        function disable_function() {
            die('Ha sido desactivado por el administrador del sitio');
        }
    }
}

//----------------------------------------------------------------------------
//		ADMIN OPTION PAGE FUNCTIONS
//----------------------------------------------------------------------------

function sdp_saml_authentication_add_options_page() {
    if (function_exists('add_menu_page')) {
        //add_menu_page('SDP Liga Interna ', 'SDP Liga Interna', 'manage_options', basename(__FILE__), 'sdp_saml_authentication_options_page', plugin_dir_path(__FILE__) . 'images/sdp_ico_32x32.png');
        add_menu_page('SDP Liga Interna ', 'SDP Liga Interna', 'manage_options', basename(__FILE__), 'sdp_saml_authentication_options_page');
    }
}

function sdp_saml_authentication_options_page() {
    global $wpdb;

    // Default options
    $options = array(
        'new_user' => TRUE,
        'slo' => FALSE,
        'nav_menu' => FALSE,
        'jqm' => FALSE,
        'redirect_url' => '',
        'email_suffix' => 'unileon.es',
        'sp_auth' => 'default-sp',
        'username_attribute' => 'uid',
        'firstname_attribute' => 'givenName',
        'lastname_attribute' => 'sn',
        'email_attribute' => 'mail',
        'include_path' => '/var/sdp_samlphp',
        'admin_entitlement' => '',
        'default_role' => 'author',
    );

    if (isset($_POST['submit'])) {
        // Create updated options, loop through original one to get keys.
        $options_updated = array();
        foreach (array_keys($options) as $key) {
            $options_updated[$key] = isset($_POST[$key]) ? $_POST[$key] : $options[$key];
        }

        update_option('sdp_saml_authentication_options', $options_updated);
    }

    // Get Options
    $options = get_option('sdp_saml_authentication_options');
    ?>

    <div class="wrap">
        <h2>Configuración del Plugin Liga Interna del Servicio de Deportes </h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?page=' . basename(__FILE__); ?>&updated=true">
            <fieldset class="options">
                <h3>Opciones de Autenticación SAML2</h3>
                <h4>Opciones de registro de usuario</h4>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Registro de usuario SAML2</th>
                        <td>
                            <label for="new_user"><input name="new_user" type="checkbox" id="new_user_inp" value="1" <?php checked('1', $options['new_user']); ?> />Registrar usuarios automáticamente</label>
                            <span class="setting-description">(Los usuarios se registrarán con el rol por defecto.)</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="default_role">Role por defecto</label></th>
                        <td>                    
                            <select name="default_role" id="default_role_inp">
                                <?php wp_dropdown_roles($options['default_role']); ?>
                            </select>
                            <span class="setting-description">Rol por defecto para los nuevos usuarios <br>
                                (SDP crea 4 nuevos tipos de rol):<br>
                                1.SDP_MANAGER<br>
                                2.SDP_ARBITRO<br>
                                3.SDP_CAPITAN<br>
                                4.SDP_JUGADOR<br>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th><label for="email_suffix">Dominio de Email por defecto </label></th>
                        <td>
                            <input type="text" name="email_suffix" id="email_suffix_inp" value="<?php echo $options['email_suffix']; ?>" size="35" />
                            <span class="setting-description">Si el email no está disponible desde el <acronym title="Proveedor de Identidad">IdP</acronym> Se utilizará <strong>username@domain</strong>.</td>
                    </tr>

                    <tr>
                        <th><label for="admin_entitlement">Dirección del servicio de grupos (Administrador Entitlement URI)</label></th>
                        <td><input type="text" name="admin_entitlement" id="admin_entitlement_inp" value="<?php echo $options['admin_entitlement']; ?>" size="40" />
                            <span class="setting-description">eduPersonEntitlement<a href="http://rnd.feide.no/node/1022"></a> URI para identificar a los usuarios admin</span>
                        </td>
                    </tr>
                </table>

                <h4>Opciones de Avanzadas SAML2</h4>
                <p><em>Note:</em> Una vez establecidas estas opciones, La autenticación de WordPress se realizará a traves de <a href="http://en.wikipedia.org/wiki/SAML_2.0">SAML 2.0</a>
                    Puedes utilizar otro navegador para comprobar las opciones y hacer los cambios necesarios en este a fin de no perder el acceso.
                    Siempre puedes desactivar el plugin o renombrar su carpeta en el ftp para volver a la la autenticación de WordPress.</p>

                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><label for="include_path">Ruta al Idp samlphp</label></th>
                        <td><input type="text" name="include_path" id="include_path_inp" value="<?php echo $options['include_path']; ?>" size="35" />
                            <span class="setting-description">Ruta por defecto <tt>/var/sdp_samlphp</tt>.</span>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label for="sp_auth">Orígen de Autenticación</label></th>
                        <td><input type="text" name="sp_auth" id="sp_auth_inp" value="<?php echo $options['sp_auth']; ?>" size="35" />
                            <span class="setting-description">Por defecto "default-sp".</span>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label for="username_attribute">Atributo usado como nombre de usuario</label></th>
                        <td><input type="text" name="username_attribute" id="username_attribute_inp" value="<?php echo $options['username_attribute']; ?>" size="35" />
                            <span class="setting-description">Por defecto es "uid".</span>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label for="firstname_attribute">Atributo usado como Nombre </label></th>
                        <td><input type="text" name="firstname_attribute" id="firstname_attribute_inp" value="<?php echo $options['firstname_attribute']; ?>" size="35" />
                            <span class="setting-description">Por defecto es "givenName".</span>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label for="lastname_attribute">Atributo usado como apellido</label></th>
                        <td><input type="text" name="lastname_attribute" id="lastname_attribute_inp" value="<?php echo $options['lastname_attribute']; ?>" size="35" />
                            <span class="setting-description">Por defecto es "sn".</span>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label for="email_attribute">Atributo usado como E-mail</label></th>
                        <td><input type="text" name="email_attribute" id="email_attribute_inp" value="<?php echo $options['email_attribute']; ?>" size="35" />
                            <span class="setting-description">Por defecto es "mail".</span>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label for="slo">Single Log Out</label></th>
                        <td><input type="checkbox" name="slo" id="slo" value="1" <?php checked('1', $options['slo']); ?> />
                            <span class="setting-description">Activar Single Log Out</span>
                        </td>
                    </tr>
                </table>
                <h3>Opciones de Visualización</h3>
                <!--<p><em>Note:</em> Una vez establecidas estas opciones, La autenticación de WordPress se realizará a traves de <a href="http://en.wikipedia.org/wiki/SAML_2.0">SAML 2.0</a>
                    Puedes utilizar otro navegador para comprobar las opciones y hacer los cambios necesarios en este a fin de no perder el acceso.
                    Siempre puedes desactivar el plugin o renombrar su carpeta en el ftp para volver a la la autenticación de WordPress.</p>
                -->
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><label for="jqm">Activar movilización</label></th>
                        <td><input type="checkbox" name="jqm" id="jqm" value="1" <?php checked('1', $options['jqm']); ?> />
                            <span class="setting-description">Activar Jquery Mobile como framework para mostrar el html</span>
                        </td>
                    </tr>
                </table>
                <h3>Opciones de Seguridad</h3>
                <!--<p><em>Note:</em> Desde la pagina de administración de menú podrás establecer el acceso</a>
                    limitando visibilidad por estado de logueo en la aplicación o por rol del usuario activo
                    Al desactivarlo estarán disponibles todas las opciones para todos los usuarios.</p>
                -->
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><label for="nav_menu">Activar Seguridad por rol</label></th>
                        <td><input type="checkbox" name="nav_menu" id="nav_menu" value="1" <?php checked('1', $options['nav_menu']); ?> />
                            <span class="setting-description">Activar Seguridad control de acceso por rol</span>
                        </td>
                            <td>
                            <div class="menu-rol">
                                <input type="button" name="menu-rol" value="<?php _e('Control de Menu por Rol') ?>" onClick="window.location.href='/wp-admin/nav-menus.php' " />
                            </div>
                        </td>
                    </tr>
                </table>

            </fieldset>
            <div class="submit">
                <input type="submit" name="submit" value="<?php _e('Guardar Opciones') ?>" />
            </div>
        </form>
        <?php
    }

//----------------------------------------------------------------------------
//		OWN LOG IN LOGIN PAGE
//----------------------------------------------------------------------------
    /*
      add_action("login_head", "my_login_head");

      function my_login_head() {
      echo "
      <style>
      body.login #login h1 a {
      " . //background: url('".ABSPATH ."wp-content/plugins/sdp_ligainterna/images/ULE1.png') no-repeat scroll center top transparent;
      "background-image: url('../../wp-content/plugins/sdp_ligainterna/images/ULE1.png');
      height: 65px;
      width: 65px;
      }
      </style>

      ";
      }

      // personalizar url logo acceso
      add_action('login_headerurl', 'my_custom_login_url');

      function my_custom_login_url() {
      return 'http://soporte900.wordpress.com';
      }

      //Cambiar texto alt del logo de login
      add_action("login_headertitle", "my_custom_login_title");

      function my_custom_login_title() {
      return 'SDP';
      }
     */
//----------------------------------------------------------------------------
//		CREATE ROLES FOR SDP GROUPS
//----------------------------------------------------------------------------

    add_role('SDP_MANAGER', 'SDP_Manager', array(
        'read' => true, // True allows that capability
        'edit_posts' => false,
        'delete_posts' => false, // Use false to explicitly deny
    ));
    add_role('SDP_ARBITRO', 'SDP_Árbitro', array(
        'read' => true, // True allows that capability
        'edit_posts' => false,
        'delete_posts' => false, // Use false to explicitly deny
    ));
    add_role('SDP_CAPITAN', 'SDP_Capitán', array(
        'read' => true, // True allows that capability
        'edit_posts' => false,
        'delete_posts' => false, // Use false to explicitly deny
    ));
    add_role('SDP_JUGADOR', 'SDP_Jugador', array(
        'read' => true, // True allows that capability
        'edit_posts' => false,
        'delete_posts' => false, // Use false to explicitly deny
    ));

//----------------------------------------------------------------------------
//		CREATE MENUS FOR EACH ROLE
//----------------------------------------------------------------------------
    /**
     * Launch the whole plugin
     */
    $options = get_option('sdp_saml_authentication_options');
    if ($options['nav_menu'] == '1') {
        include_once( plugin_dir_path(__FILE__) . 'class/Nav_Menu_Roles.class/nav-menu-roles.class.php');
        global $Nav_Menu_Roles;
        $Nav_Menu_Roles = new Nav_Menu_Roles();
    }

//------------------------------------------------------------------------------
// Redirección tras login a front -end
// 
//------------------------------------------------------------------------------
// Redirect admins to the dashboard and other users elsewhere
    add_filter('login_redirect', 'my_login_redirect', 10, 3);

    function my_login_redirect($redirect_to, $request, $user) {
        // Is there a user?
        /*if (is_array($user->roles)) {
            // Is it an administrator?
            if (in_array('administrator', $user->roles))
                return home_url();
            else
                return home_url();
        }*/
        return home_url();
    }

//------------------------------------------------------------------------------
//Deshabilitamos la barra de admin para todos los usuarios excepto el admin
//------------------------------------------------------------------------------
    add_action('after_setup_theme', 'remove_admin_bar');

    function remove_admin_bar() {
//        if (!current_user_can('administrator') && !is_admin()) {
            //show_admin_bar(false);
  //      }
    }
