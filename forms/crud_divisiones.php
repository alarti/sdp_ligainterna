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

require_once('../class/enarCRUD.class/preheader.php'); // <-- this include file MUST go first before any HTML/output
#the code for the class
include_once ('../class/enarCRUD.class/enarCRUD.class.php'); // <-- this include file MUST go first before any HTML/output

if (!is_user_logged_in() && !current_user_can('manage_options'))
    die('Si no eres administrador no puedes ver esta página.');


get_header();
?>
<div id="primary" class="site-content">
    <div id="content" role="main">
<fieldset style="width: 96%;margin-left: 2%;margin-right: 2%"><legend><strong>Divisiones</strong></legend>
        <!-- A partir de aquí el código html de la página -->
        <?php
        #create an instance of the class
        $tblDivEquipos = new enarCRUD("ModEquipos", "wp_sdp_Equipos", "IdEquipo", "../inc/enarCRUD/");
        $tblDivEquipos->setLimit(10);
        #disable deletes
        $tblDivEquipos->disallowDelete();        
        
        $tblDivEquipos->disallowAdd();               
        
        #Disable some fields
        $tblDivEquipos->omitField("IdSexo");
        $tblDivEquipos->omitField("IdModalidad");
        $tblDivEquipos->omitField("IdCapitan");
        $tblDivEquipos->omitField("Eliminado");
        $tblDivEquipos->omitField("Comentarios");
        $tblDivEquipos->omitField("IdCurso");
        
        #Disable edits some fields       
        $tblDivEquipos->disallowEdit("Nombre");
        
        
        #Selection of division and group
        $tblDivEquipos->defineRelationship("Division", "(select distinct division from wp_sdp_Equipos where division is not null) dtv", "Division", "Division");
        $tblDivEquipos->defineRelationship("Grupo", "(select distinct grupo from wp_sdp_Equipos where grupo is not null) dtv", "Grupo", "Grupo");
        
        #Add some filters
        echo "Filtrando Modalidad=".$IdModalidad = $_GET['IdModalidad']."<br>";
        echo "Filtrando Sexo=" .$IdSexo = $_GET['IdSexo']."<br>";
        echo "Filtrando Curso=".$IdCurso= $_GET['IdCurso']."<br>";
        
        #$tblDivEquipos->addWhereClause(" where IdModalidad='3' and IdSexo='1' and Eliminado='0' and IdCurso='2013'");
        //$tblDivEquipos->addWhereClause(" where IdModalidad='".$IdModalidad."' and IdSexo='".$IdSexo."' and Eliminado='0' and IdCurso='".$IdCurso."2013'");
        $tblDivEquipos->addWhereClause(" where IdModalidad='3' and IdSexo='1' and Eliminado='0' and IdCurso='".$IdCurso."2013'");
        #Finally print the table
        $tblDivEquipos->showTable();
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

