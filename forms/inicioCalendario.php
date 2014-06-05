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
<div id="primary" class="site-content">
        <div id="content" role="main">
            <!-- A partir de aquí el código html de la página -->


            <br>
            <fieldset style="width: 70%;margin-left: 10%;margin-right: 10%" ><legend><strong>Clasificación de partidos</strong></legend>
                <form method="post" name="clasificacion" action="calendario2.php">
                 <br>
                    <div  width="50%">
                         <p><label>Selecciona la modalidad:

<select name="modalidad" id="modalidad" size="1" onchange="
                                    <?php
                                   
                                     global $wpdb;
                                    $idmodal = $wpdb->get_var( "SELECT IdModalidad FROM ". $wpdb->prefix ."sdp_Modalidades WHERE Modalidad LIKE '%$_POST[modalidad]'");
                                                                      
                                    ?>
                                        ">
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
<p><label>Sexo:
<select name="sexo" id="sexo" size="1" >
    <option></option>
    <option>Masculino  </option>
    <option>Femenino  </option>
</select></label></p>
       <p>Selecciona la jornada:<select name="jornada" id="jornada" size="1">
    <option>
      <?php 
        $sql3="SELECT DISTINCT Grupo FROM wp_sdp_Equipos ORDER BY Grupo ASC";

                    $items3 = $wpdb->get_results($sql3);

                    foreach ($items3 as $item)
                    {
                        print('<option>'.$item->Grupo.'<br/>');
                         print('</option>');
                    }
?>
  </option>
</select></p>
<p><input name="calendario" type="submit" value="Mostrar calendario"/></p>
 </div>
             </form>
            </fieldset>
    </div>
</div>
        </body>
    </html>
<?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?> 