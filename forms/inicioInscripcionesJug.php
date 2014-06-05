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
<head>
   

</head>

<body>
<h2 style="width: 80%;margin-left: 10%;margin-right: 10%">¿Eres universitario?</h2>
<form name=eleccion style="width: 80%;margin-left: 10%;margin-right: 10%">

<a href='http://ulelin.unileon.es/wp-content/plugins/sdp_ligainterna/forms/login.php'> <input type="button" value="Si"></a> 
<br><br>
<a href='http://ulelin.unileon.es/wp-content/plugins/sdp_ligainterna/forms/alta_jugadoresNU.php'> <input type="button" value="No"></a> 

<br>
</form>

</body>
</html>

<?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?>