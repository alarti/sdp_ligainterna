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


<script type='text/javascript'>
    
function validarForm() {
 
  dni = datos.dni.value;
  numero = dni.substr(0,dni.length-1);
  let = dni.substr(dni.length-1,1);
  numero = numero % 23;
  letra='TRWAGMYFPDXBNJZSQVHLCKET';
  letra=letra.substring(numero,numero+1);
  
if(datos.TipoDni.value === ""){
    datos.TipoDni.focus();    // Damos el foco al control
    alert('No has seleccionado el tipo de documento'); //Mostramos el mensaje
    return false; //devolvemos el foco
 }else if(datos.dni.value.length === 0){
      datos.dni.focus();    // Damos el foco al control
      alert('No has escrito tu dni'); //Mostramos el mensaje
      return false; //devolvemos el foco
 }else if(letra !== let){
     datos.dni.focus();    // Damos el foco al control
      alert('Dni erroneo'); //Mostramos el mensaje
      return false; //devolvemos el foco
 }else if(datos.deporte.value === "" ) { //¿Tiene 0 caracteres?
    datos.deporte.focus();    // Damos el foco al control
    alert('No has seleccionado un deporte'); //Mostramos el mensaje
    return false; //devolvemos el foco
 }else if(datos.sexo.value === "") { //¿Tiene 0 caracteres?
    datos.sexo.focus();    // Damos el foco al control
    alert('No has seleccionado un sexo'); //Mostramos el mensaje
    return false; //devolvemos el foco
   } else if (confirm('¿Has revisado correctamente todos los datos?')){
                     return true;
                 }else{
                   return false;
                 }

    } 
   function habilitar(){
    if(document.datos.TipoDni.value !== ""){
        document.datos.dni.hidden = false;
    }else{
        document.datos.dni.hidden = true;
    }
}

 </script>

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
        <br><br>
        <fieldset style="width: 80%;margin-left: 10%;margin-right: 10%"><legend><strong>Inscripción individual</strong></legend>
             <form method="post" name="datos"  onsubmit="return validarForm(this);">
<div>
    <br>
    <br>
    <label>Nombre y apellidos del capitan:<input type="text" name="nomape" size="25" value="<?php echo($setNombreApellido) ?>" /> </label>
<br>
<br>
 <label>Tipo de documento<select name="TipoDni" id="TipoDni" size="1" onchange="habilitar();">
                        <option selected="selected"></option>
                        <option>NIF</option>
                        <option>Pasaporte</option>
                    </select></label>
                    <br>
                    <br>
                    <label>NIF/PASAPORTE:<input type="text" maxlength="9" name="dni" hidden="true"/></label>
                    <br>
<br>
<label>Correo electrónico(de la Universidad) : <input type="text" size="35" value="<?php echo($current_user->user_email); ?>" size="30" /></label>
<br>
<br>
<label>Deporte: <select name="deporte" size="1" id="deporte" onchange="
         <?php
          $idmodal = $wpdb->get_var( "SELECT IdModalidad FROM wp_sdp_Modalidades WHERE Modalidad LIKE '%$_POST[deporte]'");
         ?>
         " > 
<option selected="selected"></option>
<option       
<?php 
        global $wpdb;
        $sql="SELECT DISTINCT Modalidad FROM  wp_sdp_Modalidades";

                    $items = $wpdb->get_results($sql);
                       
                    foreach ($items as $item)
                    {
                        print('<option>'.$item->Modalidad.'<br/>');
                         print('</option>');
                         
                    }  
     ?>
  </option>
  </select> </label>
<label>Sexo:<select name="sexo" id="sexo" size="1" onchange="
         <?php
          $idsexo = $wpdb->get_var( "SELECT IdSexo FROM wp_sdp_Sexos_equipo WHERE Sexo LIKE '%$_POST[sexo]'");
         ?>
         " >
                        <option selected="selected"></option>
                        <option>Masculino</option>
                        <option>Femenino</option>
                        <option>Mixto</option>
                    </select></label>
<br>
<br>
<br>
<strong>
<label style="font-size: 22px; background-color: #999;"><em>Para la devolución de la fianza</em></label>
</strong>
<br>
<br>
<label style="font-size: 14px;"><em>Si la persona a quien se ha de devolver la fianza, es diferente del capitán, se debe rellenar esta parte</em></label>
<br>
<br>
<label style="background-color: #999;">Nombre y apellidos:<input style="background-color: #999;" type="text" name="" size="25" value="" /></label>
<br>
<br>
<label style="background-color: #999;">DNI:<input style="background-color: #999;" type="text" name="" size="9" value="" /></label>
<br>
<br>
<label style="background-color: #999;">Correo:<input style="background-color: #999;" type="text" name="" size="35" value="" /></label>
<br>
<br>
<label>Nº de cuenta corriente <input type="text" maxlength="20" name="" size="30" value="" /></label>
<label style="font-size: 12px;"></label>
<br>
<br>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
  4 DIGITOS / 4 DIGITOS / 2 DIGITOS / 10 DIGITOS
<br>
<br>
<label>Fotocopia del recibo del pago al banco <br><br>
                        <input type="file" name="fotocopia banco" /> </label><br>
<br>
<br>
<input style="font-size: 18px;" type="submit" name="submit" value="Enviar datos" onclick="
                            
                           <?php
                           echo "<script language='javascript'> 
                               $valor = validarForm();
                                
                            </script>";
                         
                          $resul = "<script> document.write($valor) </script>";
                        
                        global $wpdb;
                           $wpdb->show_errors();
                           $wpdb->print_error();
                          
                          if (isset($_POST['submit'])){ 
                           if( $resul == true){ 
                                    
                                  $wpdb->insert( "wp_sdp_Equipos", array('IdCapitan' => $_POST["dni"],IdModalidad => $idmodal,'Nombre' => $_POST["nomape"],'IdSexo' => $idsexo,'IdCurso' => date('Y')));
                                 }
                          }
                          ?>  
                           "/>

</div>
             </form>
  </fieldset>
        <br>
        <!-- Fin de código html partir de aquí el código html de la página -->
    </div><!-- #content -->
</div><!-- #primary -->

<?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?>
?>
