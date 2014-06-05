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
<script type='text/javascript' src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <script>

        function expandir_formulario() {

            if (document.datos.verificacion.checked) {
                xDisplay('capaexpansion', 'block');
                $( "#" ).val();
            } else if (document.datos.verif.checked) {
                xDisplay('capaexpansion', 'block');
            } else
                xDisplay('capaexpansion', 'none');
        }

        function expandir_formulario2() {

            if (document.datos.nom.value !== "") {
                xDisplay('capaexpansion2', 'block');
            } else {
                xDisplay('capaexpansion2', 'none');
            }

        }

        function habilitar() {
            if (document.datos.TipoDni.value !== "") {
                document.datos.dni.hidden = false;
            } else {
                document.datos.dni.hidden = true;
            }
        }
        
        function pregunta(){
            if (confirm('¿Estas seguro de enviar este formulario?')){
                return true;
            }else{
                return false;
             }
        }
        
       function validarForm() {
            
            veces=1;
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
           
            } else if (datos.dni.value.length === 0) {
                datos.dni.focus();    // Damos el foco al control
                alert('No has escrito tu dni'); //Mostramos el mensaje
                return false; //devolvemos el foco
            } else if (letra !== let) {
                datos.dni.focus();    // Damos el foco al control
                alert('Dni erroneo'); //Mostramos el mensaje
                return false; //devolvemos el foco
                } else if (datos.nomequip.value.length === 0) { //¿Tiene 0 caracteres?
                datos.nomequip.focus();    // Damos el foco al control
                alert('No has escrito el nombre del equipo'); //Mostramos el mensaje
                return false; //devolvemos el foco
                } else if (datos.modalidad.value === "") { //¿Tiene 0 caracteres?
                datos.modalidad.focus();    // Damos el foco al control
                alert('No has seleccionado una modalidad'); //Mostramos el mensaje
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
    
<!--    <script type="text/javascript">
$(document).ready(function(){
    $("select[name=modalidad]").change(function(){
            alert($('select[id=modalidad]').val());
            var id = $('select[id=modalidad]').val();
             $('input[name=id]').val($(this).val());
        });
    
});
</script>-->

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
             
             
      var miPopup;
function abreVentana(){
    miPopup = window.open("modalidad.php","miwin","width=300,height=200,scrollbars=no");
    miPopup.focus();
}      

var miPopup2;
function abreVentana2(){
    miPopup2 = window.open("pasado.php","miwin","width=300,height=250,scrollbars=yes");
    miPopup2.focus();
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

            $current_user = wp_get_current_user();
            $setNombreApellido = $current_user->user_firstname . " " . $current_user->user_lastname;
            ?>
            <br><br>
            <fieldset style="width: 80%;margin-left: 10%;margin-right: 10%" id="dat" onmouseover="mostrar();" ><legend><strong>Inscripción de equipos</strong></legend>
                <form method="post" name="datos" onsubmit="return validarForm(this);" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                    <div  width="50%">
                        <br>
                        <br>
                        <label>Nombre y apellidos del capitán:<input type="text" name="NombreApellido" size="30" value="<?php echo($setNombreApellido) ?>"/></label><br>
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
<!--                        <p><label>Modalidad:	<input type=text name=modalida id="modalida" size=18 onchange="<?php 
                        
//                            $modalidad = "baloncesto";
//                           $id = $wpdb->get_var( "SELECT IdModalidad FROM wp_sdp_Modalidades WHERE Modalidad LIKE '%$modalidad'");
//                            $sqlNombres = "SELECT Nombre FROM ".$wpdb->prefix . "sdp_Equipos WHERE IdModalidad = $id AND EsUniversitario =1 AND IdCurso=" .date('Y');
//                                        
                                    ?>"> 	<input type="Button" value="?" onclick="abreVentana()"> </label></p>-->
                        <p><label>Modalidad:

                                <select name="modalidad" size="1" id="modalidad" onchange="var modalidad = $('#modalidad option:selected').text();
                                    <?php
                                   global $wpdb;
                                   
                                  
//                                   $modalidad = $_REQUEST['modalidad'];
//                                   
//                                   $id = $wpdb->get_var( "SELECT IdModalidad FROM wp_sdp_Modalidades WHERE Modalidad LIKE '%modalidad'");
//                                     ?>
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
                    <br>
<!--                    <p><input type="button" value="Mostrar id" onclick="obtenerId();"/></p>
                    <p><input type="text" name="id" id='id' maxlength="15" size="18"/> <label style="font-size: 14px;"></label></p>
                    -->
                    <label style="font-size: 14px;"><em>(Si el equipo estaba en el curso pasado y desea cambia de nombre seleccione el nombre anterior y marque la casilla)</em><input type="checkbox" name="verificacion" id="verificacion" onclick="expandir_formulario();"/></label>
                    <br>
                    <br>
                    <label style="font-size: 14px;"><em>(Si el equipo estaba en el curso pasado y desea consevar el nombre seleccione el nombre anterior marque la casilla)</em><input type="checkbox" name="verif" id="verif" onclick="expandir_formulario();"></label>
                    <br><br> 
                    <div id="capaexpansion" style="display:none">
                        <?php
                        $curso_ant = $wpdb->get_var("SELECT DISTINCT CursoAcademico FROM " . $wpdb->prefix . "sdp_Cursos_academicos where IdCurso=" . date('Y'));
                        print "<label>Nombre durante el curso {$curso_ant}</label><br>";
                        ?> 
                        <br>
                        <select name="nom" id="nom" size="1" onclick="expandir_formulario2();" onchange="
                                <?php
                                global $wpdb;
                                $idsexo = $wpdb->get_var( "SELECT IdSexo FROM wp_sdp_Equipos WHERE Nombre LIKE '%prueba2'");
                                $division = $wpdb->get_var( "SELECT Division FROM wp_sdp_Equipos WHERE Nombre LIKE '%prueba2'");
                                $grupo = $wpdb->get_var( "SELECT Grupo FROM wp_sdp_Equipos WHERE Nombre LIKE '%prueba2'");
                                ?>
                                ">
                            <option>
                 
                                <?php
                                global $wpdb;
                               
                                 $items = $wpdb->get_results($sqlNombres);

                                foreach ($items as $item) {
                                    
                                print('<option>' . $item->Nombre . '');
                                print('</option>');
                                }
                                ?>
                            </option>
                        </select>

                        <div id="capaexpansion2" style="display:none">
                            <br>

                            Sexo:<input type="text" name="" size="8" value="<?php echo $idsexo ?>" disable="true"/>División: <input type="text" name="" size="8" value="<?php echo $division ?>" /> Grupo: <input type="text" name="" size="8" value="<?php echo $grupo ?>"/><br>
                        </div> </div>
                    <br>
                    <strong>
                        <label style="font-size: 22px; background-color: #999;"><em>Para la devolución de la fianza</em></label><br>
                    </strong>
                    <br>
                    <br>
                    <label style="font-size: 14px;"><em>Si la persona a quien se ha de devolver la fianza, es diferente del capitán, se debe rellenar esta parte</em></label><br>
                    <br>
                    <label style="background-color: #999;">Nombre y apellidos:<input style="background-color: #999;" type="text" name="nomape2" size="40"/></label>
                    <br>
                    <br>
                    <label style="background-color: #999;">DNI:</label><input style="background-color: #999;" type="text" name="dni2" size="10"/><br>
                    <br>
                    <label style="background-color: #999;">Correo:<input style="background-color: #999;" type="text" name="correo2" size="35"/></label>
                    <br>
                    <br>
                    <label>Nº de cuenta corriente <input type="text" maxlength="20" name="" size="30" value="" /></label>
                    <label style="font-size: 12px;"></label>
                    <br>
                    <br>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    4 DIGITOS / 4 DIGITOS / 2 DIGITOS / 10 DIGITOS
                    <br><br>
                    <label>Fotocopia del recibo del pago al banco <br><br>
                        <input type="file" name="fotocopia banco" /> </label><br>
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
                              
                              //$modalidad = $_REQUEST['modalidad'];
                              $id = $wpdb->get_var( "SELECT IdModalidad FROM wp_sdp_Modalidades WHERE Modalidad LIKE '$_REQUEST'modalidad''");
//                                    
                           if( $resul == true){
                             
                              if(isset($_REQUEST['verificacion'])){

                           $sql=$wpdb->insert( "wp_sdp_Equipos", array('IdCapitan' => $_POST["dni"], IdModalidad => $id, 'Nombre' => $_POST["nomequip"], 'Grupo' => $grupo, 'Division' => $division, 'IdSexo' => $idsexo,'EsUniversitario' => 1 ,'IdCurso' => date('Y')));
                               $result = mysql_query($sql);
                                     
                           }else if(isset($_REQUEST['verif'])){

                           $wpdb->insert( "wp_sdp_Equipos", array('IdCapitan' => $_POST["dni"], IdModalidad => $id, 'Nombre' => $_POST[nom], 'Grupo' => $grupo, 'Division' => $division, 'IdSexo' => $idsexo,'EsUniversitario' => 1 , 'IdCurso' => date('Y')));
                           
                           
                           }else{
                           
                               $wpdb->insert( "wp_sdp_Equipos", array('IdCapitan' => $_POST["dni"], IdModalidad => $wpdb->get_var("SELECT IdModalidad FROM wp_sdp_Modalidades WHERE Modalidad LIKE '$_REQUEST[modalidad]"), 'Nombre' => $_POST["nomequip"],'EsUniversitario' => 1 , 'IdCurso' => date('Y')));
                           }
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
 </body>
  </html> 
<?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?>
 