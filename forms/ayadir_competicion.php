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
wp_enqueue_script('jquery');
if (!is_user_logged_in() && !current_user_can('manage_options'))
    die('Si no eres administrador no puedes ver esta página.');
?>
 <link rel="stylesheet" type="text/css" href="../css/estiloformularios.css">
 <script type="text/javascript" src="js/jquery-1.4.2.js"></script>
 
 <script>
  
    
 </script>
 
 
  
<script type='text/javascript'>
    
var xOp7Up,xOp6Dn,xIE4Up,xIE4,xIE5,xNN4,xUA=navigator.userAgent.toLowerCase();
    if(window.opera){
        var i=xUA.indexOf('opera');
            if(i !== -1){
                var v=parseInt(xUA.charAt(i+6));
                xOp7Up=v>=7;xOp6Dn=v<7;
            }
        }else if(navigator.vendor!=='KDE' && document.all && xUA.indexOf('msie')!==-1){
            xIE4Up=parseFloat(navigator.appVersion)>=4;xIE4=xUA.indexOf('msie 4')!==-1;
            xIE5=xUA.indexOf('msie 5')!==-1;
            }else if(document.layers){xNN4=true;}xMac=xUA.indexOf('mac')!==-1;function xDef(){
                for(var i=0; i<arguments.length; ++i){
                    if(typeof(arguments[i])==='undefined')
                        return false;
                }return true;
            }function xDisplay(e,s){
                if(!(e=xGetElementById(e))) 
                    return null;
                if(e.style && xDef(e.style.display)) {
                    if (xStr(s)) e.style.display = s;
                        return e.style.display;
                  }
                 return null;
             }
         function xGetElementById(e){
             if(typeof(e)!=='string')
                 return e;
             if(document.getElementById) 
                 e=document.getElementById(e);
             else if(document.all) 
                 e=document.all[e];
                    else e=null;return e;
                }  
         function xStr(s){
             for(var i=0; i<arguments.length; ++i){
                 if(typeof(arguments[i])!=='string') 
                     return false;
             }
             return true;
         }

</script>

<script type="text/javascript">
    (function() { // BeginSpryComponent

if (typeof Spry === "undefined") window.Spry = {}; if (!Spry.Widget) Spry.Widget = {};

Spry.Widget.TabbedPanels = function(element, opts)
{
	this.element = this.getElement(element);
	this.defaultTab = 0; // Show the first panel by default.
	this.tabSelectedClass = "TabbedPanelsTabSelected";
	this.tabHoverClass = "TabbedPanelsTabHover";
	this.tabFocusedClass = "TabbedPanelsTabFocused";
	this.panelVisibleClass = "TabbedPanelsContentVisible";
	this.focusElement = null;
	this.hasFocus = false;
	this.currentTabIndex = 0;
	this.enableKeyboardNavigation = true;
	this.nextPanelKeyCode = Spry.Widget.TabbedPanels.KEY_RIGHT;
	this.previousPanelKeyCode = Spry.Widget.TabbedPanels.KEY_LEFT;

	Spry.Widget.TabbedPanels.setOptions(this, opts);

	// If the defaultTab is expressed as a number/index, convert
	// it to an element.

	if (typeof (this.defaultTab) === "number")
	{
		if (this.defaultTab < 0)
			this.defaultTab = 0;
		else
		{
			var count = this.getTabbedPanelCount();
			if (this.defaultTab >= count)
				this.defaultTab = (count > 1) ? (count - 1) : 0;
		}

		this.defaultTab = this.getTabs()[this.defaultTab];
	}

	// The defaultTab property is supposed to be the tab element for the tab content
	// to show by default. The caller is allowed to pass in the element itself or the
	// element's id, so we need to convert the current value to an element if necessary.

	if (this.defaultTab)
		this.defaultTab = this.getElement(this.defaultTab);

	this.attachBehaviors();
};

Spry.Widget.TabbedPanels.prototype.getElement = function(ele)
{
	if (ele && typeof ele === "string")
		return document.getElementById(ele);
	return ele;
};

Spry.Widget.TabbedPanels.prototype.getElementChildren = function(element)
{
	var children = [];
	var child = element.firstChild;
	while (child)
	{
		if (child.nodeType === 1 /* Node.ELEMENT_NODE */)
			children.push(child);
		child = child.nextSibling;
	}
	return children;
};

Spry.Widget.TabbedPanels.prototype.addClassName = function(ele, className)
{
	if (!ele || !className || (ele.className && ele.className.search(new RegExp("\\b" + className + "\\b")) !== -1))
		return;
	ele.className += (ele.className ? " " : "") + className;
};

Spry.Widget.TabbedPanels.prototype.removeClassName = function(ele, className)
{
	if (!ele || !className || (ele.className && ele.className.search(new RegExp("\\b" + className + "\\b")) === -1))
		return;
	ele.className = ele.className.replace(new RegExp("\\s*\\b" + className + "\\b", "g"), "");
};

Spry.Widget.TabbedPanels.setOptions = function(obj, optionsObj, ignoreUndefinedProps)
{
	if (!optionsObj)
		return;
	for (var optionName in optionsObj)
	{
		if (ignoreUndefinedProps && optionsObj[optionName] === undefined)
			continue;
		obj[optionName] = optionsObj[optionName];
	}
};

Spry.Widget.TabbedPanels.prototype.getTabGroup = function()
{
	if (this.element)
	{
		var children = this.getElementChildren(this.element);
		if (children.length)
			return children[0];
	}
	return null;
};

Spry.Widget.TabbedPanels.prototype.getTabs = function()
{
	var tabs = [];
	var tg = this.getTabGroup();
	if (tg)
		tabs = this.getElementChildren(tg);
	return tabs;
};

Spry.Widget.TabbedPanels.prototype.getContentPanelGroup = function()
{
	if (this.element)
	{
		var children = this.getElementChildren(this.element);
		if (children.length > 1)
			return children[1];
	}
	return null;
};

Spry.Widget.TabbedPanels.prototype.getContentPanels = function()
{
	var panels = [];
	var pg = this.getContentPanelGroup();
	if (pg)
		panels = this.getElementChildren(pg);
	return panels;
};

Spry.Widget.TabbedPanels.prototype.getIndex = function(ele, arr)
{
	ele = this.getElement(ele);
	if (ele && arr && arr.length)
	{
		for (var i = 0; i < arr.length; i++)
		{
			if (ele === arr[i])
				return i;
		}
	}
	return -1;
};

Spry.Widget.TabbedPanels.prototype.getTabIndex = function(ele)
{
	var i = this.getIndex(ele, this.getTabs());
	if (i < 0)
		i = this.getIndex(ele, this.getContentPanels());
	return i;
};

Spry.Widget.TabbedPanels.prototype.getCurrentTabIndex = function()
{
	return this.currentTabIndex;
};

Spry.Widget.TabbedPanels.prototype.getTabbedPanelCount = function(ele)
{
	return Math.min(this.getTabs().length, this.getContentPanels().length);
};

Spry.Widget.TabbedPanels.addEventListener = function(element, eventType, handler, capture)
{
	try
	{
		if (element.addEventListener)
			element.addEventListener(eventType, handler, capture);
		else if (element.attachEvent)
			element.attachEvent("on" + eventType, handler);
	}
	catch (e) {}
};

Spry.Widget.TabbedPanels.prototype.cancelEvent = function(e)
{
	if (e.preventDefault) e.preventDefault();
	else e.returnValue = false;
	if (e.stopPropagation) e.stopPropagation();
	else e.cancelBubble = true;

	return false;
};

Spry.Widget.TabbedPanels.prototype.onTabClick = function(e, tab)
{
	this.showPanel(tab);
	return this.cancelEvent(e);
};

Spry.Widget.TabbedPanels.prototype.onTabMouseOver = function(e, tab)
{
	this.addClassName(tab, this.tabHoverClass);
	return false;
};

Spry.Widget.TabbedPanels.prototype.onTabMouseOut = function(e, tab)
{
	this.removeClassName(tab, this.tabHoverClass);
	return false;
};

Spry.Widget.TabbedPanels.prototype.onTabFocus = function(e, tab)
{
	this.hasFocus = true;
	this.addClassName(tab, this.tabFocusedClass);
	return false;
};

Spry.Widget.TabbedPanels.prototype.onTabBlur = function(e, tab)
{
	this.hasFocus = false;
	this.removeClassName(tab, this.tabFocusedClass);
	return false;
};

Spry.Widget.TabbedPanels.KEY_UP = 38;
Spry.Widget.TabbedPanels.KEY_DOWN = 40;
Spry.Widget.TabbedPanels.KEY_LEFT = 37;
Spry.Widget.TabbedPanels.KEY_RIGHT = 39;



Spry.Widget.TabbedPanels.prototype.onTabKeyDown = function(e, tab)
{
	var key = e.keyCode;
	if (!this.hasFocus || (key !== this.previousPanelKeyCode && key !== this.nextPanelKeyCode))
		return true;

	var tabs = this.getTabs();
	for (var i =0; i < tabs.length; i++)
		if (tabs[i] === tab)
		{
			var el = false;
			if (key === this.previousPanelKeyCode && i > 0)
				el = tabs[i-1];
			else if (key === this.nextPanelKeyCode && i < tabs.length-1)
				el = tabs[i+1];

			if (el)
			{
				this.showPanel(el);
				el.focus();
				break;
			}
		}

	return this.cancelEvent(e);
};

Spry.Widget.TabbedPanels.prototype.preorderTraversal = function(root, func)
{
	var stopTraversal = false;
	if (root)
	{
		stopTraversal = func(root);
		if (root.hasChildNodes())
		{
			var child = root.firstChild;
			while (!stopTraversal && child)
			{
				stopTraversal = this.preorderTraversal(child, func);
				try { child = child.nextSibling; } catch (e) { child = null; }
			}
		}
	}
	return stopTraversal;
};

Spry.Widget.TabbedPanels.prototype.addPanelEventListeners = function(tab, panel)
{
	var self = this;
	Spry.Widget.TabbedPanels.addEventListener(tab, "click", function(e) { return self.onTabClick(e, tab); }, false);
	Spry.Widget.TabbedPanels.addEventListener(tab, "mouseover", function(e) { return self.onTabMouseOver(e, tab); }, false);
	Spry.Widget.TabbedPanels.addEventListener(tab, "mouseout", function(e) { return self.onTabMouseOut(e, tab); }, false);

	if (this.enableKeyboardNavigation)
	{
		// XXX: IE doesn't allow the setting of tabindex dynamically. This means we can't
		// rely on adding the tabindex attribute if it is missing to enable keyboard navigation
		// by default.

		// Find the first element within the tab container that has a tabindex or the first
		// anchor tag.
		
		var tabIndexEle = null;
		var tabAnchorEle = null;

		this.preorderTraversal(tab, function(node) {
			if (node.nodeType === 1 /* NODE.ELEMENT_NODE */)
			{
				var tabIndexAttr = tab.attributes.getNamedItem("tabindex");
				if (tabIndexAttr)
				{
					tabIndexEle = node;
					return true;
				}
				if (!tabAnchorEle && node.nodeName.toLowerCase() === "a")
					tabAnchorEle = node;
			}
			return false;
		});

		if (tabIndexEle)
			this.focusElement = tabIndexEle;
		else if (tabAnchorEle)
			this.focusElement = tabAnchorEle;

		if (this.focusElement)
		{
			Spry.Widget.TabbedPanels.addEventListener(this.focusElement, "focus", function(e) { return self.onTabFocus(e, tab); }, false);
			Spry.Widget.TabbedPanels.addEventListener(this.focusElement, "blur", function(e) { return self.onTabBlur(e, tab); }, false);
			Spry.Widget.TabbedPanels.addEventListener(this.focusElement, "keydown", function(e) { return self.onTabKeyDown(e, tab); }, false);
		}
	}
};

Spry.Widget.TabbedPanels.prototype.showPanel = function(elementOrIndex)
{
	var tpIndex = -1;
	
	if (typeof elementOrIndex === "number")
		tpIndex = elementOrIndex;
	else // Must be the element for the tab or content panel.
		tpIndex = this.getTabIndex(elementOrIndex);
	
	if (!tpIndex < 0 || tpIndex >= this.getTabbedPanelCount())
		return;

	var tabs = this.getTabs();
	var panels = this.getContentPanels();

	var numTabbedPanels = Math.max(tabs.length, panels.length);

	for (var i = 0; i < numTabbedPanels; i++)
	{
		if (i !== tpIndex)
		{
			if (tabs[i])
				this.removeClassName(tabs[i], this.tabSelectedClass);
			if (panels[i])
			{
				this.removeClassName(panels[i], this.panelVisibleClass);
				panels[i].style.display = "none";
			}
		}
	}

	this.addClassName(tabs[tpIndex], this.tabSelectedClass);
	this.addClassName(panels[tpIndex], this.panelVisibleClass);
	panels[tpIndex].style.display = "block";

	this.currentTabIndex = tpIndex;
};

Spry.Widget.TabbedPanels.prototype.attachBehaviors = function(element)
{
	var tabs = this.getTabs();
	var panels = this.getContentPanels();
	var panelCount = this.getTabbedPanelCount();

	for (var i = 0; i < panelCount; i++)
		this.addPanelEventListeners(tabs[i], panels[i]);

	this.showPanel(this.defaultTab);
};

})();

function validarForm() {
            
         
            if (competicion.universitario.value === "") {
                competicion.universitario.focus();    // Damos el foco al control
                alert('No has elegido si es universitaria o no'); //Mostramos el mensaje
                return false; //devolvemos el foco
           
            } else if (competicion.tipo.value === "") {
                competicion.tipo.focus();    // Damos el foco al control
                alert('No has elegido el tipo de competición'); //Mostramos el mensaje
                return false; //devolvemos el foco
            } else if (competicion.valor.value.length === 0) { //¿Tiene 0 caracteres?
                competicion.valor.focus();    // Damos el foco al control
                alert('No has introducido el numero de partidos no presentado '); //Mostramos el mensaje
                return false; //devolvemos el foco
                } else if (competicion.precio.value.length === 0) { //¿Tiene 0 caracteres?
                competicion.precio.focus();    // Damos el foco al control
                alert('No has introducido el precio del arbitraje'); //Mostramos el mensaje
                return false; //devolvemos el foco
                 } else if (competicion.victoria.value.length === 0) { //¿Tiene 0 caracteres?
                competicion.victoria.focus();    // Damos el foco al control
                alert('No has introducido la puntuacion para la victoria'); //Mostramos el mensaje
                return false; //devolvemos el foco
                 } else if (confirm('¿Has revisado correctamente todos los datos?')){
                     return true;
                 }else{
                   return false;
                 }

        }

</script>


<div id="primary" class="site-content">
    <div id="content" role="main">
        <!-- A partir de aquí el código html de la página -->


        <?php
//Datos globales a todas las paginas
        global $wpdb;
        $wpdb->show_errors();
        
        
//Cargamos los datos del usuario logeado en caso de que lo este en pruebas meter en un inc con clases de utilidades

         ?>
        
<form method="post" name="competicion" onsubmit="return validarForm(this);" action="<?php echo $_SERVER['PHP_SELF']; ?>"><br><br>
<div id="TabbedPanels1" class="TabbedPanels" style="width: 75%;margin-left: 10%;margin-right: 30%">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0" style="font-size:16px">Página 1</li>
    <li class="TabbedPanelsTab" tabindex="0" style="font-size:16px">Página 2</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent"><br/>
    <p><label><strong>1) Selecciona si es competición universitaria o no:</strong></label><br>
 </p>
<select name="universitario" id="universitario" onchange="
        <?php
            if($_POST['universitario'] == "Si"){
                $uni = 1;
            }else{
                $uni = 0;
            }
        
        ?>"/> 
 <option selected="selected"></option>
  <option>Si</option>
   <option>No</option>
    </select>
    <br><br>
   <p> <label><strong>2) Selecciona el tipo de modalidad:</strong></label></p>
          
   <input type="radio" name="tipo"  id="modalidad_0" value="liga"/> Liga a <select name="vueltas" id="vueltas" size="1">
                        <option selected="selected">1</option>
                        <option       
            <?php 
                               
                    for ($i = 2; $i <= 10; $i++) {
                        print('<option>' .$i. '<br/>');
                        print('</option>');
                         
                    }  
     ?>
  </option>
                    </select> vueltas <br><br>

   <input type="radio" name="tipo"  id="modalidad_1" value="Liga con promocion y play off"/> Liga con promoción y play off<br><br>
   
    <input type="radio" name="tipo"  id="modalidad_2" value="Liga con promocion"/>Liga con promoción<br><br>
  
    <input type="radio" name="tipo"  id="modalidad_3" value="Liga con play off"/>Liga con play off<br><br>

    <input type="radio" name="tipo"  id="modalidad_4" value="Play off"/> Play off<br><br>
  
    <input type="radio" name="tipo"  id="modalidad_5" value="Play off con repesca"/>Play off con repesca<br><br>
   
    <input type="radio" name="tipo"  id="modalidad_6" value="playoff"/> Play off con <select name="vuel" id="vuel" size="1">
                        <option selected="selected">1</option>
                        <option       
            <?php 
                               
                    for ($i = 2; $i <= 30; $i++) {
                        print('<option>' .$i. '<br/>');
                        print('</option>');
                         
                    }  
     ?>
  </option>
                    </select> partidos<br><br>
   
    <p><label><strong>3) Número de partidos no presentados:</strong> <input name="valor" type="text" size="2" /></label></p>
    
    <p><label><strong>4) Precio por arbitraje: </strong> <input type="text" name="precio" size="5"/></label></p> 
    
<p><label><strong>5) Selecciona el tipo de tanteo:</strong></label>  </p>
      
  <label>Victoria: <input type="text" name="victoria" size="1"/></label>
  <label>Empate: <input type="text" name="empate" size="1"/></label>
  <label>Derrota: <input type="text" name="derrota" size="2"/></label>
  <label>No presentado: <input type="text" name="nopresentado" size="2"/></label>

</div>


    <div class="TabbedPanelsContent"><br/>
  <p><label><strong>6) Penalizaciones por NO presentación:</strong></label><br>
 </p>
  <p>Eliminación: <input type="text" name="eliminacion" size="2"/></p>

  <p>Embargo de la mitad de la fianza: <input type="text" name="embargo" size="2"/></p>

  <p> <label><strong>7) Selecciona el tipo de criterio en caso de empate:</strong></label></p>
          
   <input type="radio" name="crit"  id="criterio_0" value="1"/> Diferencia de puntos <br><br>
                                          
   <input type="radio" name="crit"  id="criterio_1" value="2"/> Cociente<br><br>
   
    <input type="radio" name="crit"  id="criterio_2" value="3"/>Resultado entre ellos<br><br>
  <p> <label><strong>8) Selecciona el tipo de clasificación a mostrar:</strong></label></p>
          
   <input type="radio" name="clas"  id="clasif_0" value="1"/> <IMG SRC="../images/3.png"> <br><br>
                                          
   <input type="radio" name="clas"  id="clasif_1" value="2"/> <IMG SRC="../images/2.png"><br><br>
   
    <input type="radio" name="clas"  id="clasif_2" value="3"/><IMG SRC="../images/1.png"><br><br>
  
  <label><strong> 9) Nombre de la modalidad: </strong></label> <input type="text" name="modal" size="10"/><br><br>
    <p><input name="submit" value="Introducir modalidad" type="submit"  onclick="
                            
         <?php
           echo "<script language='javascript'> 
            $valor = validarForm();                    
            </script>";
                         
         $resul = "<script> document.write($valor) </script>";
                        
           global $wpdb;
           $wpdb->show_errors();
           $wpdb->print_error();
             
           if($_REQUEST['tipo'] == "liga"){
               $tipo = "Liga a " . $_POST['vueltas'] . " vueltas";
           }else if($_REQUEST['tipo'] == "playoff"){
              $tipo = "Play off con " . $_POST['vuel'] . " partidos"; 
           }else{
               $tipo = $_POST["tipo"];
           }
   
          if (isset($_POST['submit'])){     
               if( $resul == true){
                 $wpdb->insert( "wp_sdp_Modalidades", array('Modalidad' => $_POST["modal"],'CriterioClasificacion' => $_POST["clas"],'CriterioEmpate' => $_POST["crit"],'PuntosVictoria' => $_POST["victoria"],'PuntosEmpate' => $_POST["empate"],'PuntosDerrota' => $_POST["derrota"],'PuntosNoPresentado' => $_POST["nopresentado"],'NoPresentacionesRebajaMediaFianza' => $_POST["embargo"],'NoPresentacionesEliminacion' => $_POST["eliminacion"],'PrecioArbitraje' => $_POST["precio"],'EsUniversitario' => $uni,'TipoCompeticion' => $tipo));
             }
          }             
             ?>"/></p>
    <br>
   


      </div>
    </div>
  </div>
  </form>
    <script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script> 
     <br>
        <!-- Fin de código html partir de aquí el código html de la página -->
    </div><!-- #content -->
</div><!-- #primary -->

<?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?>      