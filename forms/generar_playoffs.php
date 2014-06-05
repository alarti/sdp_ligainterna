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
<script>
 function expandir_formulario() { 
     
       if ((document.deportes.cabezas[0].checked)){
   		xDisplay('capaexpansion','block');
	}else if ((document.deportes.cabezas[1].checked)){
  		 xDisplay('capaexpansion', 'none');
	}else{
  		 xDisplay('capaexpansion', 'none');
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


<div id="primary" class="site-content">
    <div id="content" role="main">
        <!-- A partir de aquí el código html de la página -->


        <?php
//Datos globales a todas las paginas
        global $wpdb;
        $wpdb->show_errors();
        
        
//Cargamos los datos del usuario logeado en caso de que lo este en pruebas meter en un inc con clases de utilidades    
        ?><br><br>
<fieldset style="width: 80%;margin-left: 10%;margin-right: 10%" id="play" ><legend><strong>Generar playoff,copa,promoción..</strong></legend>
        <form method="post" name="deportes"><br><br>

<label>Elige modalidad para generar play offs,copa,etc...</label><br><br>
<p><select name="modalidad" size="1">
  <option selected="selected"></option>
  <option>
      <?php 
        $sql="SELECT DISTINCT Modalidad FROM wp_sdp_Modalidades";

                    $items = $wpdb->get_results($sql);

                    foreach ($items as $item)
                    {
                        print('<option>'.$item->Modalidad.'<br/>');
                         print('</option>');
                    }
?>
  </option>
</select></p>
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
<br>
<label>¿Elegir cabezas de serie?</label><br><br>
        <input type="radio" name="cabezas" value="Si" id="cabezas_0" onclick="expandir_formulario();" /> Si 
        <input type="radio" name="cabezas" value="No" id="cabezas_1" onclick="expandir_formulario();"/> No <br><br>
        
        
        <div id="capaexpansion" style="display:none">
        <p><label>Cabezas de serie:<br><br>

<select name="cabezas" size="10" multiple="multiple">
  <option selected="selected"></option>
  <option>equipo1</option>
   <option>equipo2</option>
    <option>equipo3</option>
</select></label></p>
        </div>
<p><input name="playofff" type="button" value="Generar play off" />&nbsp;&nbsp;<input name="copa" type="button" value="Generar copa"/></p>
<br><br>
<p><input name="promoción" type="button" value="Generar promoción" />&nbsp;&nbsp;<input name="rector" type="button" value="Generar trofeo rector" /></p>
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
