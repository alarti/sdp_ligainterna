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

if (!is_user_logged_in() &&!current_user_can('manage_options'))
die('Si no eres administrador no puedes ver esta página.');
?>

<html>
    
   <div id="primary" class="site-content">
        <div id="content" role="main">
            <!-- A partir de aquí el código html de la página -->
 <?php
//Datos globales a todas las paginas
            global $wpdb;
            $wpdb->show_errors();


//Cargamos los datos del usuario logeado en caso de que lo este en pruebas meter en un inc con clases de utilidades

            $current_user = wp_get_current_user();
            $setNombreApellido = $current_user->user_firstname . " " . $current_user->user_lastname;
            ?>

              <fieldset style="width: 80%;margin-left: 10%;margin-right: 10%"><legend><strong>Aplazar partidos</strong></legend>
                <form method="post" name="datos">

                    <div  width="50%">
                        <br>
                        
                        <label> Don (Nombre y apellidos)<input type="text" name="NombreApellido" size="30" value="<?php echo($setNombreApellido) ?>"/></label><br>
                        <br>
                       <p><label> Modalidad:

                                <select name="modalidad" size="1" id="modalidad" onchange="
                                    <?php
                                    $idmodal = $wpdb->get_var( "SELECT IdModalidad FROM ". $wpdb->prefix ."sdp_Modalidades WHERE Modalidad LIKE '%Baloncesto'");
                                                                      
                                    ?>
                                        ">

                                    <option selected="selected"></option>
                                    <option       
                                    <?php
                                    global $wpdb;
                                    $sql = "SELECT DISTINCT Modalidad FROM  ". $wpdb->prefix ."sdp_Modalidades";

                                    $items = $wpdb->get_results($sql);

                                    foreach ($items as $item)
                                    {
                                    print('<option>'.$item->Modalidad.'<br/>');
                                    print('</option>');

                                    }
                                    ?>
                                </option>
                            </select></label></p>
                       <p><label> Nombre del equipo:                 
                        <select name="nom" id="nom" size="1" onclick="
                                 <?php
                         global $wpdb;
                                $division = $wpdb->get_var( "SELECT Division FROM wp_sdp_Equipos WHERE Nombre LIKE '%$_REQUEST[nom]'");
                                $grupo = $wpdb->get_var( "SELECT Grupo FROM wp_sdp_Equipos WHERE Nombre LIKE '%$_REQUEST[nom]'");
                                ?>">
                            <option>
                 
                                <?php
                                        
                                $sql = "SELECT Nombre FROM ".$wpdb->prefix . "sdp_Equipos WHERE IdModalidad = $idmodal AND EsUniversitario=1 AND IdCurso=" .date('Y');
                                $items = $wpdb->get_results($sql);

                                foreach ($items as $item) {
                                    
                                print('<option>' . $item->Nombre . '');
                                print('</option>');
                                }
                                ?>
                            </option>
                        </select>
                        </label></p>
                           <p><label>SOLICITA EL APLAZAMIENTO DEL PARTIDO</LABEL></p>
                           <p><label>Fecha del partido:
                                 <select name="fecha" size="1" id="fecha" size="40">

                                    <option selected="selected"></option>
                                    <option       
                                    <?php
                                    global $wpdb;
                                    $idequipos = $wpdb->get_var("SELECT IdEquipo FROM ".$wpdb->prefix . "sdp_Equipos WHERE Nombre LIKE '%prueba2'");
                                $sql = "SELECT Fecha FROM ".$wpdb->prefix . "sdp_Partidos WHERE IdModalidad = $idmodal AND (IdEquipo1=$idequipos OR IdEquipo2=$idequipos) AND IdCurso=" .date('Y');
                                $items = $wpdb->get_results($sql);

                                foreach ($items as $item) {
                                    
                                print('<option>' . $item->Fecha . '');
                                print('</option>');

                                } 
                                    ?>
                                </option>
                            </select></label></p> 
                                   
                                   
                           <p><label> Partido(nombre equipos):

                                <select name="partidos" size="1" id="partidos" size="40">

                                    <option selected="selected"></option>
                                    <option       
                                    <?php
                                    global $wpdb;
                                    $idequipo1 = $wpdb->get_var( "SELECT IdEquipo1 FROM ". $wpdb->prefix ."sdp_Partidos WHERE IdModalidad = $idmodal AND Fecha='2013-12-18'");
                                   $idequipo2 = $wpdb->get_var( "SELECT IdEquipo2 FROM ". $wpdb->prefix ."sdp_Partidos WHERE IdModalidad = $idmodal AND Fecha='2013-12-18'");
                                    
                                    $equipo1 = $wpdb->get_var("SELECT Nombre FROM  ". $wpdb->prefix ."sdp_Equipos WHERE IdEquipo = $idequipo1");
                                    $equipo2 = $wpdb->get_var("SELECT Nombre FROM  ". $wpdb->prefix ."sdp_Equipos WHERE  IdEquipo = $idequipo2");
                                    
                                    //$items = $wpdb->get_results($equipo1,$equipo2);

                                   // foreach ($items as $item) {
                                    print('<option>'.$equipo1. ' - ' .$equipo2. '<br/>');
                                    print('</option>');

                                    
                                    ?>
                                </option>
                            </select></label></p>

                        
                                         
                    <input style="font-size: 18px;" type="submit" name="submit" value="Aplazar" onclick="

                           <?php
                           
                           global $wpdb;
                           $wpdb->show_errors();
                           $wpdb->print_error();

                          if (isset($_POST['submit'])){
                           if( $resul == true){
                        
                           }
                          }
                           ?>
                           "><br>
                </div>
            </form></fieldset>
        <br>
        <!-- Fin de código html partir de aquí el código html de la página -->
    </div><!-- #content -->
</div><!-- #primary -->

</html>
<?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?>
 