<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('../../../../wp-load.php');
require_once('../../../../wp-config.php');
global $wpdb;
 $v1= $_POST['modalidades'];

 $id = $wpdb->get_var( "SELECT IdModalidad FROM wp_sdp_Modalidades WHERE Modalidad LIKE '%$v1'");
 $sqlNombres = "SELECT Nombre FROM ".$wpdb->prefix . "sdp_Equipos WHERE IdModalidad = $id AND EsUniversitario =0 AND IdCurso=" .date('Y');
                                
?>

<html>
    <head>
    <title>pasado.php</title>
    <script type='text/javascript' src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
function obtenerMod(){
    var modal = $('select[id=modalidades]').val();
    opener.document.datos.modalida.value = modal;
    window.close();
}
</script>
</head>

<body>
<h1>Lista de equipos</h1>
<form name="pasado">
<div id="capaexpansion">
                        <?php
                        global $wpdb;
                        $curso_ant = $wpdb->get_var("SELECT DISTINCT CursoAcademico FROM " . $wpdb->prefix . "sdp_Cursos_academicos where IdCurso=" . date('Y'));
                        print "<label>Nombre durante el curso {$curso_ant}</label><br>";
                        ?> 
                        <br>
                        <select name="nom" id="nom" size="1" onclick="expandir_formulario2();" onchange="
                                <?php
                                global $wpdb;
                                $idsexo = $wpdb->get_var( "SELECT IdSexo FROM wp_sdp_Equipos WHERE Nombre LIKE '%$_POST[nom]'");
                                $division = $wpdb->get_var( "SELECT Division FROM wp_sdp_Equipos WHERE Nombre LIKE '%$_POST[nom]'");
                                $grupo = $wpdb->get_var( "SELECT Grupo FROM wp_sdp_Equipos WHERE Nombre LIKE '%$_POST[nom]'");
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
</form>
</body>
</html>