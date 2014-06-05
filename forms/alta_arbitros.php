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
  
if(datos.dni.value.length === 0){
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
 }else if(datos.sexo.value === "" ) { //¿Tiene 0 caracteres?
    datos.deporte.focus();    // Damos el foco al control
    alert('No has seleccionado un sexo'); //Mostramos el mensaje
    return false; //devolvemos el foco
}else if(datos.telefono.value.length === 0){
      datos.telefono.focus();    // Damos el foco al control
      alert('No has escrito tu telefono de contacto'); //Mostramos el mensaje
      return false; //devolvemos el foco
   }else if( isNaN( datos.telefono.value) ){
      datos.telefono.focus();    // Damos el foco al control
      alert('El telefono no puede contener letras'); //Mostramos el mensaje
      return false; //devolvemos el foco 
  }else if(datos.dia.value === "" || datos.mes.value === "" || datos.anio.value === ""){
      datos.dia.focus();    // Damos el foco al control
      alert('No has escrito tu fecha de nacimiento'); //Mostramos el mensaje
      return false; //devolvemos el foco 
  }else if(datos.universitario.value === ""){
      datos.universitario.focus();    // Damos el foco al control
      alert('No has seleccionado si eres universitario'); //Mostramos el mensaje
      return false; //devolvemos el foco 
  }else if(datos.domicilio.value.length === 0){
     datos.domicilio.focus();
     alert('No has escrito tu domicilio');
     return false;
  }else if(datos.cp.value.length === 0){
       datos.cp.focus();
     alert('No has escrito el codigo postal');
     return false; 
     }else if( isNaN( datos.cp.value) ){
      datos.cp.focus();    // Damos el foco al control
      alert('El codigo postal no puede contener letras'); //Mostramos el mensaje
      return false; //devolvemos el foco
    }else if(datos.localidad.value.length === 0){
       datos.localidad.focus();
     alert('No has escrito tu localidad');
     return false; 
    }else if(datos.provincia.value.length === 0){
       datos.provincia.focus();
     alert('No has escrito tu provincia');
     return false; 
     } else if (confirm('¿Has revisado correctamente todos los datos?')){
                     return true;
                 }else{
                   return false;
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
        <fieldset style="width: 80%;margin-left: 10%;margin-right: 10%"><legend><strong>Alta arbitros</strong></legend>
             <form method="post" name="datos" onsubmit="return validarForm(this);">
<div>
    <br>
    <br>
    <label>Nombre y apellidos:<input type="text" name="nomape" size="25" value="<?php echo($setNombreApellido) ?>" /> </label>
                    <br>
                    <br>
                   <label>DNI: <input name="dni" type="text" size="9" maxlength="9" /></label>
Fecha de nacimiento:<label><select name="dia" id="dia" size="1">
                        <option selected="selected"></option>
                        <option       
            <?php 
                               
                    for ($i = 1; $i <= 31; $i++) {
                        print('<option>' .$i. '<br/>');
                        print('</option>');
                         
                    }  
     ?>
  </option>
                    </select></label>
                    <label><select name="mes" id="mes" size="1">
                        <option selected="selected"></option>
                        <option       
            <?php 
                               
                    for ($i = 1; $i <= 12; $i++) {
                        print('<option>' .$i. '<br/>');
                        print('</option>');
                         
                    }  
     ?>
  </option>
                    </select></label>
                    <label><select name="anio" id="anio" size="1">
                        <option selected="selected"></option>
                        <option       
            <?php 
                               
                    for ($i = 1980; $i <= 2000; $i++) {
                        print('<option>' .$i. '<br/>');
                        print('</option>');
                         
                    }  
     ?>
  </option>
                    </select></label>
<label> Es universitario:

<select name="universitario" id="universitario" onchange="
        <?php
            if($_POST[universitario] == "Si"){
                $universitario = 1;
            }else{
                $universitario = 0;
            }
        
        ?>"/> 
 <option selected="selected"></option>
  <option>Si</option>
   <option>No</option>
    </select>    </label>
<br><br>
<label>Domicilio familiar: <input name="Domicilio" type="text" size="40" /></label><label> Codigo postal: <input name="cp" type="text" maxlength="5" size="5"/></label>
<br><br>
<label>Localidad: <input name="localidad" type="text" size="10"/></label> <label>Provincia: <input name="provincia" type="text" size="10"/></label><label>Teléfono de contacto: <input name="telefono" type="text" maxlength="9" size="9" /></label>
<br><br>
<label>Correo electrónico(de la Universidad) : <input type="text" size="35" name="correo" value="<?php echo($current_user->user_email); ?>" size="30" /></label>
<br>
<br>
<label> Indicar si tiene concedida  alguna beca de colaboración con la ULE en el curso actual:

<select name="beca" id="beca" onchange="
        <?php
            if($_POST[beca] == "Si"){
                $beca = 1;
            }else{
                $beca = 0;
            }
        
        ?>"/> 
 <option selected="selected"></option>
  <option>Si</option>
   <option>No</option>
    </select>    </label>

<br><br>
<label> Indicar si es arbitro federado:

<select name="federado" id="federado" onchange="
        <?php
            if($_POST[federado] == "Si"){
                $federado = 1;
            }else{
                $federado = 0;
            }
        
        ?>"/> 
 <option selected="selected"></option>
  <option>Si</option>
   <option>No</option>
    </select>    </label>

<br><br>
<label>Deporte: <select name="deporte" size="1" id="deporte"> 
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
  </select> </label> <label> Sexo:

<select name="sexo" id="sexo"/> 
 <option selected="selected"></option>
  <option>Masculino</option>
   <option>Femenino</option>
    </select>    </label>

<br><br>
<strong>
<label style="font-size: 22px; background-color: #999;"><em>Datos bancarios</em></label>
</strong>
<br>
<br>
<label>El importe de los arbitrajes se ingresará mediante transferencia bancaria</label>
<br>
<br>
<label>Entidad bancaria:<input type="text" name="entidad" size="25" value="" /></label>
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
<input style="font-size: 18px;" type="submit" name="submit" value="Enviar datos" onclick="
                            
                           <?php
                           echo "<script language='javascript'> 
                               $valor = validarForm();
                                
                            </script>";
                         
                          $resul = "<script> document.write($valor) </script>";
                        $fecha = $_POST[anio] . "-" . $_POST[dia] . "-" . $_POST[mes];
                        global $wpdb;
                           $wpdb->show_errors();
                           $wpdb->print_error();
                          
                          if (isset($_POST['submit'])){ 
                           if( $resul == true){ 
                                    
                                  $wpdb->insert( "wp_sdp_Arbitros", array('Nif_Passport' => $_POST["dni"],'Nombre' => $current_user->user_firstname,
                                      'Apellidos' => $current_user->user_lastname,'Direccion' => $_POST[Domicilio],'Email' => $_POST["correo"],'EntidadBancaria' => $_POST["entidad"],
                                      'Localidad' => $_POST[localidad],'Provincia' => $_POST["provincia"],'CodPostal' => $_POST["cp"],'TelefonoMovil' => $_POST['telefono'],
                                      'IdCurso' => date('Y'),'FechaNacimiento' => $fecha,'EsUniversitario' => $universitario,'Sexo' => $_POST[sexo]));
                                 
                              
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
