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
wp_enqueue_script('jquery');

?>


<html>
    <br>
<body>
<fieldset style="width: 80%;margin-left: 10%;margin-right: 10%"><legend><strong>Lista de jugadores</strong></legend>
<form name="jugadores" method="post">
   <p><label>Jugadores:
                                   <select id="jugador" size="1" name="jugador"
                                    <option selected="selected"></option>
                                    <option       
                                    <?php
                                    global $wpdb;
                                    $modalidad = $_POST['modalidad'];
                                    $idmodal = $wpdb->get_var( "SELECT IdModalidad FROM wp_sdp_Modalidades WHERE Modalidad LIKE '%$modalidad'");
                                    $sql = "SELECT DISTINCT Nombre FROM  ". $wpdb->prefix ."sdp_Jugadores";

                                    $items = $wpdb->get_results($sql);

                                    foreach ($items as $item)
                                     {
                                    print('<option value= '.$item->Nombre.'>'.$item->Nombre.'<br/>');
                                    print('</option>');

                                    }
                                    ?>
                                        
                                </option>
                            </select></label></p>
                            <p><label>Número de partidos sancionado:  <input type="text" size="2"></label></p>

<input type="submit" value="Aplicar sanción">

</form>
</fieldset>
</body>
<br>
</html> 
<?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?> 
