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


?>


<html>
  
<body>
<fieldset style="width: 80%;margin-left: 10%;margin-right: 10%"><legend><strong>Lista de equipos</strong></legend>

   <p><label>Equipos:
                                   <select id="equipos" size="1" name="equipos"
                                    <option selected="selected"></option>
                                    <option       
                                    <?php
                                    global $wpdb;
                                    $modalidad = $_REQUEST['modalidad'];
                                    $idmodal = $wpdb->get_var( "SELECT IdModalidad FROM wp_sdp_Modalidades WHERE Modalidad LIKE '%$modalidad'");
                                    $sql = "SELECT DISTINCT Nombre FROM  ". $wpdb->prefix ."sdp_Equipos WHERE IdModalidad=$idmodal AND EsUniversitario=1";

                                    $items = $wpdb->get_results($sql);

                                    foreach ($items as $item)
                                     {
                                    print('<option value= '.$item->Nombre.'>'.$item->Nombre.'<br/>');
                                    print('</option>');

                                    }
                                    ?>
                                        
                                </option>
                            </select></label></p>
                            <p><label>Número de puntos a quitar:  <input type="text" size="2"></label></p>
                            <p><label>Quitar parte de la fianza:  <input type="text" value="%" size="3"></label></p>

<input type="submit" value="Aplicar sanción">


</fieldset>
</body>
<br>
</html> 
<?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?> 

