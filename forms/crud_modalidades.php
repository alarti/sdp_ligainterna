<?php
/**
 *
 * @package sdp
 * @subpackage SDP Alta equipos
 * @since SDP Alta equipos 1.0
 * @Author: infaar01
 * @last_mod:16/05/2014
 */
require_once('../../../../wp-load.php');
require_once('../../../../wp-config.php');
require_once('../class/enarCRUD.class/preheader.php'); // <-- this include file MUST go first before any HTML/output
#the code for the class
include_once ('../class/enarCRUD.class/enarCRUD.class.php'); // <-- this include file MUST go first before any HTML/output

if (!is_user_logged_in() && !current_user_can('manage_options')){
    die('Si no eres administrador no puedes ver esta página.');
}

get_header();
?>
<div id="primary" class="site-content">
    <div id="content" role="main">
        <?php
        #create an instance of the class
        $tblModalidad = new enarCRUD("Modalidad", "wp_sdp_Modalidades", "IdModalidad",  "../class/enarCRUD.class/");
        $tblModalidad->insertHeader();
        
        #$tblModalidad->orientation=vertical;
        
        #show CSV export button
        $tblModalidad->showCSVExportOption();

        #set the number of rows to display (per page)
        $tblModalidad->setLimit(10);
        
        #use if you want to move the add form to the top of the page
        #$tblModalidad->displayAddFormTop();

        #set the number of rows to display (per page)
        #$tblModalidad->setLimit(10);
        
        #how you want the fields to visually display in the table header
        $tblModalidad->displayAs("TipoCompeticion", "Tipo Comp.");
        
        #set a filter box at the top of the table
        $tblModalidad->addAjaxFilterBox('Competicion');
        $tblModalidad->addAjaxFilterBox('TipoCompeticion');
        $tblModalidad->addAjaxFilterBox('CriterioEmpate');
        $tblModalidad->addAjaxFilterBox('CriterioClasificacion');
        $tblModalidad->addAjaxFilterBox('EsUniversitario');
        
        $tblModalidad->defineCheckbox("EsUniversitario", "1", "0");
        $tblModalidad->defineCheckbox("CriterioEmpate", "1", "0");
        $tblModalidad->defineCheckbox("CriterioClasificacion", "1", "0");
        
        #Finally print the table
        $tblModalidad->showTable();
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

