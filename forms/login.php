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
get_header();

?>
<div class="entry-content">
    <h2>Inicio de sesión</h2>
    <ul id="lista_login">
        <li><a href="<?php echo wp_login_url(home_url()); ?>">Accede directamente si tienes cuenta de usuario en la ULE</a></li>
        <li>Si no eres miembro de la Universidad de León <a href="/wp-login.php">accede</a> con tu cuenta de correo personal. Debes estar <a href="/wp-login.php?action=register">dado de alta</a> en esta aplicación.</li>
        <li>Puedes <a href="/wp-login.php?action=lostpassword">recuperar tu contraseña</a> en caso de pérdida en el formulario destinado para ello.</li>
    </ul>
    <div id="login-info"></div>
    <p><a href="http://ulelin.unileon.es/media/en_construccion2.jpg"><img class="size-medium wp-image-617 aligncenter" alt="en_construccion2" src="http://ulelin.unileon.es/media/en_construccion2-300x292.jpg" width="300" height="292" /></a></p>
</div><!-- .entry-content -->


</div>	
</div>
<!-- contents end -->

<?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?>
