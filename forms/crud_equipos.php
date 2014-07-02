<?php
/**
 *
 * @package sdp
 * @subpackage SDP Alta equipos
 * @since SDP Alta equipos 1.0
 * @Author: infaar01
 * @last_mod:24/08/2013
 */
require_once('../../../../wp-load.php');
require_once('../../../../wp-config.php');
require_once('../class/enarCRUD.class/preheader.php'); // <-- this include file MUST go first before any HTML/output
#the code for the class
include_once ('../class/enarCRUD.class/enarCRUD.class.php'); // <-- this include file MUST go first before any HTML/output

if (!is_user_logged_in() && !current_user_can('manage_options'))
    die('Si no eres administrador no puedes ver esta página.');


get_header();
?>
<div id="primary" class="site-content">
    <div id="content" role="main">
        <fieldset style="width: 96%;margin-left: 2%;margin-right: 2%"><legend><strong>Equipos</strong></legend>
        <?php
        #create an instance of the class
        $tblEquipos = new enarCRUD("Equipos", "wp_sdp_Equipos", "IdEquipo", "../class/enarCRUD.class/");
        $tblEquipos->insertHeader();

#show CSV export button
        $tblEquipos->showCSVExportOption();

#use if you want to move the add form to the top of the page
//$tblEquipos->displayAddFormTop();

#set the number of rows to display (per page)
        $tblEquipos->setLimit(10);

#set a filter box at the top of the table
        
        $tblEquipos->addAjaxFilterBox('IdEquipo');
        $tblEquipos->addAjaxFilterBox('Nombre');
        $tblEquipos->addAjaxFilterBox('IdModalidad');
        $tblEquipos->addAjaxFilterBox('IdSexo');
        $tblEquipos->addAjaxFilterBox('Division');
        $tblEquipos->addAjaxFilterBox('Grupo');
        $tblEquipos->addAjaxFilterBox('IdCapitan');
        $tblEquipos->addAjaxFilterBox('Eliminado');
        $tblEquipos->addAjaxFilterBox('OrdenGrupo');
        $tblEquipos->addAjaxFilterBox('Comentarios');
        $tblEquipos->addAjaxFilterBox('IdCurso');
        
# establecemos en check
        $tblEquipos->defineCheckbox("Eliminado", "1", "0");
        

#i can define a relationship to another table
        #the 1st field is the fk in the table, the 2nd is the second table, the 3rd is the pk in the second table, the 4th is field i want to retrieve as the dropdown value
        #http://enarCRUD.com/api/index.php?id=defineRelationship
        //$tblEquipos->defineRelationship("IdCapitan", "wp_sdp_Jugadores", "IdJugador", "CONCAT(Nombre,' ', Apellido1,' ', Apellido2) "); //last var (sorting) is optional; see reference documentation
        $tblEquipos->defineRelationship("IdSexo", "wp_sdp_Sexos_equipo", "IdSexo", "Sexo"); //last var (sorting) is optional; see reference documentation
        $tblEquipos->defineRelationship("IdModalidad", "wp_sdp_Modalidades", "IdModalidad", "Modalidad"); //last var (sorting) is optional; see reference documentation/
        $tblEquipos->defineRelationship("IdCurso", "wp_sdp_Cursos_academicos", "IdCurso", "CursoAcademico"); //last var (sorting) is optional; see reference documentation/

//Pintamos el inicio y mostramos la tabla
//echo "<h1>Edicion CRUD Tabla:".$tblEquipos->db_table."</h1>\n";
//        $tblEquipos->setOrientation("vertical");
        $tblEquipos->showTable();

#self-defined functions used for formatFieldWithFunction

        function addDollarSign($val) {
            return "€" . $val;
        }
        ?>

        </body>
        </html>
    </div>
    <!-- Fin de código html partir de aquí el código html de la página -->
</div><!-- #content -->
</div><!-- #primary -->

<?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?>

