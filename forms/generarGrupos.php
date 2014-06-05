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
    
<script>
    
         
    function expandir_formulario() { 
     
       if ((document.gendiv.RadioGroup1[0].checked)){
   		xDisplay('capaexpansioncomp','block');
	}else if((document.gendiv.RadioGroup1[1].checked)){
  		 xDisplay('capaexpansioncomp', 'none');
	}else{
  		 xDisplay('capaexpansioncomp', 'none');
	}
} 
</script>

<script language="javascript" type="text/javascript">
    
    function modalidad() { 
        
         var name = $("select#modalidad").val();
        $nombre = ($('select[id=modal]').val());
        return name;
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

<div id="primary" class="site-content">
        <div id="content" role="main">
            <!-- A partir de aquí el código html de la página -->


            <br>
            <fieldset style="width: 70%;margin-left: 10%;margin-right: 10%" ><legend><strong>Generar divisiones y grupos</strong></legend>
             <form method="post" name="gendiv" action="<?php echo $_SERVER['PHP_SELF']; ?>"><br>
                 <p><label>Modalidad:

<select name="modalidad" id="modalidad" size="1" onchange="
                                    <?php
                                   
                                     global $wpdb;
                                    $idmodal = $wpdb->get_var( "SELECT IdModalidad FROM ". $wpdb->prefix ."sdp_Modalidades WHERE Modalidad LIKE '%baloncesto'");
                                    $numequipos = $wpdb->get_var("SELECT COUNT(*) FROM wp_sdp_Equipos WHERE IdModalidad = $idmodal AND IdCurso=" . date('Y'));
                                   
                                     ?>
                                        ">
    <option>
      <?php 
        $sql="SELECT DISTINCT Modalidad FROM wp_sdp_Modalidades";

                    $items2 = $wpdb->get_results($sql);

                    foreach ($items2 as $item)
                    {
                        print('<option>'.$item->Modalidad.'<br/>');
                         print('</option>');
                    }
                    
?>
  </option>
</select></label></p>
<p><label>Sexo:
        <select name="sexo" id="sexo" size="1" onchange="<?php
                
                ?>">
    <option></option>
    <option>Masculino  </option>
    <option>Femenino  </option>
</select></label></p>

             <p><input type="button" value="Mostrar número de equipos" onclick="mivarJS=<?php echo $numequipos ?>;alert(mivarJS);"/></p>
             
             <br>
             <label>¿Elegir cabezas de serie?</label>
      <input type="radio" name="RadioGroup1" value="Si" id="RadioGroup1_0" onclick="expandir_formulario();"/> Si
      <input type="radio" name="RadioGroup1" value="No" id="RadioGroup1_1" onclick="expandir_formulario();"/> No 
<br><br>       
   <div id="capaexpansioncomp" style="display:none">
        <p><label>Cabezas de serie: <br><br>

<select name="cabezas" size="10" multiple="multiple">
  <option selected="selected"></option>
   <option       
                                    <?php
                                    global $wpdb;
                                    $sql = "SELECT DISTINCT Nombre FROM  ". $wpdb->prefix ."sdp_Equipos WHERE IdModalidad=$idmodal AND IdCurso=" . date('Y');

                                    $items = $wpdb->get_results($sql);
$sql = "SELECT IdEquipo FROM  ". $wpdb->prefix ."sdp_Equipos WHERE IdModalidad = $idmodal AND IdCurso=" . date('Y');

         $equipos = $wpdb->get_results($sql);
         $output = array_slice($equipos, 0,3);//Muestra los 3 primeros
        // $output = array_slice($equipos, 3);//Muestra los 3 ultimos
        $claves = array_keys($equipos);
                                    foreach ($output as $item)
                                    {
//                                    print('<option>'.$item->Nombre.'<br/>');
//                                    print('</option>');
                                    print('<option>'.$item->IdEquipo.'<br/>');
                                    print('</option>');

                                    }
                                    ?>
                                </option>
</select></label></p>
   </div>  
<label>Introduce la división y el grupo para generar las divisiones y grupos</label><br><br>
      <p>División: <input type="text" id='division' name="division" size="2"/>&nbsp;&nbsp; Grupo:<input type="text" id="grupo" name="grupo" size="2"/></p>
 
      
<p><input name="grupos" type="submit" value="Generar divisiones y grupos" onclick="
          <?php
          global $wpdb;
          
        
           
         $sql = "SELECT IdEquipo FROM  ". $wpdb->prefix ."sdp_Equipos WHERE IdModalidad = $idmodal AND IdCurso=" . date('Y');

         $equipos = $wpdb->get_results($sql);
        $claves = array_keys($equipos);
        echo $frutas[$claves[1]]; // imprime la segunda posicion del array
     //Código a desarrollar para que genere los grupos    
    
    $numEquipos = $numequipos;
    $equiposPorAsignar = 0;
    $numDivisiones = $_POST["division"];
    $numGruposPorDivision = $_POST["grupo"];
    $numGruposTotal = 0;
    $enCadaDivision = 0;
    $enCadaGrupo = 0;
    $i = 0;
    $j = 0;
    $h = 1;
    $q = 1;
    
    $numGruposTotal = $numDivisiones * $numGruposPorDivision;
    $enCadaGrupo = $numEquipos/$numGruposTotal;
    $enCadaDivision = $numEquipos/$numDivisiones;
   // $equiposPorAsignar = $numEquipos%$numGruposTotal;
   $equiposPorAsignar = 6;
   
  //$item->IdEquipo
    foreach ($equipos as $item) {
         $wpdb->update("wp_sdp_Equipos", array('division'=>  $numDivisiones,'grupo'=>$numGruposPorDivision),array( 'IdEquipo'=> $equipos[$claves[1]] ));
    }
        
//    for($i=0;$i<=$numDivisiones;$i++){
//       
//        for($j=0;$j<=$numGruposPorDivision;$j++){
//            if($equiposPorAsignar != 0){
//                  $wpdb->update("wp_sdp_Equipos", array('division'=> $h,'grupo'=>$q),array( 'IdEquipo' =>  $equipos[j]));
//                  $equiposPorAsignar = $equiposPorAsignar - 1;
//                  $q++;
//                }
//                                         
//        }
//        $h++;
//     }
         
 
          ?>
          
          "/></p>
 <p>
      <?php 
            $anio= date('Y');
            echo"<a href='http://ulelin.unileon.es/wp-content/plugins/sdp_ligainterna/forms/crud_divisiones.php?IdModalidad=$idmodal&IdSexo=1&IdCurso=$anio')> Mostrar divisiones y grupos generadas</p>
         </a>"?><br/>
         
             </form>
        </fieldset>
         </div>
    
    </div>
</html>
  <?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?> 
  