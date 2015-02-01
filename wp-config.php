<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'niky');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '}PL<q++}eK1kFq_X-j6vc*Zu4r+T@#[PN/T|)/cK[Joz;CCf%p[gRyXX#Xy(P-2c');
define('SECURE_AUTH_KEY', 'FXP^j3}+EW4;o^R3NL5=1C0V_btO`-q|7q#~Y|bU4R_`+Na?yrf(}jg*,pY,s|lk');
define('LOGGED_IN_KEY', 'tb-akyCB@TL.puD/cDc<F,T #9qqzT7V0u$PT+10Q*; m)O!AA|%?Rkty}P*.#<-');
define('NONCE_KEY', 'D&{ikp3mHAESNr0K}&a}}U0EkYJr|)(i~?o*CJeU2%+|:z`6/hx5QPQb4LaO~3lb');
define('AUTH_SALT', 'A|Of+%8Vsn&4$QX/eGtj-O{JBEkb2BdD@x-$dxAtY<qSD_pb!p!O~Q9F-ZCH]|ff');
define('SECURE_AUTH_SALT', 'CSNtoYb ]bd]>3~v%-p;.{g$G7DXQViBX1W4kFEoJ-g+dHYE$psHgw4i.7?I8[|9');
define('LOGGED_IN_SALT', 'r{B.-Y:_wFgght}<6*@NkR&9},mS2@ 7MKl</fx_,2&P}ZgM#Y I8l3m]EO}E2@<');
define('NONCE_SALT', 'i0_0-VFm;4jFvNwP1Z+|4T)dq0ZH)>I:4G$@H/v$PaVQ|3&@`[|%}qJ(%kE*+n:m');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

