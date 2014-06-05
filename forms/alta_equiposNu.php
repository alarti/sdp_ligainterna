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


    
    <script type='text/javascript'>

 function expandir_formulario() { 
     
       if ((document.datos.modalidad.value !== "")){
   		xDisplay('capaexpansion','block');
                xDisplay('capaexpansion2','none');
	}else{
  		 xDisplay('capaexpansion', 'none');
                 xDisplay('capaexpansion2','block');
	}
} 

              
        function habilitar() {
            if (document.datos.TipoDni.value !== "") {
                document.datos.dni.hidden = false;
            } else {
                document.datos.dni.hidden = true;
            }
        }
        
          function habilitar2() {
            if (document.datos.univer.value === "Si") {
                document.primary.hidden = false;
            } else {
                document.primary.hidden = true;
            }
        }

        function validarForm() {

            dni = datos.dni.value;
            numero = dni.substr(0, dni.length - 1);
            let = dni.substr(dni.length - 1, 1);
            numero = numero % 23;
            letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
            letra = letra.substring(numero, numero + 1);

            if (datos.TipoDni.value === "") {
                datos.TipoDni.focus();    // Damos el foco al control
                alert('No has seleccionado el tipo de documento'); //Mostramos el mensaje
                return false; //devolvemos el foco
            } else if (datos.nomequip.value.length === 0) { //¿Tiene 0 caracteres?
                datos.nomequip.focus();    // Damos el foco al control
                alert('No has escrito tu nombre'); //Mostramos el mensaje
                return false; //devolvemos el foco
            } else if (datos.dni.value.length === 0) {
                datos.dni.focus();    // Damos el foco al control
                alert('No has escrito tu dni'); //Mostramos el mensaje
                return false; //devolvemos el foco
            } else if (letra !== let) {
                datos.dni.focus();    // Damos el foco al control
                alert('Dni erroneo'); //Mostramos el mensaje
                return false; //devolvemos el foco
            } else if (confirm('¿Has revisado correctamente todos los datos?')){
                     return true;
                 }else{
                   return false;
                 }

        }


        function mostrar() {

            fecha = new Date();
            fecha.getDate();

            nodo = document.getElementById("dat");

            if (fecha.getDate() === 13 && fecha.getMonth() === 5 && fecha.getFullYear() === 2014) {
                nodo.setAttribute('hidden', 'true');
            }

        }

    </script>

    <script type='text/javascript'>

        var xOp7Up, xOp6Dn, xIE4Up, xIE4, xIE5, xNN4, xUA = navigator.userAgent.toLowerCase();
        if (window.opera) {
            var i = xUA.indexOf('opera');
            if (i !== -1) {
                var v = parseInt(xUA.charAt(i + 6));
                xOp7Up = v >= 7;
                xOp6Dn = v < 7;
            }
        } else if (navigator.vendor !== 'KDE' && document.all && xUA.indexOf('msie') !== -1) {
            xIE4Up = parseFloat(navigator.appVersion) >= 4;
            xIE4 = xUA.indexOf('msie 4') !== -1;
            xIE5 = xUA.indexOf('msie 5') !== -1;
        } else if (document.layers) {
            xNN4 = true;
        }
        xMac = xUA.indexOf('mac') !== -1;
        function xDef() {
            for (var i = 0; i < arguments.length; ++i) {
                if (typeof(arguments[i]) === 'undefined')
                    return false;
            }
            return true;
        }
        function xDisplay(e, s) {
            if (!(e = xGetElementById(e)))
                return null;
            if (e.style && xDef(e.style.display)) {
                if (xStr(s))
                    e.style.display = s;
                return e.style.display;
            }
            return null;
        }
        function xGetElementById(e) {
            if (typeof(e) !== 'string')
                return e;
            if (document.getElementById)
                e = document.getElementById(e);
            else if (document.all)
                e = document.all[e];
            else
                e = null;
            return e;
        }
        function xStr(s) {
            for (var i = 0; i < arguments.length; ++i) {
                if (typeof(arguments[i]) !== 'string')
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


            <?php
//Datos globales a todas las paginas
            global $wpdb;
            $wpdb->show_errors();


//Cargamos los datos del usuario logeado en caso de que lo este en pruebas meter en un inc con clases de utilidades

           
            ?>
            <br>
            <form method="post" id="dat" name="datos"  onsubmit="return validarForm(this);"> 
            <div id="capaexpansion2" style="display:block ;width: 80%;margin-left: 10%;margin-right: 10%">
                <p><label>Selecciona la competición en la que participar:

                    <select name="modalidad" size="1" id="modalidad" onclick="expandir_formulario();" onchange="
                                    <?php
                                    global $wpdb;
                                     $idmodal = $wpdb->get_var( "SELECT IdModalidad FROM wp_sdp_Modalidades WHERE Modalidad LIKE '%$_POST[modalidad]'");
                                     ?>
                                        ">

                                    <option selected="selected"></option>
                                    <option       
                                    <?php
                                    global $wpdb;
                                    $sql = "SELECT DISTINCT Modalidad FROM  ". $wpdb->prefix ."sdp_Modalidades WHERE EsUniversitario=0";

                                    $items = $wpdb->get_results($sql);

                                    foreach ($items as $item)
                                     {
                                    print('<option>'.$item->Modalidad.'<br/>');
                                    print('</option>');

                                    }
                                    ?>
                                </option>
                            </select></label></p>
            </div>    
           <div id="capaexpansion" style="display:none">
            <fieldset style="width: 80%;margin-left: 10%;margin-right: 10%" id="dat" onmouseover="mostrar();" ><legend><strong>Inscripción de equipos</strong></legend>
              
                

                    <div  width="50%">
                        <br>
                        <br>
                        <label>Nombre y apellidos del capitán:<input type="text" name="NombreApellido" size="30"/></label><br>
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
                        <label>Correo electrónico(de la Universidad) :<input type="text" size="35" value="<?php echo($current_user->user_email); ?>"/></label>
                        <br>
                        <br>
                        <label>Nombre del equipo: <input type="text" name="nomequip" maxlength="15" size="18"/> <label style="font-size: 14px;"><em>(Máximo 15 caracteres)</em></label></label>
                        <br>
                        <br>
                        <label> Sexo:

<select name="sexo" id="sexo" onchange="
        <?php
                            global $wpdb;
                           
            $idsexo = $wpdb->get_var( "SELECT IdSexo FROM ". $wpdb->prefix ."sdp_Sexos_equipo WHERE Sexo LIKE '%$_POST[sexo]'");
            
            ?>
        "/> 
 <option selected="selected"></option>
  <option>Masculino</option>
   <option>Femenino</option>
    </select>    </label>
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
                            
                               $wpdb->insert( "wp_sdp_Equipos", array('IdCapitan' => $_POST["dni"],'IdSexo'=>$idsexo ,'IdModalidad' => $idmodal, 'Nombre' => $_POST["nomequip"],'EsUniversitario' => 0 , 'IdCurso' => date('Y')));
                               $result = mysql_query($sql);
                                 if (! $result){

                                        echo "La consulta SQL contiene errores.".mysql_error();

                                            exit();

                                    }else{
                                        echo "<center><font color=’RED’>DATOS INSERTADOS CORRECTAMENTE</font><a

                                                ref=’#'>Volver</a>";

                                }
                           }
                           }
                          
                            ?>">
                               <br>
                </div>
            </fieldset></div></form>
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

 
 