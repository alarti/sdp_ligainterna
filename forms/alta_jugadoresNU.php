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

?>

<script type='text/javascript'>

 function expandir_formulario() { 
     
       if ((document.datos.sexo.value !== "")){
   		xDisplay('capaexpansion','block');
	}else{
  		 xDisplay('capaexpansion', 'none');
	}
} 


 function expandir_formulario3() { 
     
       if ((document.datos.modalidad.value !== "")){
   		xDisplay('capaexpansion3','block');
                xDisplay('capaexpansion2','none');
	}else{
  		 xDisplay('capaexpansion3', 'none');
                 xDisplay('capaexpansion2','block');
	}
}

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
 }else if(datos.telefono.value.length === 0){
      datos.telefono.focus();    // Damos el foco al control
      alert('No has escrito tu telefono de contacto'); //Mostramos el mensaje
      return false; //devolvemos el foco
  }else if( !(/^\d{9}$/.test(datos.telefono.value)) ) {
      datos.telefono.focus();    // Damos el foco al control
      alert('El telefono no puede contener letras'); //Mostramos el mensaje
      return false; //devolvemos el foco
  }else if(datos.dia.value === "" || datos.mes.value === "" || datos.anio.value === ""){
      datos.dia.focus();    // Damos el foco al control
      alert('No has escrito tu fecha de nacimiento'); //Mostramos el mensaje
      return false; //devolvemos el foco 
     } else if (confirm('¿Has revisado correctamente todos los datos?')){
                     return true;
                 }else{
                   return false;
                 }

  } 

</script>

<script type='text/javascript'>
    
var xOp7Up,xOp6Dn,xIE4Up,xIE4,xIE5,xNN4,xUA=navigator.userAgent.toLowerCase();
    if(window.opera){
        var i=xUA.indexOf('opera');
            if(i !== -1){
                var v=parseInt(xUA.charAt(i+6));
                xOp7Up=v>=7;xOp6Dn=v<7;
            }
        }else if(navigator.vendor!=='KDE' && document.all && xUA.indexOf('msie')!==-1){
            xIE4Up=parseFloat(navigator.appVersion)>=4;xIE4=xUA.indexOf('msie 4')!==-1;
            xIE5=xUA.indexOf('msie 5')!==-1;
            }else if(document.layers){xNN4=true;}xMac=xUA.indexOf('mac')!==-1;function xDef(){
                for(var i=0; i<arguments.length; ++i){
                    if(typeof(arguments[i])==='undefined')
                        return false;
                }return true;
            }function xDisplay(e,s){
                if(!(e=xGetElementById(e))) 
                    return null;
                if(e.style && xDef(e.style.display)) {
                    if (xStr(s)) e.style.display = s;
                        return e.style.display;
                  }
                 return null;
             }
         function xGetElementById(e){
             if(typeof(e)!=='string')
                 return e;
             if(document.getElementById) 
                 e=document.getElementById(e);
             else if(document.all) 
                 e=document.all[e];
                    else e=null;return e;
                }  
         function xStr(s){
             for(var i=0; i<arguments.length; ++i){
                 if(typeof(arguments[i])!=='string') 
                     return false;
             }
             return true;
         }

</script>
<html>
    <body>
        
    
<div id="primary" class="site-content">
    <div id="content" role="main">
        <!-- A partir de aquí el código html de la página -->

        <br><br>
        <form method="post" name="datos" onsubmit="return validarForm(this);"> 
            <div id="capaexpansion2" style="display:block ;width: 80%;margin-left: 10%;margin-right: 10%">
        <label>Selecciona la competición en la que inscribirse: 

<select name="modalidad" size="1" id="modalidad" onclick="expandir_formulario3();" onchange="
        <?php
        global $wpdb;
         $idmodal = $wpdb->get_var( "SELECT IdModalidad FROM wp_sdp_Modalidades WHERE Modalidad LIKE '%$_POST[modalidad]'");
        ?>
        ">
 	
        <option>
<?php 
global $wpdb;
        $sql = "SELECT DISTINCT IdModalidad,Modalidad FROM  ". $wpdb->prefix ."sdp_Modalidades WHERE EsUniversitario=0";

                    $items = $wpdb->get_results($sql);

                    foreach ($items as $item)
                    {
                        print('<option>'.$item->Modalidad.'<br/>');
                         print('</option>');
                    }
?>
</option>
</select></label>
        </div>   
        <div id="capaexpansion3" style="display:none"> 
<fieldset style="width: 80%;margin-left: 10%;margin-right: 10%"><legend><strong>Inscripción de jugadores</strong></legend>
    
   
    <div> <br><br>
        <label>Nombre: <input name="nombre" type="text" size="25" /></label>
            <label>Apellidos: <input name="apellido" type="text" size="25"/></label>
<br><br>
<label>Correo electrónico: <input name="correo" type="text" size="30" /></label>
<br><br>
<label>DNI: <input name="dni" type="text" size="9" maxlength="9" /></label><label>Teléfono móvil: <input name="telefono" type="text" maxlength="9" size="9" /></label>
<br><br>Fecha de nacimiento:<label><select name="dia" id="dia" size="1">
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

<br><br>

<label> Sexo:

<select name="sexo" id="sexo" onclick="expandir_formulario();" onchange="
        <?php
        global $wpdb;
            $idsexo = $wpdb->get_var( "SELECT IdSexo FROM wp_sdp_Sexos_persona WHERE Sexo LIKE '%$_POST[sexo]'");
        ?>
        "/> 
 <option selected="selected"></option>
  <option>Hombre</option>
   <option>Mujer</option>
    </select>    </label>

<div id="capaexpansion" style="display:none">
<br>
<p><label> Selecciona el equipo:
<select name="equi" size="1">
 	<option>
            <?php 
            global $wpdb;
             $wpdb->show_errors();
           
             $sql3="SELECT Nombre FROM wp_sdp_Equipos WHERE IdModalidad = $idmodal AND EsUniversitario =0 AND IdCurso=" .date('Y'); 
         
          
                   $posts = $wpdb->get_results($sql3);

                    foreach ($posts as $post)
                    {
                        print('<option>'.$post->Nombre.'<br/>');
                         print('</option>');
                    }
?>
</option>
</select></label></p>
<br><br>

<input style="font-size: 18px;" type="submit" name="submit"  value="Inscribirse en el equipo" onclick="
       <?php
//Datos globales a todas las paginas
        global $wpdb;
        
                           echo "<script language='javascript'> 
                               $valor = validarForm();
                            </script>";
                         
                          $resul = "<script> document.write($valor) </script>";
                         
                          
                           $fecha = $_POST[anio] . "-" . $_POST[dia] . "-" . $_POST[mes];
                          
                          if (isset($_POST['submit'])){ 
                           if( $resul == true){  
                                  $wpdb->insert( "wp_sdp_Jugadores", array('Nif_Passport' => $_POST["dni"],'Nombre' => $_POST["nombre"],
                                      'Apellidos' => $_POST["apellido"],'IdSexo' => $idsexo,'TelefonoMovil' => $_POST['telefono'],
                                      'IdCurso' => date('Y'),'EsUniversitario' => $universitario,'FechaNacimiento' => $fecha,'Email' => $_POST["correo"]));
                                 }
                          }
                          
        ?>
       
       
       ">

</div></div>
    </div>
</form>
  </fieldset>

     <br>
        <!-- Fin de código html partir de aquí el código html de la página -->
    </div><!-- #content -->
</div><!-- #primary -->
</body>
</html>
<?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?>
