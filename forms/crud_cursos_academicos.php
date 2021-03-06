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
        $tblCursos_academicos = new enarCRUD("Cursos_academicos", "wp_sdp_Cursos_academicos", "IdCurso", "../class/enarCRUD.class/");
        ?>

        <?php
        $tblCursos_academicos->insertHeader();

#show CSV export button
        $tblCursos_academicos->showCSVExportOption();

#use if you want to move the add form to the top of the page
        $tblCursos_academicos->displayAddFormTop();

#set the number of rows to display (per page)
        $tblCursos_academicos->setLimit(10);
        $tblCursos_academicos->addAjaxFilterBox('IdCurso');
        $tblCursos_academicos->addAjaxFilterBox('CursoAcademico');

        $tblCursos_academicos->showTable();

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

