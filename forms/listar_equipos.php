<?php

/**
 *
 * @package sdp
 * @subpackage SDP Alta equipos
 * @since SDP Alta equipos 1.0
 * @Author: infaar01,scampc00
 * 	@last_mod:30/05/2013
 */
require_once('../../../../wp-load.php');
require_once('../../../../wp-config.php');
get_header();

if (!is_user_logged_in() && !current_user_can('manage_options'))
    die('Si no eres administrador no puedes ver esta página.');
?>
       
<div id="primary" class="site-content">
    <div id="content" role="main">
        <!-- A partir de aquí el código html de la página -->


        <?php
//Datos globales a todas las paginas
        global $wpdb;
        $wpdb->show_errors();
        
        
//Cargamos los datos del usuario logeado en caso de que lo este en pruebas meter en un inc con clases de utilidades

        $query="SELECT Nombre,IdModalidad FROM wp_sdp_Equipos ORDER BY IdModalidad  asc  ";
        $resultado=mysql_query($query)or die("Error en la query:".mysql_error());   
        ?>
        




<table border=2 class="display" id="equipos"><tr>
        <th><strong>NombreSS</strong><br><br></th>
        <th><strong>Id Modalidad</strong><br><br></th>
    </tr>
<?php
    while($registro=mysql_fetch_array($resultado,MYSQL_ASSOC)){
    echo"<tr>";
    foreach ($registro as $campo)
        echo"<td>",$campo,"&nbsp;&nbsp;&nbsp;&nbsp;</td>";
        echo"</tr>";
}
?>
        
</table>
 <?php       
mysql_free_result($resultado);

?>

      <br>
        <!-- Fin de código html partir de aquí el código html de la página -->
    </div><!-- #content -->
</div><!-- #primary -->

<?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?>

