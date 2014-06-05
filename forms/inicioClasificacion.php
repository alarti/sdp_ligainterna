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
                <form method="post" name="clasificacion" action="clasificacion.php">
                 <br>
                    <div  width="50%">
                         <p><label>Selecciona la modalidad:

<select name="modalidad" id="modalidad" size="1">
    <option>
      <?php 
        $sql1="SELECT DISTINCT Modalidad,CriterioEmpate FROM wp_sdp_Modalidades";

                    $items1 = $wpdb->get_results($sql1);

                    foreach ($items1 as $item) 
                    {
                        print('<option value= '.$item->Modalidad.'>'.$item->Modalidad.'<br/>');
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
       <p>División: <select name="division" id="division" size="1">
    <option>
      <?php 
        $sql2="SELECT DISTINCT Division FROM wp_sdp_Equipos ORDER BY Division ASC";

                    $items2 = $wpdb->get_results($sql2);

                    foreach ($items2 as $item)
                    {
                        print('<option>'.$item->Division.'<br/>');
                         print('</option>');
                    }
?>
  </option>
</select>&nbsp;&nbsp; Grupo:<select name="grupo" id="grupo" size="1">
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
<p><input name="clasificacion" type="submit" value="Mostrar clasificación"/></p>
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