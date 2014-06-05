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
    <body>
      <br>
            <fieldset style="width: 80%;margin-left: 10%;margin-right: 10%"><legend><strong>Sanciones de jugadores</strong></legend>
                <form method="post" name="sancionJug" onsubmit="return validarForm(this);" action="jugadores.php">

    <p><label>Selecciona la modalidad:	
                               <select name="modalidad" size="1" id="modalidad" onchange="
                                    <?php
                                   global $wpdb;
                                   $modalidad = $_POST['modalidades'];
                           $id = $wpdb->get_var( "SELECT IdModalidad FROM wp_sdp_Modalidades WHERE Modalidad LIKE '%$modalidad'");
                            $sqlNombres = "SELECT Nombre FROM ".$wpdb->prefix . "sdp_Equipos WHERE IdModalidad = $id AND EsUniversitario =0 AND IdCurso=" .date('Y');
                                                                         
                                   
                                    // $idmodal = $wpdb->get_var( "SELECT IdModalidad FROM wp_sdp_Modalidades WHERE Modalidad LIKE '%$_POST[modalidad]'");
                                     ?>
                                        ">

                                    <option selected="selected"></option>
                                    <option       
                                    <?php
                                    global $wpdb;
                                    $sql = "SELECT DISTINCT Modalidad,IdModalidad FROM  ". $wpdb->prefix ."sdp_Modalidades";

                                    $items = $wpdb->get_results($sql);

                                    foreach ($items as $item)
                                     {
                                    print('<option value= '.$item->IdModalidad.'>'.$item->Modalidad.'<br/>');
                                    print('</option>');

                                    }
                                    ?>
                                        
                                </option>
                            </select></label></p>
                       <p>     <label> Sexo:

    <select name="sexo" id="sexo"  onchange="
        <?php
            $idsexo = $wpdb->get_var( "SELECT IdSexo FROM wp_sdp_Sexos_equipo WHERE Sexo LIKE '%$_POST[sexo]'");
        ?>
        "/> 
 <option selected="selected"></option>
  <option>Masculino</option>
   <option>Femenino</option>
    </select>    </label></p>
                      <p><label>Selecciona el equipos:
                                   <select id="equipos" size="1" name="equipos">
                                    <option selected="selected"></option>
                                    <option       
                                    <?php
                                    global $wpdb;
                                   // $modalidad = $_POST['modal'];
                                    $idmodal = $wpdb->get_var( "SELECT IdModalidad FROM wp_sdp_Modalidades WHERE Modalidad LIKE '%$_POST[modal]'");
                                    $sql = "SELECT DISTINCT Nombre FROM  ". $wpdb->prefix ."sdp_Equipos WHERE IdModalidad=3 AND EsUniversitario=1";

                                    $items = $wpdb->get_results($sql);

                                    foreach ($items as $item)
                                     {
                                    print('<option value= '.$item->Nombre.'>'.$item->Nombre.'<br/>');
                                    print('</option>');

                                    }
                                    ?>
                                        
                                </option>
                            </select></label></p>
                            <input type="submit" value="Seleccionar"> </label>
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
