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

       ?>

        <form method="post" name="actas"><br />
<fieldset style="width: 80%;margin-left: 10%;margin-right: 10%"><legend><strong>Actas</strong></legend><br />
    <br>
<label>Selecciona el partido del acta que quieras rellenar</label><select name="Partidos" size="1">
  <option selected="selected"></option>
    <option       
                                    <?php
                                    global $wpdb;
                                    $current_user = wp_get_current_user();
                                    $idarb = $wpdb->get_var( "SELECT IdArbitro FROM wp_sdp_Arbitros WHERE Email='$current_user->user_email'");
                                    $sql = "SELECT DISTINCT IdPartido FROM  ". $wpdb->prefix ."sdp_tblArbitrajes WHERE IdArbitro = $idarb";

                                    $items = $wpdb->get_results($sql);
                                     
                                    
                                    foreach ($items as $item){
                                    $idequipo1 = $wpdb->get_var( "SELECT IdEquipo1 FROM ". $wpdb->prefix ."sdp_Partidos WHERE IdPartido = $item->IdPartido");
                                   $idequipo2 = $wpdb->get_var( "SELECT IdEquipo2 FROM ". $wpdb->prefix ."sdp_Partidos WHERE IdPartido = $item->IdPartido");
                                    
                                    $equipo1 = $wpdb->get_var("SELECT Nombre FROM  ". $wpdb->prefix ."sdp_Equipos WHERE IdEquipo = $idequipo1");
                                    $equipo2 = $wpdb->get_var("SELECT Nombre FROM  ". $wpdb->prefix ."sdp_Equipos WHERE  IdEquipo = $idequipo2");
                                    
                                    //$items = $wpdb->get_results($equipo1,$equipo2);

                                   // foreach ($items as $item) {
                                    print('<option>'.$equipo1. ' - ' .$equipo2. '<br/>');
                                    print('</option>');

                                    }
                                    
                                    ?>
                                        
                                </option>
</select>
<br><br>
<p><label>Introducir resultado: </label>&nbsp;<input name="resultado" type="text" /></p>
<br><br>
<table width="210" border="2" cellpadding=2 bordercolor="666633">
  <tr>
    <td>Equipo 1</td>
    <td>Asistencia</td>
    <td>Tarjetas</td>
    <td>Equipo 2</td>
    <td>Asistencia</td>
    <td>Tarjetas</td>
  </tr>
  
</table>
<br><br>
<p><label>Introducir si hubo incidencias: </label></p>
<textarea name="incidencias" cols="40" rows="8"></textarea>
</fieldset>
</form>
        
    <br>
        <!-- Fin de código html partir de aquí el código html de la página -->
    </div><!-- #content -->
</div><!-- #primary -->

<?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?>