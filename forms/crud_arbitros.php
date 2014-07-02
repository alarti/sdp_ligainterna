<?php
/**
 *
 * @package sdp
 * @subpackage SDP Alta Arbitros
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
        <fieldset style="width: 96%;margin-left: 2%;margin-right: 2%"><legend><strong>Árbitros</strong></legend>
        <!-- A partir de aquí el código html de la página -->
        <?php
        #create an instance of the class
        $tblArbitros = new enarCRUD("Arbitros", "wp_sdp_Arbitros", "IdArbitro", "../class/enarCRUD.class/");
        ?>

        <?php
        $tblArbitros->insertHeader();

#show CSV export button
        $tblArbitros->showCSVExportOption();

#use if you want to move the add form to the top of the page
        $tblArbitros->displayAddFormTop();

#set the number of rows to display (per page)
        $tblArbitros->setLimit(10);

        #how you want the fields to visually display in the table header
        $tblArbitros->displayAs("TipoID", "Universitario");
        
#set a filter box at the top of the table
        $tblArbitros->addAjaxFilterBox('Nif_Passport');
        $tblArbitros->addAjaxFilterBox('IdCentro');
        $tblArbitros->addAjaxFilterBox('IdCurso');
        $tblArbitros->addAjaxFilterBox('EsUniversitario');

# establecemos en check
        $tblArbitros->defineCheckbox("EsUniversitario", "1", "0");
        
#allow picture to be a file upload
        $tblArbitros->setFileUpload('Foto', plugin_dir_path(__FILE__) . 'uploads/' );

#i can define a relationship to another table
        #the 1st field is the fk in the table, the 2nd is the second table, the 3rd is the pk in the second table, the 4th is field i want to retrieve as the dropdown value
        #http://enarCRUD.com/api/index.php?id=defineRelationship
        //$tblArbitros->defineRelationship("IdCapitan", "wp_sdp_Arbitros", "IdArbitro", "CONCAT(Nombre,' ', Apellido1,' ', Apellido2) ", "IdArbitro DESC"); //last var (sorting) is optional; see reference documentation
        $tblArbitros->defineRelationship("IdSexo", "wp_sdp_Sexos_equipo", "IdSexo", "Sexo"); //last var (sorting) is optional; see reference documentation
//$tblArbitros->defineRelationship("IdModalidad", "wp_sdp_Modalidades", "IdModalidad", "Modalidad"); //last var (sorting) is optional; see reference documentation/
        $tblArbitros->defineRelationship("IdCentro", "wp_sdp_Centros", "IdCentro", "Nombre"); //last var (sorting) is optional; see reference documentation/
        $tblArbitros->defineRelationship("IdCurso", "wp_sdp_Cursos_academicos", "IdCurso", "CursoAcademico"); //last var (sorting) is optional; see reference documentation/        
//Pintamos el inicio y mostramos la tabla
        //echo "<h1>Edicion CRUD Tabla:" . $tblArbitros->db_table . "</h1>\n";

        $tblArbitros->showTable();

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

