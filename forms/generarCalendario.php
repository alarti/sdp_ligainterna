<?php

require_once('../../../../wp-load.php');
require('class.roundrobin.php');       
get_header();
?>
<html>
    
    <body>
<div id="primary" class="site-content">
        <div id="content" role="main">
            <!-- A partir de aquí el código html de la página -->


            <br>
            <fieldset style="width: 70%;margin-left: 10%;margin-right: 10%" ><legend><strong>Generar calendario de partidos</strong></legend>
             <form method="post" name="gencal">
                 <br>
                    <div  width="50%">
                         <p><label>Modalidad:

<select name="modalidad" id="modalidad" size="1" onchange="
                                    <?php
                                   
                                     global $wpdb;
                                    $idmodal = $wpdb->get_var( "SELECT IdModalidad FROM ". $wpdb->prefix ."sdp_Modalidades WHERE Modalidad LIKE '%$_POST[modalidad]'");
                                                                      
                                    ?>
                                        ">
    <option>
      <?php 
        $sql="SELECT DISTINCT Modalidad FROM wp_sdp_Modalidades";

                    $items = $wpdb->get_results($sql);

                    foreach ($items as $item)
                    {
                        print('<option>'.$item->Modalidad.'<br/>');
                         print('</option>');
                    }
?>
  </option>
</select></label></p>
<p><label>Sexo:
<select name="sexo" id="sexo" size="1" >
    <option></option>
    <option>Masculino  </option>
    <option>Femenino  </option>
</select></label></p>
                        <label>Selecciona la división y el grupo para generar el calendario</label><br><br>
      <p>División: <select name="division" id="division" size="1">
    <option>
      <?php 
        $sql="SELECT DISTINCT Division FROM wp_sdp_Equipos ORDER BY Division ASC";

                    $items = $wpdb->get_results($sql);

                    foreach ($items as $item)
                    {
                        print('<option>'.$item->Division.'<br/>');
                         print('</option>');
                    }
?>
  </option>
</select>&nbsp;&nbsp; Grupo:<select name="grupo" id="grupo" size="1">
    <option>
      <?php 
        $sql="SELECT DISTINCT Grupo FROM wp_sdp_Equipos ORDER BY Grupo ASC";

                    $items = $wpdb->get_results($sql);

                    foreach ($items as $item)
                    {
                        print('<option>'.$item->Grupo.'<br/>');
                         print('</option>');
                    }
?>
  </option>
</select></p>
      
<p><input name="calendario" type="button" value="Generar calendario de partidos" onclick="
          <?php 
//                $players = array('A','B','C','D');
//                $matchs = array();
//
//                foreach($players as $k){
//                    foreach($players as $j){
//                         if($k == $j){
//                             continue;
//                        }   
//                     $z = array($k,$j);
//                     sort($z);
//                     if(!in_array($z,$matchs)){
//                        $matchs[] = $z;
//                    }
//                    }
//                }
//
//                print_r($matchs);
          
          
          
          //Numero de Equipos del Grupo(Esto será variable, haciendo
    //la consulta desde la BD:
    $numEquipos = 25;
    $numPartidos = 0;    
    $numPartidosPorJornada = 0;
    $tipoCruce = 1;//0 Solo Ida, 1 Ida y Vuelta.(Lo pondrá el usuario)
    $hayDescanso = $numEquipos%2;// Ver si son equipos Impares. True(1)
    //habra descanso.
    //Los Jugadores o Equipos:
    $teams = array();
    //Array Final:
    $arrayResultado = array();
    //Contadores:
    $i = 0;
    $j = 0;

    if($hayDescanso !=0)
    {
        $numEquipos = $numEquipos + 1; //Añado un Equipo Fantasma, el que se 
        //enfrente contra ese último equipo, descansará esa jornada.
    }
    for($i = 0; $i<$numEquipos; $i++)//Relleno los equipos
    {
        $teams[$i] = 65 + $i;
    }
    
    printf("Los nombres de los equipos son:\n");
    //Añado los nombres de los equipos con letra(A, B, C, D... etc..)
    //Tu tendrás los nombres sacados con consulta a la BD, simplemente los
    //tienes que agregar al array $teams.
    for($i = 0; $i<$numEquipos; $i++)
    {
        if(($hayDescanso != 0) && ($i == ($numEquipos-1)))
        {
            //Si los equipos son impares añado un equipo Fantasma.
            //El equipo que se enfrente contra éste, descansará esa jornada.
             printf("  -Equipo Fantasma (%d): %c\n", $i, $teams[$i]);
        }
        else 
        {
            printf("  -Equipo %d: %c\n", $i, $teams[$i]);
        }
    }
    printf("\n");
    
    //Solo Ida:
    if($tipoCruce == 0)
    { 
        //Esto es información general de numero de partidos, numero de jornadas
        //si habrá descanso o no... etc
        $numPartidos = (($numEquipos * $numEquipos) - $numEquipos)/2;
        $numJornadas = ($numPartidos/($numEquipos/2));
        $numPartidosPorJornada = $numEquipos/2;//Ó numPartidos/numJornadas 
        printf("Hay Descanso: %d\n", $hayDescanso);
        printf("Partidos Totales: %d\n", $numPartidos);
        printf("Partidos Por Jornada: %d\n", $numPartidosPorJornada);
        printf("Jornadas: %d\n\n", $numJornadas);
        
        //Aquí empieza "la magia" jaja. creo un objeto de tipo roundrobin,
        //al que le paso el array con los equipos. Esto es así para que el
        //array de equipos tome una forma dada por la clase importada y así
        //poder aplicar las funciones que vienen en la misma.
        $roundrobin = new roundrobin($teams);

        // Se generan los partidos teniendo en cuenta las Jornadas, es decir,
        // que no juegue un equipo dos partidos en la misma jornada.
        $roundrobin->create_matches();
        // El resultado es un array de tres dimensiones: 
        // jornada->partido->oponentes. Lo guardaré en arrayResultado.
        if ($roundrobin->finished) {
            $arrayResultado = $roundrobin->matches;
            
            //Recorro con los for el array. La primera dimension viene dada
            //por el numero de jornadas, la segunda por el numero de partidos
            // por jornada, y la tercera los 2  que jugarán ese partido.
            //La tercera dimension siempre sera a 0 o 1. 0 el Equipo Local
            // 1 el equipo visitante.
            for($i=0; $i<$numJornadas; $i++)
            {
                printf("Jornada %d:\n", $i);
                for($j=0; $j<$numPartidosPorJornada; $j++)
                {
                    //Esta expresion regular nos marcará el equipo que juega contra el equipo fantasma, y que por tanto descasará esa jornada.
                    if((($hayDescanso  == 1) && ($arrayResultado[$i][$j][0] == $teams[$numEquipos - 1])) || (($hayDescanso  == 1) && ($arrayResultado[$i][$j][1] == $teams[$numEquipos - 1])))
                    {
                        if($arrayResultado[$i][$j][0] == $teams[$numEquipos - 1])//Simplemente para mirar si el equipo fantasma está como local o como visitante.
                        {
                            printf("  -Partido %d: Descansa %c\n", $j, $arrayResultado[$i][$j][1]);// Si el fantasma es el local, descansara el visitante.
                        }
                        else
                        {
                            printf("  -Partido %d: Descansa %c\n", $j, $arrayResultado[$i][$j][0]);// Si el fantasma es visitante, descansará el local.
                        }
                    }
                    else//Si no fuera necesario que haya descanso(Si los equipos son pares) simplemente se imprimen los enfrentamiento sin hacer comprobaciones.
                    {
                        printf("  -Partido %d: %c VS %c\n", $j, $arrayResultado[$i][$j][0], $arrayResultado[$i][$j][1]);
                    }                    
                }
                printf("\n");
            }
        }
    }
    
    //Ida y Vuelta:
    if($tipoCruce == 1)
    { 
        $numPartidos = (($numEquipos * $numEquipos) - $numEquipos);
        $numJornadas = ($numPartidos/($numEquipos/2));
        $numPartidosPorJornada = $numEquipos/2;//Ó numPartidos/numJornadas 
        printf("Hay Descanso: %d\n", $hayDescanso);
        printf("Partidos Totales: %d\n", $numPartidos);
        printf("Partidos Por Jornada: %d\n", $numPartidosPorJornada);
        printf("Jornadas: %d\n\n", $numJornadas);
        
        $roundrobin = new roundrobin($teams);

        // Se generan los partidos teniendo en cuenta las Jornadas
        $roundrobin->create_matches();
        // El resultado es un array de tres dimensiones: 
        // jornada->partido->oponentes. Lo guardare en arrayResultado.
        if ($roundrobin->finished) {
            $arrayResultado = $roundrobin->matches;
            
            //Aquí es todo igual que cuando tipoCruce == 1.
            //Excepto que se recorren la mitad de las jornadas primero.
            // Y dejamos al local como local y al visitante como visitante.
            printf("Ida:\n");
            for($i=0; $i<$numJornadas/2; $i++)
            {
                printf(" Jornada %d:\n", $i);
                for($j=0; $j<$numPartidosPorJornada; $j++)
                {
                    if((($hayDescanso  == 1) && ($arrayResultado[$i][$j][0] == $teams[$numEquipos - 1])) || (($hayDescanso  == 1) && ($arrayResultado[$i][$j][1] == $teams[$numEquipos - 1])))
                    {
                        if($arrayResultado[$i][$j][0] == $teams[$numEquipos - 1])
                        {
                            printf("  -Partido %d: Descansa %c\n", $j, $arrayResultado[$i][$j][1]);
                        }
                        else
                        {
                            printf("  -Partido %d: Descansa %c\n", $j, $arrayResultado[$i][$j][0]);
                        }
                    }
                    else
                    {
                        printf("  -Partido %d: %c VS %c\n", $j, $arrayResultado[$i][$j][0], $arrayResultado[$i][$j][1]);
                    }                    
                }
                printf("\n");
            } 
            
            printf("Vuelta:\n");
            //Se vuelven a recorrer la mitad de las jornadas.
            // Y ahora cambiamos al local a visitante y al visitante a local.
            for($i=0; $i<$numJornadas/2; $i++)
            {
                printf(" Jornada %d:\n", $i + $numJornadas/2);
                for($j=0; $j<$numPartidosPorJornada; $j++)
                {
                    if((($hayDescanso  == 1) && ($arrayResultado[$i][$j][0] == $teams[$numEquipos - 1])) || (($hayDescanso  == 1) && ($arrayResultado[$i][$j][1] == $teams[$numEquipos - 1])))
                    {
                        if($arrayResultado[$i][$j][0] == $teams[$numEquipos - 1])
                        {
                            printf("  -Partido %d: Descansa %c\n", $j, $arrayResultado[$i][$j][1]);
                        }
                        else
                        {
                            printf("  -Partido %d: Descansa %c\n", $j, $arrayResultado[$i][$j][0]);
                        }
                    }
                    else
                    {
                        printf("  -Partido %d: %c VS %c\n", $j, $arrayResultado[$i][$j][1], $arrayResultado[$i][$j][0]);
                    }                    
                }
                printf("\n");
            }
        }
    }
          ?>"/></p>
 
       
        </div>
             </form>
            </fieldset>
    </div>
</div>
        </body>
    </html>
<?php
//Pintamos la barra laterar fuera del div y el footer.
get_sidebar();
get_footer();
?> 