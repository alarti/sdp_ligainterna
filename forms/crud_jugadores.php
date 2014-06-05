<?php
/**
 *
 * @package sdp
 * @subpackage SDP Alta jugadores
 * @since SDP Alta jugadores 1.0
 * @Author: infaar01
 * @last_mod:24/08/2013
 */
require_once('../../../../wp-load.php');
//require_once('../../../../wp-config.php');


require_once('../class/enarCRUD.class/preheader.php'); // <-- this include file MUST go first before any HTML/output
#the code for the class
include_once ('../class/enarCRUD.class/enarCRUD.class.php'); // <-- this include file MUST go first before any HTML/output

if (!is_user_logged_in() && !current_user_can('manage_options'))
    die('Si no eres administrador no puedes ver esta página.');

get_header();
?>
<div id="primary" class="site-content">
    <div id="content" role="main">
        <!-- A partir de aquí el código html de la página -->
        <?php
        #create an instance of the class
        $tblJugadores = new enarCRUD("Jugadores", "wp_sdp_Jugadores", "IdJugador", "../class/enarCRUD.class/");
        ?>

        <?php
        $tblJugadores->insertHeader();

#show CSV export button
        $tblJugadores->showCSVExportOption();

#use if you want to move the add form to the top of the page
        $tblJugadores->displayAddFormTop();

#set the number of rows to display (per page)
        $tblJugadores->setLimit(10);

        #how you want the fields to visually display in the table header
        $tblJugadores->displayAs("TipoID", "Universitario");
        
#set a filter box at the top of the table
        $tblJugadores->addAjaxFilterBox('Nif_Passport');
        $tblJugadores->addAjaxFilterBox('IdCentro');
        $tblJugadores->addAjaxFilterBox('IdCurso');
        $tblJugadores->addAjaxFilterBox('EsUniversitario');

# establecemos en check
        $tblJugadores->defineCheckbox("EsUniversitario", "1", "0");
        
#allow picture to be a file upload
        $tblJugadores->setFileUpload('Foto', plugin_dir_path(__FILE__) . 'uploads/' );

#i can define a relationship to another table
        #the 1st field is the fk in the table, the 2nd is the second table, the 3rd is the pk in the second table, the 4th is field i want to retrieve as the dropdown value
        #http://enarCRUD.com/api/index.php?id=defineRelationship
        //$tblJugadores->defineRelationship("IdCapitan", "wp_sdp_Jugadores", "IdJugador", "CONCAT(Nombre,' ', Apellido1,' ', Apellido2) ", "IdJugador DESC"); //last var (sorting) is optional; see reference documentation
        $tblJugadores->defineRelationship("IdSexo", "wp_sdp_Sexos_equipo", "IdSexo", "Sexo"); //last var (sorting) is optional; see reference documentation
//$tblJugadores->defineRelationship("IdModalidad", "wp_sdp_Modalidades", "IdModalidad", "Modalidad"); //last var (sorting) is optional; see reference documentation/
        $tblJugadores->defineRelationship("IdCentro", "wp_sdp_Centros", "IdCentro", "Nombre"); //last var (sorting) is optional; see reference documentation/
        $tblJugadores->defineRelationship("IdCurso", "wp_sdp_Cursos_academicos", "IdCurso", "CursoAcademico"); //last var (sorting) is optional; see reference documentation/        
//Pintamos el inicio y mostramos la tabla
        //echo "<h1>Edicion CRUD Tabla:" . $tblJugadores->db_table . "</h1>\n";

        $tblJugadores->showTable();

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

