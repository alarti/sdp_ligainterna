<?php
 
/*
  Clase: createSDPDatabase
  Author: Alberto Arce
 */

class SDPDatabase {
    var $last_error='';
     
    function install() {

        function sqlfile2var($file) {
            ob_start();
            include($file);
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        }

        function format_wp_prefix($sql) {
            global $wpdb;
            return str_replace("wp_sdp_", $wpdb->prefix . "sdp_", $sql);
        }

        $sdp_db_version = get_option('sdp_saml_authentication_version');
        //leemos el contenido del fichero según la version de sdp
        $sql = sqlfile2var(plugin_dir_path(__FILE__) . '../sql/sdp_' . $sdp_db_version . '.sql');
        //sustiuimos en masa el prefijo de las tablas por el de la instalación de WP
        $sql2 = format_wp_prefix($sql);

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        
        global $wpdb;
        #ejecutamos desde dbDelta para que se haga una create sin eliminar los datos
        #que ya existen
        #borramos los temp y mostramos errores.
        $wpdb->show_errors();
        $wpdb->flush();

        $sql_del=format_wp_prefix("DROP TABLE `wp_sdp_Arbitros`, `wp_sdp_AsistenciaJugadoresEquipo1`, `wp_sdp_AsistenciaJugadoresEquipo2`, `wp_sdp_Asistencias_a_partidos`, `wp_sdp_Centros`, `wp_sdp_Cruces_tipo`, `wp_sdp_Cursos_academicos`, `wp_sdp_Detalles_de_arbitros`, `wp_sdp_Detalles_de_equipos`, `wp_sdp_Detalles_de_instalaciones`, `wp_sdp_Equipos`, `wp_sdp_Instalaciones`, `wp_sdp_Jugadores`, `wp_sdp_Modalidades`, `wp_sdp_Partidos`, `wp_sdp_Sanciones_equipos`, `wp_sdp_Sanciones_jugadores`, `wp_sdp_Sexos_equipo`, `wp_sdp_Sexos_persona`, `wp_sdp_Switchboard Items`, `wp_sdp_tblArbitrajes`, `wp_sdp_Tipos_de_instalacion`;");
        #$wpdb->query($sql_del);
        dbDelta($sql2);
        #$wpdb->query($sql2);

        if ($wpdb->last_error){
           # trigger_error( 'QUERY:'.$wpdb->last_query.' ERROR:'.$wpdb->last_error, E_USER_ERROR);
        }
        //$this->last_error=$wpdb->last_error;
    }

}

