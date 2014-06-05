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
            <fieldset style="width: 80%;margin-left: 10%;margin-right: 10%"><legend><strong>Sanciones de equipos</strong></legend>
                <form method="post" name="sancionEquip" action="equipos.php">

    <p><label>Selecciona la modalidad:

<select name="modalidad" id="modalidad" size="1">
    <option>
      <?php 
        $sql1="SELECT DISTINCT Modalidad FROM wp_sdp_Modalidades";

                    $items1 = $wpdb->get_results($sql1);

                    foreach ($items1 as $item)
                    {
                        print('<option>'.$item->Modalidad.'<br/>');
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
                            <input name="sancionEquip" type="submit" value="Seleccionar"> </label>
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
