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
wp_enqueue_script('jquery');

?>

<html>
    
    <br>
<body>
<fieldset style="width: 80%;margin-left: 10%;margin-right: 10%"><legend><strong>Certificado de participación</strong></legend>
<form name="equipos" method="post">
    <?php
    global $wpdb;
    $curso_ant = $wpdb->get_var("SELECT DISTINCT CursoAcademico FROM " . $wpdb->prefix . "sdp_Cursos_academicos where IdCurso=" . date('Y'));
    ?> 
   <p><label>Don José Manuel Gonzalo Orden, Vicerrector de Estudiantes de la 
	Universidad de León,</label></p>
    <p><label><strong>HACE CONSTAR:</strong></label></p>
    <p><label><strong> Que D. <input type="text" size="15">   con D.N.I nº  <input type="text" maxlength="9" size="9">
	está inscrito y ha participado hasta la fecha  en la COMPETICION INTERNA
     de   <input type="text" size="20">      en el presente curso  <?php  print "{$curso_ant}"; ?>
            </strong></label></p><br>
<p><label><strong>Lo que firma a petición del interesado, en León el 14 de enero de 2014</strong></label></p>

<input type="submit" value="Solicitar certificado">

</form>
</fieldset>
</body>
<br>
    
    
</html>




<?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?> 