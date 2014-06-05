<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../../../../wp-load.php');
require_once('../../../../wp-config.php');
?>

<html>
<head>
    <title>Modalidades</title>
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
<h1>Lista de modalidades</h1>
<form name="modalidades" method="post" action="alta_equipos.php">
   
                                   <select id="modalidades" size="1" name="modalidades"
                                    <option selected="selected"></option>
                                    <option       
                                    <?php
                                    global $wpdb;
                                    $sql = "SELECT DISTINCT Modalidad,IdModalidad FROM  ". $wpdb->prefix ."sdp_Modalidades";

                                    $items = $wpdb->get_results($sql);

                                    foreach ($items as $item)
                                     {
                                    print('<option value= '.$item->Modalidad.'>'.$item->Modalidad.'<br/>');
                                    print('</option>');

                                    }
                                    ?>
                                        
                                </option>
                            </select>
    

<input type="submit" value="Seleccionar" onclick=" obtenerMod();">

</form>

</body>
</html> 