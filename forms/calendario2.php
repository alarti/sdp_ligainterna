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
<html>
    <body>
        <br>
        <fieldset style="width: 70%;margin-left: 10%;margin-right: 10%" ><legend><strong>Clasificación de partidos</strong></legend>
        <?php
         global $wpdb;
            echo "<table border=1 cellpadding=2 cellspacing=0>";
            echo "<tr>
         <tr>
         <th> ID </th><th> Nombre </th><th> Puntos </th>
         <th> Partidos jugados </th><th> Partidos ganados </th>
         <th> Partidos empatados </th><th> Partidos perdidos </th>
         <th> Goles a favor </th><th> Goles en contra </th>
      </tr>";
            $idmodal = $wpdb->get_var( "SELECT IdModalidad FROM ". $wpdb->prefix ."sdp_Modalidades WHERE Modalidad LIKE '%$_POST[modalidad]'");
            $idsexo = $wpdb->get_var( "SELECT IdSexo FROM ". $wpdb->prefix ."sdp_Sexos_equipo WHERE Sexo LIKE '%$_POST[sexo]'");
            $sql="SELECT DISTINCT Nombre,IdEquipo FROM wp_sdp_Equipos WHERE IdModalidad = $idmodal AND Grupo = $_POST[grupo] AND Division = $_POST[division] AND IdSexo = $idsexo ORDER BY OrdenGrupo ASC";

                    $items = $wpdb->get_results($sql);

                    foreach ($items as $item)
                    {
        print('<tr>');
       //echo "<tr>
        print('<td align=right>' .$item->IdEquipo. '</td>');
        print('<td>' .$item->Nombre. '</td>');
//         <td> algo </td>
//         <td> algomas </td>
//         <td> algomasmas </td>
     print('</tr>');
                        
                    }
               echo "</table>";
        ?>
        </fieldset>
    </body>
</html>

<?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?> 
