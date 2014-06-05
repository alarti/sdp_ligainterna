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
get_header();
?>

<div id="primary" class="site-content">
    <div id="content" role="main">
        <!-- A partir de aquí el código html de la página -->
        <?php
       
        ?><br><br>
<fieldset style="width: 80%;margin-left: 10%;margin-right: 10%"><legend><strong>Documentos necesarios</strong></legend><br><br>
       <div id="Accordion1" class="Accordion" tabindex="0" >
        <div class="AccordionPanel">
          <div class="AccordionPanelTab"><strong>Equipos</strong></div>
          <div class="AccordionPanelContent">
          <p><label>1. Rellenar correctamente el apartado de equipos</label></p>
          <label>2. Fotocopia de recibo bancario subida donde se indica + cuota de inscripción(50 euros)</label>
          <p><label>3. Nº de cuenta ingreso Caja España (2096 0092 21 3136523204)</label></p><br />
          <p><label>El plazo finaliza el día 24 de Octubre de 2013</label></p>
          <p><label><em>Notas sobre FIANZAS: </em></label></p>
          <label><p>-El Capitán o la persona que se indique, tendrá que ser titular o autorizado de la cuenta expresada para la devolución.</p>
 -La devolución de la fianza se realizará,a todos, a través de transferencia bancaria.Si la cuenta indicada no pertenece a Caja España, la devolución, tendrá un coste (comisión de Caja España por realizar la transferencia) de unos 3 euros (este precio es estimativo, la Caja puede variar el precio) serán descontados de la cantidad que os corresponda en la devolución.</label>
         </div>
        </div>
        <div class="AccordionPanel">
          <div class="AccordionPanelTab"><strong>Individual</strong></div>
          <div class="AccordionPanelContent">
          <p><label>1. Rellenar correctamente el apartado de individual</label></p>
          <label>2. Fotocopia de recibo bancario subida donde se indica + cuota de inscripción(15 euros)</label>
          <p><label>3. Nº de cuenta ingreso Caja España (2096 0092 21 3136523204)</label></p><br />
          <p><label>El plazo finaliza el día 31 de Octubre de 2013</label></p>
          <p><label><em>Notas sobre FIANZAS: </em></label></p>
          <label><p>-El Capitán o la persona que se indique, tendrá que ser titular o autorizado de la cuenta expresada para la devolución.</p>
 -La devolución de la fianza se realizará,a todos, a través de transferencia bancaria.Si la cuenta indicada no pertenece a Caja España, la devolución, tendrá un coste (comisión de Caja España por realizar la transferencia) de unos 3 euros (este precio es estimativo, la Caja puede variar el precio) serán descontados de la cantidad que os corresponda en la devolución.</label>
          </div>
        </div>
              </div>
</fieldset>
    </div>
</div>
<?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?>

